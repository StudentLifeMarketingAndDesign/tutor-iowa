
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
        'DisableForm'
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
	    
	    $IDMember = $CurrentMember->ID;
            	
        $Tutor = DataObject::get_one("TutorPage", "MemberID = $IDMember"); 
	    
	    include 'EmailArray.php'; //Gets members of security group that should be notified about user registration 
	    
	    
	    $userEmail = $CurrentMember->Email;
	    
	  	//Sends disable account emails to appropriate security group(s)    
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
	    
	    //Sends disable message to user
	    $subject = "The disabling of your Tutor Iowa registration is pending";
	    $body = "We'll disable this ASAP, I swear."; 
	    
        $email = new Email(); 
	    $email->setTo($CurrentMember->Email); 
	    $email->setFrom(Email::getAdminEmail()); 
	    $email->setSubject($subject); 
	    $email->setBody($body); 
	    $email->send();

	    return Director::redirect($this->Link('?saved=1'));   
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