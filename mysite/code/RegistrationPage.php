<?php

 
class RegistrationPage extends Page {
   static $db = array(
   	'Disabled' => 'Boolean'
   );
   static $has_one = array(
   );
   
   static $defaults = array ('ProvideComments' => '1',
    
   
    
    );
   
    public function getCMSFields() {
    
		$fields = parent::getCMSFields();
		$fields->removeFieldFromTab("Root.Main", "Content");
		$fields->addFieldToTab( 'Root.Main', new CheckboxField("Disabled", "Disable the registration form (temporarily)"));
		$fields->addFieldToTab( 'Root.Main', new HTMLEditorField("Content", "Content"));		
		return $fields;
        
     } 
   
}
 
class RegistrationPage_Controller extends Page_Controller {

    //Allow our form as an action
    static $allowed_actions = array(
        'RegistrationForm'
    );
     
    //Generate the registration form
    function RegistrationForm()
    {
        $fields = new FieldList(
            
            new TextField('FirstName', '<span>*</span> First Name'),
            new TextField('Surname', '<span>*</span> Last Name'),
            new CustomEmailField('Email', '<span>*</span> UIowa Email Address'),
            new ConfirmedPasswordField('Password', '<span>*</span>Choose a Password'),
            new UniversityIDField('UniversityID', 'University ID'),
            new TextField('Major'),
            new TextField('GPA'),
            new TextField('AcademicStatus', 'Status (undergrad, grad, faculty, staff)'),
            new LiteralField('Terms', $this->Content),
            new CheckboxField('AgreeToConditions', 'Checking this box confirms that you have reviewed our Terms and Conditions above.')
                     
        );
        
      
         
        // Create action
        $actions = new FieldList(
            new FormAction('doRegister', 'Register')
        );
        // Create action
        $validator = new RequiredFields('FirstName', 'Surname', 'Email', 'Password');
        
        $form = new Form($this, 'RegistrationForm', $fields, $actions, $validator);
        /*We'll disable the spam protection for now and hopefully assume that providing the @uiowa.edu email address will be enough to protect against spam.*/
        //$protector = SpamProtectorManager::update_form($form, 'Message', null, "Please enter the following words");

        
        return $form;      
    }
    
    public function getEmails(){
	    //return DataObject::get("MemberManagement");
	    return MemberManagement::get(); 
    }
    
    //This function sets the default start and end dates (when they intend to stop tutoring) to be the semester the tutor is currently in (or if the semester is over, the upcoming semester).  
    
     function getStartEndDates(){
	     
	    $TodayDate = date("m.d.y");
	    //$TodayTimestamp = strtotime($TodayDate); 
	    $TodayTimestamp = strtotime($TodayDate);

	    $DateArray = array();
	    
	   	$DateArray[strtotime("8/20/2012")] = strtotime("12/14/2012");
	    $DateArray[strtotime("1/22/2013")] = strtotime("5/17/2013");
	    $DateArray[strtotime("8/26/2013")] = strtotime("12/13/2013");
	    $DateArray[strtotime("1/21/2014")] = strtotime("5/16/2014");
	    $DateArray[strtotime("8/25/2014")] = strtotime("12/19/2014");
	    $DateArray[strtotime("1/20/2015")] = strtotime("5/15/2015");
	    
	  
	    
	    $StartDate = strtotime("8/20/2012");
	    $EndDate = strtotime("12/14/2012");
	    
	    foreach($DateArray as $DateKey=>$DateValue){
	    	
	    	if (($TodayTimestamp > $DateKey) && ($TodayTimestamp > $DateValue)){
	    		
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
    function doRegister($data,$form)
    {
        //Check for existing member email address, use raw2sql to sanitize email form input
        if($member = DataObject::get_one("Member", "`Email` = '". Convert::raw2sql($data['Email']) . "'")) 
        {
            //Set error message
            $form->AddErrorMessage('Email', "Sorry, that email address already exists. Please choose another.", 'bad');
            //$form->sessionMessage('There was a problem with your registration submission.', 'bad');
            //Set form data from submitted values
            Session::set("FormInfo.Form_RegistrationForm.data", $data);     
            //Return back to form
            return $this->redirectBack();          
        }
        
        elseif (!isset($data['AgreeToConditions'])){
	        $form->AddErrorMessage('AgreeToConditions', "You must indicate that you've read our Terms and Conditions before registering.", 'bad');
	        //Set form data from submitted values
            Session::set("FormInfo.Form_RegistrationForm.data", $data);     
            //Return back to form
            $url = Director::absoluteBaseURL() .'/tutor-application/#AgreeToConditions';
            return $this->redirect($url);;  
        }
        
        //Otherwise create new member and log them in
        $Member = new Member();
        $form->saveInto($Member); 
        
        
                   
        $Member->write();
        $Member->login();
        
        Session::clear("Saved"); //Make sure edit profile works properly 
          
        $TutorPage = new TutorPage();
        
        //$tutorParent = DataObject::get_one('TutorHolder', "Title = 'Provisional Tutors'"); 
        $tutorParent = TutorHolder::get()->filter(array('Title' => 'Provisional Tutors'))->first();
        $TutorPage->setParent($tutorParent); //Sets the tutor holder to hold new tutor pages
        
      
        
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
        $TutorPage->writeToStage('Stage'); //Publishing handled by Tutor Iowa staff
                  
        //$emailArray = DataObject::get('Member', "ID in (select MemberID from Group_Members where GroupID = (select ID from `Group` where title='Content Authors'))");
        
        include 'EmailArray.php'; //Gets members of security group that should be notified about user registration 
        
        
        $userEmail = $Member->Email; //used in body of email, not really necessary
        
        if (isset($emailArray)){
            
	        foreach ($emailArray as $recip){ //emailArray defined in EmailArray.php
	        	
	        	$subject = "TutorIowa Application Notification";
	        	$body = "Administrator,<br><br>The following individual has registered to be a tutor on Tutor Iowa:<br><br>" . "Name: " . $Member->FirstName . " " . $Member->Surname . 
	        	"<br> Email: " . $TutorPage->Email . "<br> University ID: " . $TutorPage->UniversityID . "<br>Major: " . $TutorPage->Major . "        	
	        	<br><br>Confirm user <a href='" . Director::absoluteBaseURL() . "admin/show/" . $TutorPage->ID . "'>here </a/>";  
	        	
	        	
	        	//Confirm user  <a href='http://localhost/admin/show/". $TutorPage->ID . "'>here </a/>";      	
	        	//$headers = "From: Tutor Iowa";       	
		        //mail($recip->Email, $subject, $body);
		        
		         $email = new Email(); 
		         $email->setTo($recip->Email); 	         
		         $email->setFrom("tutoriowa@uiowa.edu"); 
		         $email->setSubject($subject); 
		         $email->setBody($body); 
		         $email->send(); 
		         	         
		    }
		}
	    
	    $subject = "TutorIowa Application Confirmation";
	    $body = "Thank you for registering to be a tutor on Tutor Iowa.<br> <br>

 

In order to be approved as a tutor and be published on the Tutor Iowa website, you must attend one 50-minute Tutor Iowa Orientation workshop.  Here is a list of dates and locations for these orientations:<br><br>

 

Tuesday, August 21 (5-5:50 p.m.)                              114 BHC<br>

Thursday, August 23 (5-5:50 p.m.)                            E224 CB<br>

Sunday, August 26 (6-6:50 p.m.)                                114 BHC<br>

Monday, August 27 (10:30-11:20 a.m.)                   C10 PC<br>

Wednesday, August 29 (12:30-1:20 p.m.)               E224 CB<br>

Wednesday, September 5 (4:30-5:20 p.m.)          114 BHC<br>

Thursday, September 6 (2-2:50 p.m.)                      C139 PC<br>

Monday, September 10 (3:30-4:20 p.m.)               215 NH<br>

Tuesday, September 11 (3:30-4:20 p.m.)               114 BHC<br>

Friday, September 14 (12:30-1:20 p.m.)                 E224 CB<br>

Tuesday, September 18 (12:30-1:20 p.m.)             114 BHC<br>

Wednesday, October 3 (11:30-12:20 p.m.)            114 BHC<br>

Thursday, October 4 (3:30-4:20 p.m.)                      224 NH<br>

Monday, October 8 (1:30-2:20 p.m.)                        114 BHC<br>

Tuesday, October 16 (3:30-4:20 p.m.)                     E224 CB<br>

Monday, October 22 (1:30-2:20 p.m.)                     114 BHC<br>

Tuesday, October 30 (3:30-4:20 p.m.)                     E224 CB<br>

Monday, Sept. 24 (4:30-5:20 p.m.), 134 BHC <br>

Tuesday, Sept 25 (2-2:50 p.m.), 134 BHC<br>
<br>

 

You will soon receive an email regarding further approval procedures.<br>

 As a reminder, you will not receive full access to edit your profile until you have been approved as a tutor.<br>

 

 Best,<br>

The Tutor Iowa Team<br>"; 

		//$emailHolder = DataObject::get_one("EmailHolder");
		$emailHolder = EmailHolder::get()->first();
		$body = $emailHolder->RegistrationRequest;
	    
        $email = new Email(); 
	    $email->setTo($Member->Email); 
	    $email->setFrom(Email::getAdminEmail()); 
	    $email->setSubject($subject); 
	    $email->setBody($body); 
	    $email->send();  
	    
	    Session::set('Saved', 1);
            
        
         if($ProfilePage = EditProfilePage::get()->first()) //$ProfilePage = DataObject::get_one('EditProfilePage'))
        {
	         return $this->redirect($ProfilePage->Link('?success=1'));
        }
        
    }  
    
    
    
   
   
}
     
