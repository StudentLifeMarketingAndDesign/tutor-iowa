<?php
/**
 * Defines the EditProfilePage page type
 */
 
class EditProfilePage extends Page {
   private static $db = array(
   		'Test' => 'Text',
   );
   private static $has_one = array(
   	
   );
   
   private static $defaults = array ('ProvideComments' => '1',
    
   
    
    );
    
     function getSavedSession(){
    	$returning = '' . Session::get('Saved');
	    return $returning;
    }
   
}
 
class EditProfilePage_Controller extends Page_Controller 
{
    public static $allowed_actions = array(
        'EditProfileForm',
        'getSavedSession'
    );
    
     
 
 
    function EditProfileForm()
    {	
	     $Member = Member::CurrentUser();
	   
	     //chromephp::log('EditProfileForm start' . Session::get('saved'));
	       
	     
	     if ($Member){	
	        //User shouldn't be able to access EditProfileForm unless they're logged in.  If they're not logged in, provide links so that they can login (or register if need be).  
	        	        
	        $IDMember = $Member->ID;

	        //$Tutor = DataObject::get_one("TutorPage", "MemberID = $IDMember"); 
	        $Tutor = TutorPage::get()->filter(array('MemberID' => $IDMember))->first();

	        
	        $tagsLabel = '<p>Read the <a href="for-tutors/">For Tutors page</a> to learn more about tags and promoting yourself on Tutor Iowa!</p>';
	        $changePassLabel = '<p><a href="Security/ChangePassword" class="button small radius">Reset your password</a></p>';
	        $fields = new FieldList(
	            new TextField('FirstName', '<span>*</span> First Name'),
	            new TextField('Surname', '<span>*</span> Last Name'),
	            new UploadField("Image", "Photo"),
	            new UploadField("BackgroundImage", "Background Image"),
	            new EmailField('Email', '<span>*</span> Email Address'),
	            new LiteralField('ChangePassword', $changePassLabel),
	            new TextareaField('Content', 'Biography'),
	            new TextareaField('Hours', 'Availability'),
	            new DateField('StartDate', 'Date you would like to start tutoring'),
	            new DateField('EndDate', 'Date you expect to stop tutoring'),
	            new TextField('PhoneNo', 'Phone number'),
	            new TextField('MeetingPreference', 'Meeting preference (on and/or off-campus)'),
	            new TextField('HourlyRate', 'Hourly rate'),
	            new TextField('AcademicStatus', 'Status (undergrad, grad, faculty, staff)'),
	            new TextField('GPA'),
	            new UniversityIDField('UniversityID', 'University ID'),
	            new TextField('Major'),
	            new LiteralField('TagsHelpLabel', $tagsLabel),

	            //new TagField('Tags', 'Tags'),
	            
	            
	            //This does not sync with database (database field is 'Disabled')
	            new CheckboxField('Disable', 'Request to disable your page (will no longer be returned as a search result on TutorIowa)')
	
	            
	        );
	         $saveAction = new FormAction('SaveProfile', 'Save');
	         $saveAction->addExtraClass('radius');
	        // Create action
	        $actions = new FieldList(
	            $saveAction
	        );
	        
	      
	
	         
	        // Create action
	        $validator = new RequiredFields('FirstName', 'Surname', 'Email');
	        
	       //Create form
	        $Form = new FoundationForm($this, 'EditProfileForm', $fields, $actions, $validator);
	 
	        //Get current member
	        $Member = Member::CurrentUser();
	              
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
	     	//Shouldn't happen with current design unless user tries to navigate there directly (there is no link to edit profile when you're not logged in)
	     	$message = "You must be <a href='Security/login'>logged</a> in to edit your profile.  If you do not have an account, register <a href='registration-page'>here.</a>";
	     	return $message;
	     }
    }
     
    //Save profile
    function SaveProfile($data, $form)
    {
    	Session::clear('Saved'); 
    	//chromephp::log('Enters save profile');
    	
        //Check for a logged in member
        if($CurrentMember = Member::CurrentUser())      
        {
        
        	//chromephp::log('Current member entered');
        	
        	        	
            //Check for another member with the same email address
            
            $email = Convert::raw2sql($data['Email']);
            
            if($member = DataObject::get_one("Member", "Email = '". Convert::raw2sql($data['Email']) . "' AND ID != " . $CurrentMember->ID))
             
            {
            
            	Session::set('Saved', 0); //Display error message
                //chromephp::log('After Email error ' . Session::get('saved'));
                
               
            	
                $form->addErrorMessage("Email", 'Sorry, an account with that Email address already exists', "bad");
                
                                
                     
                Session::set("FormInfo.Form_EditProfileForm.data", $data);
                
               
                return $this->redirect($this->Link());
            
            }
            //Otherwise check that user IDs match and save
            else
            {
            
            	Session::set('Saved', 1); //Changes saved
            	//chromephp::log('After successful validation ');
            	//chromephp::log(Session::get('Saved'));
            	//chromephp::log(Session::get_all());
            
            	$IDMember = $CurrentMember->ID;
            	
            	//$Tutor = DataObject::get_one("TutorPage", "MemberID = $IDMember"); 
            	
            	$Tutor = TutorPage::get()->filter(array('MemberID' => $IDMember))->first();
            
                $form->saveInto($Tutor);  
                
                /*Preserve this code, for it works the magic of SilverStripe 3 publishing*/
                Versioned::reading_stage('stage');
                
                $Tutor->writeToStage('Stage');
              
                $Tutor->publish("Stage", "Live");
                
                Versioned::reading_stage('Live');
                
                $Tutor->write();
                
                
                //$Tutor->write();	
                
                
                //$Tutor->doPublish();
                
           
                 //TODO: Rewrite this so that we're only saving essential Member fields to Member. not the whole form.           
                $form->saveInto($CurrentMember); 
                 
                $CurrentMember->write();
                
                $formData = $form->getData();
                $formDisabled = $formData['Disable'];
                
                if ($formDisabled){//If user checked disable page box
                	
	                if($DisablePage= DisablePage::get()->First()) //$DisablePage = DataObject::get_one('DisablePage'))
	                	{
	                		
	                		$parameter = '?ID=' . $Tutor->ID;
	                		
		                	return $this->redirect($DisablePage->Link($parameter));
		                }
		            
		        }
		        $ID = 92;
		        //$test = DataObject::get_by_id('TutorPage', $ID);
		        $test = TutorPage::get()->byID($ID);
		        /*
		        $notSaved = Session::get('ValidationError');
		        Debug::show($notSaved);
		        
		        if ($notSaved){
		        	$form->addErrorMessage("Name", 'An error occurred with one or more fields.', "bad");
		        	Session::set('ValidationError', false);
		        	Session::set("FormInfo.Form_EditProfileForm.data", $data);
			        return Director::redirect($this->Link());
		        }
		        */
		        
		        //$savedValue = Session::get('Saved');
		        //print_r('Saved ' . $savedValue);
		        //user_error("breakpoint", E_USER_ERROR);
		        
		        
                return $this->redirect($this->Link());                              
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
    	$saved = Session::get('Saved');
    	//chromephp::log('When Saved gets called ');
    	//chromephp::log($saved);
    	if ($saved == 1){
	        return true;
        }
        else {
	        return false;
        }
        
    }
    
    //Check if there was error while saving
    function notSaved()
    {
    	$saved = Session::get('Saved');
    	//chromephp::log('When notSaved gets called ');
    	//chromephp::log($saved);
        if ($saved === 0){
	        return true;
        }
        else {
	        return false;
        }
    }   
    
    public function ClearSession(){
	    Session::clear('Saved');
    }
     
    //Check if user succesfully registered (they are redirected to this page from RegistrationPage.php if registration was successful)
    function Success()
    {
        return $this->request->getVar('success');
    }
    
 
    function Enable(){
    
    	if ($this->request->getVar('enable') == 1){
    	
		    $CurrentMember = Member::CurrentUser();

		    
		    $IDMember = $CurrentMember->ID;

		    include 'EmailArray.php'; //Gets members of security group that should be notified about user registration 
		    		    
		    $userEmail = $CurrentMember->Email;		    
		    
		    //$Tutor = DataObject::get_one("TutorPage", "MemberID = $IDMember"); 
		    $Tutor = TutorPage::get()->filter(array('MemberID' => '$IDMember'))->First();
		    //return Debug::show($IDMember);
		    
		    
		    if (!$Tutor){
			    Versioned::reading_stage('Stage');
			    //$Tutor = DataObject::get_one("TutorPage", "MemberID = $IDMember");
			    $Tutor = TutorPage::get()->filter(array('MemberID' => $IDMember))->First(); 
		    }		    		  
		    	  	    
		    foreach ($emailArray as $recip){ //$emailArray defined in EmailArray.php
	        	
	        	        	
	        	$subject = $CurrentMember->FirstName." ".$CurrentMember->Surname." has requested their account be enabled"; 
	        	
	        		
	        $body = $CurrentMember->FirstName." ".$CurrentMember->Surname." has requested their account be enabled. " . "Enable account  <a href='" . Director::absoluteBaseURL() .  "admin/pages/'>in the content management system here.</a/><br><br>
	      
		    
		    Best, <br>
		    The Tutor Iowa Team<br>";     //changed $IDmember nd $tutor to Controller::curr()    	
	        	//$headers = "From: Tutor Iowa";       	
		        //mail($recip->Email, $subject, $body);
		      	        
		         $email = new Email(); 
		         $email->setTo($recip->Email); 
		         $email->setFrom(Email::getAdminEmail()); 
		         $email->setSubject($subject); 
		         $email->setBody($body); 
		         $email->send(); 
		         
		    }
		    
		    
		    $subject = "The enabling of your Tutor Iowa account is pending";
		    
		    $body = "You will receive another email once your account has been enabled by one of our administrators.<br><br>
		    
		    Best, <br>
		    The Tutor Iowa Team<br>"; 
		    
		    //$emailHolder = DataObject::get_one("EmailHolder");
		    $emailHolder = EmailHolder::get()->first(); 
		    $body = $emailHolder->EnablePage;
		    
	        $email = new Email(); 
		    $email->setTo($CurrentMember->Email); 
		    $email->setFrom(Email::getAdminEmail()); 
		    $email->setSubject($subject); 
		    $email->setBody($body); 
		    $email->send();
		    		    
		    Versioned::reading_stage('Live');	
	}   
	    return $this->request->getVar('enable');
    }     
}