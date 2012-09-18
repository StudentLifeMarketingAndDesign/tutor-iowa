<?php

/**
 * 
 
 It is my assumption that Disable Page can only be reached from the EditProfilePage and hence there is no checking for whether there is a current member on this page (it's assumed since you have to be logged in to access the Edit Profile Page)
 */
 
class DisablePage extends Page {
   static $db = array(
   );
   static $has_one = array(
   );
   
   static $defaults = array ('ProvideComments' => '1',
    
   
    
    );
   
   
}
 
class DisablePage_Controller extends Page_Controller {
     
     static $allowed_actions = array(
        'DisableForm',
        
     );
    
   
     
     function DisableForm(){
     
     	
	   	$fields = new FieldSet(
	   
	   	);
	   	
	   	$actions = new FieldSet(
            new FormAction('doDisablePage', 'Disable Page')
        );
        
        return new Form($this, 'DisableForm', $fields, $actions);
	   
    }
    
    function doDisablePage(){
	    
	    $CurrentMember = Member::CurrentMember();
	    /*
	    Versioned::set_reading_mode('stage');
	    $ID = 92;
		$test = DataObject::get_by_id('TutorPage', $ID);
		return Debug::show($test);
		*/
	    
	    if ($CurrentMember){
	    
		    $IDMember = $CurrentMember->ID;
	            	
	        $Tutor = DataObject::get_one("TutorPage", "MemberID = $IDMember"); 
		    
		    include 'EmailArray.php'; //Gets members of security group that should be notified about user registration 
		    
		    
		    $userEmail = $CurrentMember->Email;
		    
		  	  if (isset($emailArray)){   
			    foreach ($emailArray as $recip){ //$emailArray defined in EmailArray.php
		        	
		        	        	
		        	$subject = "User has requested their account be disabled"; 
		        	      	
		        	$body = "User email: " . $userEmail . "
		        	
		        
		         
		        
		        	Disable account  <a href='" . Director::absoluteBaseURL() .  "admin/show/" . $Tutor->ID . "'>here</a/>";        	
		        	//$headers = "From: Tutor Iowa";       	
			        //mail($recip->Email, $subject, $body);
			      	        
			         $email = new Email(); 
			         $email->setTo($recip->Email); 
			         $email->setFrom(Email::getAdminEmail()); 
			         $email->setSubject($subject); 
			         $email->setBody($body); 
			         $email->send(); 
			         
			    }
			  }
			    
			    $subject = "The disabling of your Tutor Iowa page is pending";
			    $body = "We will remove you as a tutor from the Tutor Iowa website as soon as possible.  If you want to enable your account again, you can log in to the Tutor Iowa website and click on the Edit Profile Page at the top of the screen.  That page will have a link to request to enable your account.<br><br>
			    
			    Best, <br>
			    The Tutor Iowa Team<br>"; 
			    
			    $emailHolder = DataObject::get_one("EmailHolder");
			    $body = $emailHolder->RegistrationConfirm;
			    
		        $email = new Email(); 
			    $email->setTo($CurrentMember->Email); 
			    $email->setFrom(Email::getAdminEmail()); 
			    $email->setSubject($subject); 
			    $email->setBody($body); 
			    $email->send();
		
			    return Director::redirect($this->Link('?saved=1'));
			 }
			  
		
	  
	  else {
		  $message = "You must be <a href='" . Director::baseURL() . "/Security/login'>logged</a> in to edit your profile!";
		  return $message;
		  
	  }

    }
   
  
    
    //Not in use
    public function ID()
    {
        return $this->request->getVar('ID');
    }
    
    //Displays message specified in template if disable page request successful
      function Saved()
    {
        return $this->request->getVar('saved');
    }
    
    //Used to check on DisablePage if user has been published yet -- if user has not been published, the disable page form should not appear
    function notPublished()
    
    {
    	
    	$member = Member::CurrentMember();
    	$IDMember = $member->ID;
    	$TutorPage = DataObject::get_one("TutorPage", "MemberID = $IDMember");
    	$notTutorPage = !($TutorPage instanceof TutorPage); 
    	return $notTutorPage;
    	
    }
}