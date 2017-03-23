<?php
class RegistrationPage extends Page
{
    private static $db = array('Disabled' => 'Boolean');
    private static $has_one = array();
    
    private static $defaults = array('ProvideComments' => '1',);
    
    public function getCMSFields() {
        
        $fields = parent::getCMSFields();
        $fields->removeFieldFromTab("Root.Main", "Content");
        $fields->addFieldToTab('Root.Main', new CheckboxField("Disabled", "Disable the registration form (temporarily)"));
        $fields->addFieldToTab('Root.Main', new HTMLEditorField("Content", "Content"));
        return $fields;
    }
}
class RegistrationPage_Controller extends Page_Controller
{
    
    //Allow our form as an action
    public static $allowed_actions = array('RegistrationForm');
    
    //Generate the registration form
    public function RegistrationForm() {
        $fields = new FieldList(
        new TextField('FirstName', '<span>*</span> First Name'), new TextField('Surname', '<span>*</span> Last Name'), new EmailField('Email', '<span>*</span> UIowa Email Address'), new ConfirmedPasswordField('Password', '<span>*</span>Choose a Password'), new UniversityIDField('UniversityID', '<span>*</span>University ID'), new TextField('Major'), new TextField('GPA'), new TextField('AcademicStatus', 'Status (undergraduate, graduate, faculty, or staff)'),
        
        //new LiteralField('Terms', $this->Content),
        new CheckboxField('AgreeToConditions', 'Checking this box confirms that you have reviewed our Terms and Conditions above.'));
        
        // Create action
        $actions = new FieldList(new FormAction('doRegister', 'Register'));
        
        // Create action
        $validator = new RequiredFields('FirstName', 'Surname', 'Email', 'Password', 'UniversityID');
        
        $form = new Form($this, 'RegistrationForm', $fields, $actions, $validator);
        
        /*We'll disable the spam protection for now and hopefully assume that providing the @uiowa.edu email address will be enough to protect against spam.*/
        
        //$protector = SpamProtectorManager::update_form($form, 'Message', null, "Please enter the following words");
        $form->enableSpamProtection();
        
        return $form;
    }
    
    public function getEmails() {
        
        //return DataObject::get("MemberManagement");
        return MemberManagement::get();
    }
    
    //This function sets the default start and end dates (when they intend to stop tutoring) to be the semester the tutor is currently in (or if the semester is over, the upcoming semester).
    
    function getStartEndDates() {
        
        $TodayDate = date("m.d.y");
        
        //$TodayTimestamp = strtotime($TodayDate);
        $TodayTimestamp = strtotime($TodayDate);
        
        $DateArray = array();
        
        $DateArray[strtotime("8/20/2012") ] = strtotime("12/14/2012");
        $DateArray[strtotime("1/22/2013") ] = strtotime("5/17/2013");
        $DateArray[strtotime("8/26/2013") ] = strtotime("12/13/2013");
        $DateArray[strtotime("1/21/2014") ] = strtotime("5/16/2014");
        $DateArray[strtotime("8/25/2014") ] = strtotime("12/19/2014");
        $DateArray[strtotime("1/20/2015") ] = strtotime("5/15/2015");
        $DateArray[strtotime("8/24/2015") ] = strtotime("12/18/2015");
        $DateArray[strtotime("1/19/2016") ] = strtotime("5/13/2016");
        $DateArray[strtotime("8/22/2016") ] = strtotime("12/19/2016");
        $DateArray[strtotime("1/17/2017") ] = strtotime("5/12/2017");
        $DateArray[strtotime("8/21/2017") ] = strtotime("12/15/2017");
        $DateArray[strtotime("1/16/2018") ] = strtotime("5/11/2018");
        
        //proposed dates for 2018-2019 and are subject to change
        $DateArray[strtotime("8/20/2018") ] = strtotime("12/14/2018");
        $DateArray[strtotime("1/14/2019") ] = strtotime("5/10/2019");
        
        $StartDate = strtotime("8/20/2012");
        $EndDate = strtotime("12/14/2012");
        
        foreach ($DateArray as $DateKey => $DateValue) {
            
            if (($TodayTimestamp > $DateKey) && ($TodayTimestamp > $DateValue)) {
                
                continue;
            } 
            else {
                $StartDate = $DateKey;
                $EndDate = $DateValue;
                break;
            }
        }
        
        $FStartDate = date("y-m-d", $StartDate);
        $FEndDate = date("y-m-d", $EndDate);
        
        $returnArray = Array();
        $returnArray["start"] = $FStartDate;
        $returnArray["end"] = $FEndDate;
        
        return $returnArray;
    }
    
    //Submit the registration form
    function doRegister($data, $form) {
        $adminEmail = Config::inst()->get('Email', 'admin_email');
        
        //Check for existing member email address, use raw2sql to sanitize email form input
        if ($member = DataObject::get_one("Member", "`Email` = '" . Convert::raw2sql($data['Email']) . "'")) {
            
            //Set error message
            $form->AddErrorMessage('Email', "Sorry, that email address already exists. Please choose another.", 'bad');
            
            //$form->sessionMessage('There was a problem with your registration submission.', 'bad');
            //Set form data from submitted values
            Session::set("FormInfo.Form_RegistrationForm.data", $data);
            
            //Return back to form
            return $this->redirectBack();
        } 
        elseif (!isset($data['AgreeToConditions'])) {
            $form->AddErrorMessage('AgreeToConditions', "You must indicate that you've read our Terms and Conditions before registering.", 'bad');
            
            //Set form data from submitted values
            Session::set("FormInfo.Form_RegistrationForm.data", $data);
            
            //Return back to form
            $url = Director::absoluteBaseURL() . '/tutor-application/#AgreeToConditions';
            return $this->redirect($url);;
        }
        
        //Otherwise create new member and log them in
        $Member = new Member();
        $form->saveInto($Member);
        
        $Member->write();
        $Member->login();
        
        Session::clear("Saved");
         //Make sure edit profile works properly
        
        $TutorPage = new TutorPage();
        
        //$tutorParent = DataObject::get_one('TutorHolder', "Title = 'Provisional Tutors'");
        $tutorParent = TutorHolder::get()->filter(array('Title' => 'Provisional Tutors'))->first();
        $TutorPage->setParent($tutorParent);
         //Sets the tutor holder to hold new tutor pages
        
        //Flesh out page info
        $TutorPage->Title = $Member->Name;
        
        //Some or all of these are not necessary
        $TutorPage->MetaTitle = $Member->Name;
        $TutorPage->ShowInSearch = 1;
        $TutorPage->MetaKeywords = $Member->Name;
        $TutorPage->ProvideComments = 1;
        $TutorPage->GPA = null;
        $TutorPage->UniversityID = null;
        
        $form->saveInto($TutorPage);
        
        //Place "foreign key" from member into tutor page
        $insertMemberID = $Member->ID;
        $TutorPage->MemberID = $insertMemberID;
        
        //This function provides semester start and end dates relative to the current date up to Spring 2015
        $tempDates = $this->getStartEndDates();
        
        $TutorPage->StartDate = $tempDates["start"];
        $TutorPage->EndDate = $tempDates["end"];
        $TutorPage->URLSegment = $TutorPage->ID;
        
        $TutorPage->write();
        $TutorPage->writeToStage("Stage");
        
        $TutorPage->publish("Stage", "Live");
        
        $TutorPage->deleteFromStage('Live');
        
        //$emailArray = DataObject::get('Member', "ID in (select MemberID from Group_Members where GroupID = (select ID from `Group` where title='Content Authors'))");
        
        $userEmail = $Member->Email;
         //used in body of email, not really necessary
        
        $subject = "TutorIowa Application Notification";
        $body = "Administrator,<br><br>The following individual has registered to be a tutor on Tutor Iowa:<br><br>" . "Name: " . $Member->FirstName . " " . $Member->Surname . "<br> Email: " . $TutorPage->Email . "<br> University ID: " . $TutorPage->UniversityID . "<br>Major: " . $TutorPage->Major . "          
        <br><br>Confirm user <a href='" . Director::absoluteBaseURL() . "admin/pages/edit/show/" . $TutorPage->ID . "'>here </a/>";
        
        //Confirm user  <a href='http://localhost/admin/pages/edit/show/". $TutorPage->ID . "'>here </a/>";
        //$headers = "From: Tutor Iowa";
        //mail($recip->Email, $subject, $body);
        
        $email = new Email();
        $email->setTo($adminEmail);
        $email->setFrom($adminEmail);
        $email->setSubject($subject);
        $email->setBody($body);
        if (SS_ENVIRONMENT_TYPE == "live") {
            $email->send();
        }
        
        $subject = "TutorIowa Application Confirmation";
        
        //$emailHolder = DataObject::get_one("EmailHolder");
        $emailHolder = EmailHolder::get()->first();
        $body = $emailHolder->RegistrationRequest;
        
        $email = new Email();
        $email->setTo($Member->Email);
        $email->setFrom(Email::getAdminEmail());
        $email->setSubject($subject);
        $email->setBody($body);
        if (SS_ENVIRONMENT_TYPE == "live") {
            $email->send();
        }
        
        Session::set('Saved', 1);
        
        if ($ProfilePage = EditProfilePage::get()->first())
         //$ProfilePage = DataObject::get_one('EditProfilePage'))
        {
            return $this->redirect($ProfilePage->Link('?success=1'));
        }
    }
}

