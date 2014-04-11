<?php
/**
 * Defines the HomePage page type
 */
 
class FeedbackPage extends Page {
   private static $db = array(
   
   );
   
   public function getCMSFields(){
	   $fields = parent::getCMSFields();
	   
	   $gridFieldConfigFeedbackViewer = GridFieldConfig_RecordEditor ::create(); 
	   $gridfield = new GridField("FeedbackViewer", "Feedback Viewer", FeedbackItem::get(), $gridFieldConfigFeedbackViewer);	
	   $fields->addFieldToTab('Root.Main', $gridfield);
	   
	   return $fields;
   }
   
  
}
 
class FeedbackPage_Controller extends Page_Controller {
	 static $allowed_actions = array('FeedbackForm'); //added in 3.1
	
	 public function FeedbackForm(){
   
		$getVars = $this->request->getVars();
   	 
		//If directed to feedback page from a tutor's page, set the hidden field Tutor ID to have the value of the GET parameter
	    if (isset($getVars['TutorID'])){
   	  		$tutorID = $getVars['TutorID'];
   	  		$tutorPage = TutorPage::get()->byID($tutorID);
   	  		$firstName = $tutorPage->FirstName;
   	  		$surname = $tutorPage->Surname;
   	  		   	  		
   	    }
   	    else {
	   	    $tutorID = 0;
	   	    $firstName = '';
	   	    $surname = '';
   	    }	  

      if( Member::currentUserID()) {
        $member = Member::currentUser();
        $memberName = $member->FirstName.' '.$member->Surname;
        $memberEmail = $member->Email;
	     } else{
        $memberName = '';
        $memberEmail = '';
       }

    
	  $fields = new FieldList(
	   
	   //new LabelField("label", "Enter first and last name if your feedback concerns a specific tutor.  If your feedback does not concern a specific person, ignore these fields."),
	   new TextField('Name', '<span>*</span>Your Name',$memberName),
     new EmailField('Email', '<span>*</span>Your Email Address', $memberEmail),
	   new TextAreaField('Feedback', '<span>*</span>Your Feedback'),
	   new TextField('FirstName', 'Tutor First Name (if your feedback is applicable to a specific tutor)', $firstName), //TUTOR FIRST NAME
	   new TextField('Surname', 'Tutor Last Name (if your feedback is applicable to a specific tutor)', $surname), //TUTOR SURNAME
	   new HiddenField('TutorID', 'TutorID',  $tutorID)
	   );
	   
	   
	    $actions = new FieldList(
	            new FormAction('SubmitFeedbackForm', 'Submit Feedback')
	     );
         
        // Create action
        $validator = new RequiredFields('Name', 'Email', 'Feedback');
        
       //Create form
        $Form = new Form($this, 'FeedbackForm', $fields, $actions, $validator);
        
        //$protector = SpamProtectorManager::update_form($Form, 'Message', null, "Please enter the following words");
        $Form->enableSpamProtection();
       
        
        
        return $Form;

	  
   }
   
   public function ClearSession(){
	    Session::clear('Saved');
    }
   
   public function SubmitFeedbackForm($data, $form){
   
	   
	    
   	    
   	    $feedback = new FeedbackItem();
   	    $form->saveInto($feedback);
   	    
   	    $feedback->write();
   	    
   	   
   	    if ($data['TutorID'] != 0){
	    
	    	$tutorID = Convert::raw2sql($data['TutorID']);
   	  		$tutorPage = TutorPage::get()->byID($tutorID);
   	  		$tutorPageFeedbackItems = $tutorPage->FeedbackItems();
   	  	   	  		
   	  		
   	  		$tutorPageFeedbackItems->add($feedback); 
   	  	
   	  		$tutorPage->write();

   	  		
   	    }
  	    //If user goes straight to feedback page and wants to give feedback on a specific tutor, try to do that based on Tutor First Name and LastName
   	    elseif (($data["FirstName"] != '') && ($data["Surname"] != '')){
   	    	$firstName = Convert::raw2sql($data['FirstName']);
   	    	$surname = Convert::raw2sql($data['Surname']);
	   	    $desiredTutor = TutorPage::get()->filter(array('FirstName' => $firstName,
	   	    												'Surname' => $surname))->First();
	   	    //print_r($desiredTutor);	
	   	    if ($desiredTutor){
	   	    	$tutorPageFeedbackItems = $desiredTutor->FeedbackItems();		
	   	    	$tutorPageFeedbackItems->add($feedback); 
	   	    	$desiredTutor->write();
		   	    
	   	    }
   	    }
   	    
   	            	
    	$subject = "Feedback submitted"; 
    	
    	$name = Convert::raw2sql($data['Name']);
    	$userEmail = Convert::raw2sql($data['Email']);
    	$feedback = Convert::raw2sql($data['Feedback']);
    	$tutorFirstName = Convert::raw2sql($data['FirstName']);
    	$tutorLastName = Convert::raw2sql($data['LastName']);

		
    	$body = '' . $name . " has submitted feedback. " . "<br><br>Feedback:" . $feedback;
    	
    	if (($tutorFirstName != '') || ($tutorLastName != '')){
        	$body .= '<br><br>' . 'Tutor First Name: ' . $tutorFirstName . '<br><br>' . 'Tutor Last Name :' . $tutorLastName;
    	}
    	
    	if (isset($tutorPage))
    	{
    	   if ($tutorPage){
	    	   $tutorID = $tutorPage->ID;        	   
	    	   $body .= "<br><br> View tutor account <a href='" . Director::absoluteBaseURL() .  "admin/pages/edit/show/" . $tutorID . "'>here</a/><br><br>";
	       }
    	}
    	elseif (isset($desiredTutor)){
			 if ($desiredTutor){
		    	$tutorID = $desiredTutor->ID;        	   
	    	    $body .= "<br><br> View tutor account <a href='" . Director::absoluteBaseURL() .  "admin/pages/edit/show/" . $tutorID . "'>here</a/><br><br>";
	    	 }
    	}
    	else {
    	   $feedbackPage = FeedbackPage::get()->First();
    	       if ($feedbackPage){
	        	   $feedbackID = $feedbackPage->ID;
		           $body .= "<br><br>All Tutor Feedback can be viewed in the CMS <a href='" . Director::absoluteBaseURL() .  "admin/pages/edit/show/" . $feedbackID . "'>here</a/><br><br>";
		       }
    	}
    	
    	
    	//"Enable account  <a href='" . Director::absoluteBaseURL() .  "admin/pages/edit/show/" . $Tutor->ID . "'>here</a/><br><br>
    
          	
    	//$headers = "From: Tutor Iowa";       	
        //mail($recip->Email, $subject, $body);
        
         include 'EmailArray.php';
         
        foreach ($emailArray as $recip){ //emailArray defined in EmailArray.php
	      	        
	         $email = new Email(); 
	         $email->setTo($recip->Email); 
	         $email->setFrom($userEmail); 
	         $email->setSubject($subject); 
	         $email->setBody($body); 
	         $email->send(); 
	        
         }
            	    
   	    Session::set('Saved', 1);
   	    
   	    return $this->redirect($this->Link());   
   	     
   	     
   }
  
  function Saved()
	{
    	$saved = Session::get('Saved');
    	if ($saved == 1){
	        return true;
        }
        else {
	        return false;
        }
        
    }

	 
}