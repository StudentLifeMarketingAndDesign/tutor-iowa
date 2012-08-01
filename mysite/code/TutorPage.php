<?php

class TutorPage extends Page {
 	
 	
    //Add extra database fields
    
            static $db = array(
                "Bio" => "Text",
                "PhoneNo" => 'Varchar',
                "Hours" => 'Text',
                "Disabled" => 'Boolean',
                "Approved" => 'Boolean',
                "FirstName" => "Text",
                "Surname" => "Text",
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
            
             
             //Hi
    
   );
       
    //Add form fields to CMS
    
    public function getCMSFields() 
    {
    
    	$fields = parent::getCMSFields();
             
        $fields->removeFieldFromTab('Root.Content.Metadata', "Keywords"); 
        $fields->removeFieldFromTab('Root.Content.Main', "Content");
        $fields->addFieldToTab( 'Root.Content.Main', new TextField("FirstName", "First name of tutor"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextField("Surname", "Last name of tutor"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextField("PhoneNo", "Phone Number"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextField("Email"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextAreaField("MetaKeywords", "Tags"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextAreaField("Content", "Biography"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextAreaField("Hours", "Availability"));

        $fields->addFieldToTab( 'Root.Content.Main', new TextAreaField("Notes", "Notes (used for internal purposes, not visible on site)"));
        $fields->addFieldToTab( 'Root.Content.Main', new DateField("StartDate", "Date you plan to start tutoring"));
        $fields->addFieldToTab( 'Root.Content.Main', new DateField("EndDate", "Date you expect to stop tutoring"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextField("HourlyRate", "Hourly rate"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextField("MeetingPreference", "Meeting preference (on-campus or off-campus)"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextField("UniversityID", "University ID"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextField("Major"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextField("AcademicStatus", "Academic Status"));
        
      
      
       
       
        return $fields;
        
     }
     
    public function SplitKeywords(){
	    $keywords = $this->MetaKeywords;
	    
	    if($keywords){
		   $splitKeywords = explode(',', $keywords); 
	    }
	    
	    if($splitKeywords){
			$keywordsList = new DataObjectSet(); 
			foreach($splitKeywords as $data) { 
				$do=new DataObject(); 
				$do->Keyword = $data; 
				$keywordsList->push($do); 
			} 
			return $keywordsList; 
			}
    }
     
    public function getEmails(){
	    return DataObject::get("MemberManagement");
    }
     
     function onAfterPublish(){
     
     		 	
	 	$approved =  $this->Approved;
	 	
	    

	 	
	 	//Only want onAfterPublish to send a confirmation email the first time            
	   //if ($approved==0){ 	
        	
         
        	
			$subject = "TutorIowa approval confirmation";
		    $body = "Congratulations -- you have been approved as a tutor on Tutor Iowa.  You now have full
		    access to edit your profile.  Please check out this  <a href='http://tutor.uiowa.edu/for-tutors'>link</a> to learn how to effectively use tags and efficiently use the website.  
		    "; 
		    
		    
		    ////You can edit your details now <a href='" . Director::absoluteBaseURL() . "edit-profile-page'>here</a/><br>     	
		    //$headers = "From: Tutor Iowa";       	
		    //mail($recip->Email, $subject, $body);
		    
		    
	        
		    $email = new Email(); 
		    $email->setTo($this->Email); 
		    $email->setFrom(Email::getAdminEmail()); 
		    $email->setSubject($subject); 
		    $email->setBody($body); 
		    $email->send(); 
	   // }
	    
	    //$this->Approved = 1;
	    //$this->write();
	   
	   
	   /*
	   $MemberID = $this->MemberID;
	   
	   $isDisabled = DataObject::get_one("IsDisabled", "MemberID = $MemberID");
	   $isDisabled->Disabled = 0;
	   
	   $isDisabled->write();  
	   */
     }
     
     //Doesn't run
     /*
     function onAfterUnpublish(){
     
     	user_error("breakpoint", E_USER_ERROR);
     	
	     print "<script>alert('THIS IS GETTING CALLED');</script>";
	     
	     $subject = "Your Tutor Iowa page has been disabled";
		 $body = "You can request your details be edited <a href='" . Director::absoluteBaseURL() . "edit-profile-page'>here</a/> "; 
		         	 
		 $email = new Email(); 
		 $email->setTo("andrew-parker-1@uiowa.edu"); 
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
   */ 
        
}


class TutorPage_Controller extends Page_Controller { 




    function ContactForm(){
     
     	
	   	$fields = new FieldSet(
	   	new TextField('Email', '<span>*</span> Your Email Address'),
	   	new TextAreaField('Body',  '<span>*</span> Your Message to '.$this->Member()->FirstName)
	   
	   	);
	   	
	   	$actions = new FieldSet(
            new FormAction('doContactTutor', 'Contact Tutor')
            
        );
        
        $validator = new RequiredFields('Email');
        
        return new Form($this, 'ContactTutor', $fields, $actions, $validator);
        
	   
    }
    
    function doContactTutor($data,$form){
	    
	    $subject = "A student has requested you as a tutor";
	    //$body = "Sent by " . $data["Email"] . "<br><br>" . $data["Body"];
	    
	    $from = $data["Email"];
	    $body = $data["Body"];
		         	 
	    $email = new Email(); 
	    $email->setTo($this->Email); 
	    $email->setSubject($subject); 
	  	$email->setFrom($from);
	    $email->setBody($body);
	    $email->send(); 
	    	
	    return Director::redirect($this->Link('?saved=1'));   
	    	
	    
    }


function Saved()
    {
        return $this->request->getVar('saved');
    }
  
		
    
} 