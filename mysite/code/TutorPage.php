<?php

class TutorPage extends Page {
 	
 	
    //Add extra database fields
    
            static $db = array(
                "Bio" => "Text",
                "PhoneNo" => 'Varchar',
                "Hours" => 'Varchar',
                "Disabled" => 'Boolean',
                "Approved" => 'Boolean',
                "Name" => "Text",
                "StartDate" => 'Date',
                "EndDate" => "Date",
                "Email" => 'Text',
                "Notes" => 'Text',
                "HourlyRate" => 'Text',
                "MeetingPreference" => 'Text',
                "AcademicStatus" => 'Text',
                "UniversityID" => 'Int',
                "Major" => 'Text',
                                    
                );
                
                           
       
             
             static $has_one = array(
             	'Member' => 'Member',
             	'AcademicHelp' => 'AcademicHelp',
             );
             /*
             static $defaults = array(
                'Disabled' => 'False'
             ); 
             */
             
             static $defaults = array ('ProvideComments' => '1',
             'Disabled' => '0',
             'Approved' => '0',
             //Hi
    
   );
       
    //Add form fields to CMS
    
    public function getCMSFields() 
    {
    
    	$fields = parent::getCMSFields();
             
        $fields->removeFieldFromTab('Root.Content.Metadata', "Keywords"); 
        $fields->removeFieldFromTab('Root.Content.Main', "Content");
        $fields->addFieldToTab( 'Root.Content.Main', new TextField("Name", "Tutor name (Tutor name and Page name can be the same)"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextField("PhoneNo", "Phone Number"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextField("Email"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextAreaField("MetaKeywords", "Tags"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextAreaField("Bio", "Biography"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextAreaField("Notes", "Notes (used for internal purposes, not visible on site):"));
        
      
       
       
        return $fields;
        
     } 
     
    public function getEmails(){
	    return DataObject::get("MemberManagement");
    }
     
     function onAfterPublish(){
     
     	//Currently all emails go to me (Drew Parker)
	 	
	 	$approved =  $this->Approved;
	 	
	    

	 	
	 	//Only want onAfterPublish to send a confirmation email the first time            
	   //if ($approved==0){ 	
        	
         
        	
			$subject = "Confirmation email";
		    $body = "Congratulations -- your registration for Tutor Iowa has been confirmed! You can edit your details now <a href='" . Director::absoluteBaseURL() . "edit-profile-page'>here</a/><br>
		    "; 
		         	
		    //$headers = "From: Tutor Iowa";       	
		    //mail($recip->Email, $subject, $body);
		    
		    
	        
		    $email = new Email(); 
		    $email->setTo($this->Email); 
		    $email->setFrom(Email::getAdminEmail()); 
		    $email->setSubject($subject); 
		    $email->setBody($body); 
		    $email->send(); 
	   // }
	    
	    $this->Approved = 1;
	    $this->write();
	   
	   
	   /*
	   $MemberID = $this->MemberID;
	   
	   $isDisabled = DataObject::get_one("IsDisabled", "MemberID = $MemberID");
	   $isDisabled->Disabled = 0;
	   
	   $isDisabled->write();  
	   */
     }
     
     //Doesn't run
     function onBeforeUnpublish(){
     
	     print "<script>alert('THIS IS GETTING CALLED');</script>";
	     
	     $subject = "Your Tutor Iowa page has been disabled";
		 $body = "You can request your details be edited <a href='" . Director::absoluteBaseURL() . "edit-profile-page'>here</a/> "; 
		         	 
		 $email = new Email(); 
		 $email->setTo($this->Email); 
		 $email->setFrom(Email::getAdminEmail()); 
		 $email->setSubject($subject); 
		 $email->setBody($body);
		 $email->send(); 
		 
		 $this->Approved = 0;
	     $this->write();
		 
		 $test = DataObject::get("Member", "Surname='Clashman'");
		 $test->Surname = "alacabash";
		 $test->write();
	}
          
    

    //This function is no longer being used
    function populateTemplate() {
	 if (isset($_GET['ID'])){
	 	$ID = $_GET['ID'];
	 	if (is_int(intval($ID))){
	  		$templateInfo = DataObject::get_by_id("SupplementalInstruction", $ID);
	  		return $templateInfo;
	  	}
	 }
  }
  
}


class TutorPage_Controller extends Page_Controller { 
		
    
} 