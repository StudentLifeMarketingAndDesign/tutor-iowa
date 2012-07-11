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
            new TextField('Name', '<span>*</span> Name'),
            new EmailField('Email', '<span>*</span> Email'),
            new ConfirmedPasswordField('Password', '<span>*</span> Password'),
            new TextField('UniversityID', 'University ID'),
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
    
    //Submit the registration form
    function doRegister($data,$form)
    {
        //Check for existing member email address
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
         
        //Code to put users into user groups
        
        /*
        if(!$userGroup = DataObject::get_one('Group', "Code = 'page-3'"))
        {
        	$userGroup = new Group();
            $userGroup->Code = "users";
            $userGroup->Title = "Users";
            $userGroup->Write();
            $userGroup->Members()->add($Member);
        }
        
        $userGroup->Members()->add($Member);
        */
        
        
        $TutorPage = new TutorPage();
        
        $tutorParent = DataObject::get_one('TutorHolder'); //There's only one tutor holder in DB
        $TutorPage->setParent($tutorParent); //Sets the tutor holder to hold new tutor pages
        
      
        
        //Flesh out page info
        $TutorPage->Title = $Member->Name;
  
        $TutorPage->MetaTitle = $Member->Name;
        $TutorPage->ShowInSearch = 1; //not necessary, default is 1
        $TutorPage->MetaKeywords = $Member->Name;
        $TutorPage->ProvideComments = 1;
        
        $form->saveInto($TutorPage); 
        
        //Place "foreign key" from member into tutor page
        $insertMemberID = $Member->ID;        
        $TutorPage->MemberID = $insertMemberID;
      
         
        
       
        $TutorPage->URLSegment = $TutorPage->ID;  
        $TutorPage->writeToStage('Stage'); //Kate handles publishing
        //$TutorPage->publish('Stage'); //
        
    
        
        //DataObject::get_one('Group', "Code = 'page-3'")
        
       
        
       
        //Change title at far-right of statement to change group that gets notifications of users registering
        //select * from Member where ID in (select MemberID from Group_Members where GroupID = (select ID from `Group` where title='Content Authors'))
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
	       
	         $email->setTo($recip->Email); 
	         
	         $email->setFrom(Email::getAdminEmail()); 
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
     
