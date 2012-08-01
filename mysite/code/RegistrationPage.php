<?php

 
class RegistrationPage extends Page {
   static $db = array(
   );
   static $has_one = array(
   );
   
   static $defaults = array ('ProvideComments' => '1',
    
   
    
    );
   
}
 
class RegistrationPage_Controller extends Page_Controller {

    //Allow our form as an action
    static $allowed_actions = array(
        'RegistrationForm'
    );
     
    //Generate the registration form
    function RegistrationForm()
    {
        $fields = new FieldSet(
            
            new TextField('FirstName', '<span>*</span> First Name'),
            new TextField('Surname', '<span>*</span> Last Name'),
            new CustomEmailField('Email', '<span>*</span> UIowa Email Address'),
            new ConfirmedPasswordField('Password', '<span>*</span> Password'),
            new UniversityIDField('UniversityID', 'University ID'),
            new TextField('Major')
                     
        );
        
      
         
        // Create action
        $actions = new FieldSet(
            new FormAction('doRegister', 'Register')
        );
        // Create action
        $validator = new RequiredFields('FirstName', 'Email', 'Password');
 
        return new Form($this, 'RegistrationForm', $fields, $actions, $validator);      
    }
    
    public function getEmails(){
	    return DataObject::get("MemberManagement");
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
            //Set form data from submitted values
            Session::set("FormInfo.Form_RegistrationForm.data", $data);     
            //Return back to form
            return Director::redirectBack();;          
        }   
 
        //Otherwise create new member and log them in
        $Member = new Member();
        $form->saveInto($Member); 
        
        
                   
        $Member->write();
        $Member->login();
         
          
        $TutorPage = new TutorPage();
        
        $tutorParent = DataObject::get_one('TutorHolder'); //There's only one tutor holder in DB
        $TutorPage->setParent($tutorParent); //Sets the tutor holder to hold new tutor pages
        
      
        
        //Flesh out page info
        $TutorPage->Title = $Member->Name;
        
        //Some or all of these are not necessary
        $TutorPage->MetaTitle = $Member->Name;
        $TutorPage->ShowInSearch = 1; 
        $TutorPage->MetaKeywords = $Member->Name;
        $TutorPage->ProvideComments = 1;
        
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
            
        foreach ($emailArray as $recip){ //emailArray defined in EmailArray.php
        	
        	$subject = "TutorIowa Application Notification";
        	$body = "Administrator,<br><br>The following individual has registered to be a tutor on Tutor Iowa:<br><br>" . "Name: " . $Member->FirstName . " " . $Member->Surname . 
        	"<br> Email: " . $TutorPage->Email . "<br> University ID: " . $TutorPage->UniversityID . "<br>Major: " . $TutorPage->Major . "        	
        	<br><br>Confirm user <a href='" . Director::absoluteBaseURL() . "admin/show/" . $TutorPage->ID . "'>here </a/>";  
        	
        	
        	//Confirm user  <a href='http://localhost/admin/show/". $TutorPage->ID . "'>here </a/>";      	
        	//$headers = "From: Tutor Iowa";       	
	        //mail($recip->Email, $subject, $body);
	        
	         $email = new Email(); 
	         $from = "Tutor Iowa";
	         $email->setTo($recip->Email); 
	         
	         $email->setFrom($from); 
	         $email->setSubject($subject); 
	         $email->setBody($body); 
	         $email->send(); 
	         	         
	    }
	    
	    $subject = "TutorIowa Application Confirmation";
	    $body = "Thank you for registering to be a tutor on Tutor Iowa. <br><br>  You will soon receive an email regarding further approval procedures and training sessions. <br><br>
	    
	    As a reminder, you will not receive full access to edit your profile until you have been approved as a tutor.<br><br>
	    
	    Best, <br>
	    The Tutor Iowa Team"; 
	    
        $email = new Email(); 
	    $email->setTo($Member->Email); 
	    $email->setFrom(Email::getAdminEmail()); 
	    $email->setSubject($subject); 
	    $email->setBody($body); 
	    $email->send();  
	    
	    
            
        
         if($ProfilePage = DataObject::get_one('EditProfilePage'))
        {
	         return Director::redirect($ProfilePage->Link('?success=1'));
        }
        
    }  
    
   
   
}
     
