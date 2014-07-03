<?php

class TutorPage extends Page {
 	
 	
    //Add extra database fields
    
            public static $db = array(
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
                "UniversityID" => 'Text',
                "Major" => 'Text',
                "GPA" => 'Text',
                "PublishFlag" => 'Boolean'
                
                                    
                );
                
                           
       
             
             static $has_one = array(
             	'Member' => 'Member',
             	'AcademicHelp' => 'AcademicHelp',
             );
             
              static $has_many = array(
		 'FeedbackItems' => 'FeedbackItem'
   );
             /*
             static $defaults = array(
                'Disabled' => 'False'
             ); 
             */
             
             static $defaults = array ('ProvideComments' => '1',
             'UniversityID' => null,
             'GPA' => null
             
           
             
             //Hi
    
   );
   
   			 //static $test = 5;
             
       
    //Add form fields to CMS
    
    public function getCMSFields() 
    {
    
    	$fields = parent::getCMSFields();
    	
    	//$members = DataObject::get("Member");
    	$members = Member::get(); 
    	$membersDropdownSource = $members->Map('ID','Email');
             
        $fields->removeFieldFromTab('Root.Metadata', "Keywords"); 
        $fields->removeFieldFromTab('Root.Main', "Content");
        $fields->addFieldToTab( 'Root.Main', new TextField("FirstName", "First name of tutor"));
        $fields->addFieldToTab( 'Root.Main', new TextField("Surname", "Last name of tutor"));
        $fields->addFieldToTab( 'Root.Main', new TextField("PhoneNo", "Phone Number"));
        $fields->addFieldToTab( 'Root.Main', new TextField("Email"));
        $fields->addFieldToTab( 'Root.Main', new TextAreaField("MetaKeywords", "Tags"));
        $fields->addFieldToTab( 'Root.Main', new TextAreaField("Content", "Biography"));
        $fields->addFieldToTab( 'Root.Main', new TextAreaField("Hours", "Availability"));

        $fields->addFieldToTab( 'Root.Main', new TextAreaField("Notes", "Approved Courses And Notes"));
        $fields->addFieldToTab( 'Root.Main', new DateField("StartDate", "Date you plan to start tutoring"));
        $fields->addFieldToTab( 'Root.Main', new DateField("EndDate", "Date you expect to stop tutoring"));
        $fields->addFieldToTab( 'Root.Main', new TextField("HourlyRate", "Hourly rate"));
        $fields->addFieldToTab( 'Root.Main', new TextField("MeetingPreference", "Meeting preference (on-campus or off-campus)"));
        $fields->addFieldToTab( 'Root.Main', new TextField("UniversityID", "University ID"));
        $fields->addFieldToTab( 'Root.Main', new TextField("GPA", "GPA"));
        $fields->addFieldToTab( 'Root.Main', new TextField("Major"));
        $fields->addFieldToTab( 'Root.Main', new TextField("AcademicStatus", "Academic Status"));
        $fields->addFieldToTab('Root.Advanced', new DropdownField("MemberID", "Associated User", $membersDropdownSource)); 
        
        $gridFieldConfigFeedbackItems = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("FeedbackItem", "Feedback Items", $this->FeedbackItems(), $gridFieldConfigFeedbackItems);	
		$fields->addFieldToTab('Root.FeedbackItems', $gridfield);
                                  
       
        return $fields;
        
     }
     /*
     static function getTest(){
	     return $test;
     }
     */
     
     
     
    public function SplitKeywords(){
	    $keywords = $this->MetaKeywords;
	    
	    if($keywords){
		   $splitKeywords = explode(',', $keywords); 
	    }
	    
	    if($splitKeywords){
			$keywordsList = new ArrayList(); 
			foreach($splitKeywords as $data) { 
				$do=new DataObject(); 
				$do->Keyword = $data; 
				$keywordsList->push($do); 
			} 
			return $keywordsList; 
			}
    }
     
    public function getEmails(){
	    //return DataObject::get("MemberManagement");
	    return MemberManagement::get(); 
    }
    
    
    public function changeParent(){
    
    	    //When a user registers, the tutor is put under the "Provisional Tutors" TutorHolder in the CMS.  When the tutor is published, they are moved to the "Private Tutors" TutorHolder.  changeParent handles the moving of the tutorpage. 
    	    
    
		 //$tutorParent = DataObject::get_one('TutorHolder', "Title = 'Private Tutors'"); 
		 $tutorParent = TutorHolder::get()->filter(array('Title' => 'Private Tutors'))->first();
		 
		 //$parent = $this->getParent();
		 
		 //if ($parent->Title == $tutorParent->Title){
			 //$publish = false;
		 //}
		 //else {
			 //$publish = true;
		 //}
		 
		 $this->setParent($tutorParent); 
		 $this->write();
		 
		 //if ($publish == true){
			 //$this->doPublish();
		// }
		 
		 
	}
	
	function onBeforePublish(){
		$this->changeParent();
	}

  
     function onAfterPublish(){
     
       
     		 	
	 	$approved =  $this->Approved;
	 	
	  
	    	 	
	 	//Only want onAfterPublish to send a confirmation email the first time            
	   //if ($approved==0){ 	
        	
         
        	
			$subject = "TutorIowa approval confirmation";
		    $body = "Congratulations, you have been approved as a tutor on Tutor Iowa. You now have full access to edit your profile. Please check out <a href='http://tutor.uiowa.edu/for-tutors'>For Tutors</a> to learn how to effectively utilize tags and efficiently use the website, or refer to the <a href='http://www.youtube.com/watch?v=oQyJIiGs7qU&feature=youtu.be'>Private Tutor Training video</a><br>


 

 

If you have any questions please email tutoriowa@uiowa.edu.<br>

 

Best,<br>

The Tutor Iowa Team"; 

			//$emailHolder = DataObject::get_one("EmailHolder");
			$emailHolder = EmailHolder::get()->first(); 
			$body = $emailHolder->RegistrationConfirm;
		    
		    
		    ////You can edit your details now <a href='" . Director::absoluteBaseURL() . "edit-profile-page'>here</a/><br>     	
		    //$headers = "From: Tutor Iowa";       	
		    //mail($recip->Email, $subject, $body);
		    
		    
	        
		    $email = new Email(); 
		    $email->setTo($this->Email); 
		    $email->setFrom("tutoriowa@uiowa.edu"); 
		    $email->setSubject($subject); 
		    $email->setBody($body); 
		    $email->send(); 
		    
		    
		    
	   // }
	    /*
	    $this->Approved = 1;
	    $this->writeToStage('Stage'); 
	    $this->publish("Stage", "Live");
	    */	   	   
	   
	   /*
	   $MemberID = $this->MemberID;
	   
	   $isDisabled = DataObject::get_one("IsDisabled", "MemberID = $MemberID");
	   $isDisabled->Disabled = 0;
	   
	   $isDisabled->write();  
	   */
     }
     
     
     //Doesn't run
     /*
     function onBeforeUnpublish(){
          	
	    // print "<script>alert('THIS IS GETTING CALLED');</script>";
	    
	     user_error("breakpoint", E_USER_ERROR);
	     print_r("HIIIIIIIIIIII");
	     
	     $subject = "Your Tutor Iowa page has been disabled";
		 $body = "You can request your details be edited <a href='" . Director::absoluteBaseURL() . "edit-profile-page'>here</a/> "; 
		         	 
		 $email = new Email(); 
		 $email->setTo($this->Email); 
	     $email->setFrom("tutoriowa@uiowa.edu"); 
	     $email->setSubject($subject); 
		 $email->setBody($body);
		 $email->send(); 
		 
		 $this->Approved = 0;
	     $this->write();
		 
		 //$test = DataObject::get("Member", "Surname='Clashman'");
		 //$test->Surname = "alacabash";
		 //$test->write();
		 
	}
	*/

     
}


class TutorPage_Controller extends Page_Controller { 

	public static $allowed_actions = array('ContactForm');

    public function ContactForm(){
     
     	
	   	$fields = new FieldList(
	   	new TextField('Email', '<span>*</span> Your Email Address'),
	   	new TextField('Name', '<span>*</span> Your First and Last Name'),
	   	new TextAreaField('Body',  '<span>*</span> Your Message to '.$this->Member()->FirstName)
	   
	   	);
	   	
	   	$actions = new FieldList(
            new FormAction('doContactTutor', 'Contact Tutor')
            
        );
        
        $validator = new RequiredFields('Email');
        $form = new Form($this, 'ContactForm', $fields, $actions, $validator);
        //$protector = SpamProtectorManager::update_form($form, 'Message');
        $form->enableSpamProtection();
        return $form;
        
	   
    }
    
    function doContactTutor($data,$form){
    
		$from = $data["Email"];
	    $name = $data["Name"];	    
	    $body = $data["Body"];
	        
	    $subject = "[Tutor Iowa] ".$name." has contacted you.";
	    //$body = "Sent by " . $data["Email"] . "<br><br>" . $data["Body"];
	    

	    //Emails from TutorUniverse.com should fail silently and a notification of the contact attempt should be sent to tutoriowa@uiowa.edu 
	    $fromSubstring = stripos($from, 'TutorUniverse.com');
	    

	    if (!(($fromSubstring == false) || ($fromSubstring == ''))){
			$email = new Email(); 
			$email->setTo('dustin-quam@uiowa.edu; tutoriowa@uiowa.edu;');
			//$email->setTo('tutoriowa@uiowa.edu');
			$email->setSubject('TutorUniverse email blocked');
			$email->setFrom($from);
			$email->setBody($body);
			$email->send(); 	
	    }
	    
	    //If the email is not from TutorUniverse, send the email
		else {       
		   	 
		    $email = new Email(); 
		    $toString = $this->Email;
		    $email->setTo($toString); 
		    $email->setSubject($subject); 
		  	$email->setFrom($from);
		    $email->setBody($name.' has contacted you. Read their message below. You may reply to their message directly by replying to this email. <br />'.$body);
		    $email->send();
		    
		    $message = new Message();
		    
		    $message->SenderName = $name;
		    $message->SenderEmail = $from;
		    $message->MessageBody = $body;
		    $message->RecipientID = $this->Member()->ID;
		    $message->RecipientName = $this->Member()->FirstName.' '.$this->Member()->Surname;		    
		    
		    $message->write();
		    
		    //$statspage = DataObject::get_one('StatsPage');
		    $statspage = StatsPage::get()->first(); 
		    $temp = $statspage->TutorRequestCount;
		    $temp++;
		   
		    $statspage->TutorRequestCount = $temp;
		    //return Debug::show($statspage);
		    Versioned::reading_stage('stage');
                
            $statspage->writeToStage('Stage');
          
            $statspage->publish("Stage", "Live");
            
            Versioned::reading_stage('Live');
            
            $statspage->write();	    
		    		    
	    } 
	      	
	    return $this->redirect($this->Link('?sent=1'));   
	    	
	    
    }

function Sent(){
	return $this->request->getVar('sent');
	
}

function Saved(){
	return $this->request->getVar('saved');
    }

function getFeedbackLink(){
	$linkPage = FeedbackPage::get()->First();
	$tutorID = $this->ID;
	$linkText = $linkPage->Link() . '?TutorID=' . $tutorID;
	return $linkText;
}  
		
    
} 