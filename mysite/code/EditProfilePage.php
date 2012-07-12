<?php
/**
 * Defines the EditProfilePage page type
 */
 
class EditProfilePage extends Page {
   static $db = array(
   		'Test' => 'Text',
   );
   static $has_one = array(
   );
   
   static $defaults = array ('ProvideComments' => '1',
    
   
    
    );
   

}
 
class EditProfilePage_Controller extends Page_Controller 
{
    static $allowed_actions = array(
        'EditProfileForm'
    );
 
    function EditProfileForm()
    {	
	     $Member = Member::CurrentMember();
	     	     
	     
	     if ($Member){	
	        //User shouldn't be able to access EditProfileForm unless they're logged in.  If they're not logged in, provide links so that they can login (or register if need be).  
	        	        
	        $IDMember = $Member->ID;
	        $Tutor = DataObject::get_one("TutorPage", "MemberID = $IDMember"); 
	     
	        $fields = new FieldSet(
	            new TextField('Name', '<span>*</span> Name (or Nickname)'),
	            new EmailField('Email', '<span>*</span> Email'),
	            new ConfirmedPasswordField('Password', 'New Password'),
	            new TextareaField('Bio', 'Bio'),
	            new TextField('Hours'),
	            new DateField('StartDate', 'Date you would like to start tutoring'),
	            new DateField('EndDate', 'Date you expect to stop tutoring'),
	            new TextField('PhoneNo', 'Phone Number'),
	            new TextField('MeetingPreference', 'Meeting preference (on and/or off-campus)'),
	            new TextField('HourlyRate', 'Hourly Rate'),
	            new TextField('AcademicStatus', 'Status (undergrad, grad, faculty, staff)'),
	            new TextareaField('MetaKeywords', 'Tags'),
	            //This does not sync with database (database field is 'Disabled')
	            new CheckboxField('Disable', 'Request to disable your page (will no longer be returned as a search result on TutorIowa)')
	
	            
	        );
	         
	        // Create action
	        $actions = new FieldSet(
	            new FormAction('SaveProfile', 'Save')
	        );
	         
	        // Create action
	        $validator = new RequiredFields('FirstName', 'Email');
	        
	       //Create form
	        $Form = new Form($this, 'EditProfileForm', $fields, $actions, $validator);
	 
	        //Get current member
	        $Member = Member::CurrentMember();
	              
	        //Get tutor dataobject to populate form with tutor info (stuff like bio that's stored in tutor table)
	       	        	        
	        //Information must be loaded from both tutor and member because member stores a member/tutor's password
	         $Form->loadDataFrom($Member->data());
	         
	       
	         ///$Check if user is published yet
	         if ($Tutor instanceof TutorPage){	 //Tutor is published        	
	         	$Form->loadDataFrom($Tutor->data());   
	         }
	         else { //Not published (disabled and unapproved users).  The enable function is at at the bottom and handles sending the emails 	         	
		        return 'You must be confirmed as a user by our administrator to edit your profile.  If you have disabled your account, please click <a href="'. Director::baseURL() . $this->URLSegment . '?enable=1' . '">here</a> to have your account re-enabled.';
		     }
	      
	        //Return the form
	        return $Form;
	     }
	     else {
	     	//Insert not logged in page stuff here
	     	$message = "You must be <a href='/Security/login'>logged</a> in to edit your profile.  If you do not have an account, register <a href='registration-page'>here.</a>";
	     	return $message;
	     }
    }
     
    //Save profile
    function SaveProfile($data, $form)
    {
        //Check for a logged in member
        if($CurrentMember = Member::CurrentMember())
        {
            //Check for another member with the same email address
            if($member = DataObject::get_one("Member", "Email = '". Convert::raw2sql($data['Email']) . "' AND ID != " . $CurrentMember->ID)) 
            {
                $form->addErrorMessage("Name", 'Sorry, that Name already exists.', "bad");
                     
                Session::set("FormInfo.Form_EditProfileForm.data", $data);
                     
                return Director::redirectBack();
            }
            //Otherwise check that user IDs match and save
            else
            {
            
            	$IDMember = $CurrentMember->ID;
            	
            	$Tutor = DataObject::get_one("TutorPage", "MemberID = $IDMember"); 
            	
            	//The purpose of this coming block is to unpublish a user's page 
            	
                $formData = $form->getData();
      
                $formDisabled = $formData["Disable"];
                /*
	            if ($formDisabled == 1){
		        	$Tutor->doUnpublish('Stage', 'Live');
		            $returned = "unpublished " . "Form = " . $formDisabled . "Tutor = " . $tutorDisabled;
		            $disableAcct = 1;
		                
		       
		               
	             }
	                
	                elseif ($formDisabled == 0) {
	                
		                $Tutor->doPublish('Stage', 'Live');
		                
		                $returned = "published " . "Form = " . $formDisabled . "Tutor = " . $tutorDisabled;
		                //if (is_null($formData)){
		                	//return "TOTALLY NULL";
		                //}
		                
		            }
		            */
                

            	
                $form->saveInto($Tutor); 
                                
                $Tutor->write();
                                
               
                
                $form->saveInto($CurrentMember); 
                 
                $CurrentMember->write();
                
                if ($formDisabled){//If user checked disable page box
                	
	                if($DisablePage = DataObject::get_one('DisablePage'))
	                	{
	                		
	                		$parameter = '?ID=' . $Tutor->ID;
	                		
		                	return Director::redirect($DisablePage->Link($parameter));
		                }
		            
		        }
 
                return Director::redirect($this->Link('?saved=1'));                              
            }
        }
        //If not logged in then return a permission error
        else
        {
            return Security::PermissionFailure($this->controller, 'You must <a href="register">registered</a> and logged in to edit your profile:');
        }
        
        
    }       
    
    //Check for just saved
    function Saved()
    {
        return $this->request->getVar('saved');
    }
     
    //Check for success status
    function Success()
    {
        return $this->request->getVar('success');
    }
    
    function Enable(){
    
    	if ($this->request->getVar('enable') == 1){
    	
		    $CurrentMember = Member::CurrentMember();
		    
		    //$IDMember = $CurrentMember->ID;
	            	
	        //$Tutor = DataObject::get_one("TutorPage", "MemberID = $IDMember"); 
		    
		    include 'EmailArray.php'; //Gets members of security group that should be notified about user registration 
		    
		    
		    $userEmail = $CurrentMember->Email;
		    
		  	    
		    foreach ($emailArray as $recip){ //$emailArray defined in EmailArray.php
	        	
	        	        	
	        	$subject = "User has requested their account be enabled"; 
	        	      	
	        	$body = $CurrentMember->FirstName . " " . $CurrentMember->Surname . " has requested their account be enabled.  You can find their account quickly by searching for a Tutor Page in the TutorIowa tab of the CMS with their first and last name as the page name to search for." . "Disable account  <a href='" . Director::absoluteBaseURL() .  "admin" . "'>here</a/>";        	
	        	//$headers = "From: Tutor Iowa";       	
		        //mail($recip->Email, $subject, $body);
		      	        
		         $email = new Email(); 
		         $email->setTo($recip->Email); 
		         $email->setFrom(Email::getAdminEmail()); 
		         $email->setSubject($subject); 
		         $email->setBody($body); 
		         $email->send(); 
		         
		    }
		    
		    $subject = "The disabling of your Tutor Iowa registration is pending";
		    $body = "This will be disabled ASAP, I swear."; 
		    
	        $email = new Email(); 
		    $email->setTo($CurrentMember->Email); 
		    $email->setFrom(Email::getAdminEmail()); 
		    $email->setSubject($subject); 
		    $email->setBody($body); 
		    $email->send();
	}   
	    return $this->request->getVar('enable');
    }     
}