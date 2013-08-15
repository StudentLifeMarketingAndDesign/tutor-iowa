<?php
/**
 * Defines the HomePage page type
 */
 
class FeedbackPage extends Page {
   public static $db = array(
   
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
   	  
	   	  
	  $fields = new FieldList(
	   
	   //new LabelField("label", "Enter first and last name if your feedback concerns a specific tutor.  If your feedback does not concern a specific person, ignore these fields."),
	   new TextField('Name', 'Your Name'),
	   new EmailField('Email', 'Your Email Address'),
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
        
        $protector = SpamProtectorManager::update_form($Form, 'Message', null, "Please enter the following words");
        
       
        
        
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
	    
   	  		$tutorPage = TutorPage::get()->byID($data['TutorID']);
   	  		$tutorPageFeedbackItems = $tutorPage->FeedbackItems();
   	  	   	  		
   	  		
   	  		$tutorPageFeedbackItems->add($feedback); 
   	  	
   	  		$tutorPage->write();

   	  		
   	    }
  	    //If user goes straight to feedback page and wants to give feedback on a specific tutor, try to do that based on Tutor First Name and LastName
   	    elseif (($data["FirstName"] != '') && ($data["Surname"] != '')){
   	    	$firstName = $data["FirstName"];
   	    	$surname = $data["Surname"];
	   	    $desiredTutor = TutorPage::get()->filter(array('FirstName' => $firstName,
	   	    												'Surname' => $surname))->First();
	   	    //print_r($desiredTutor);	
	   	    if ($desiredTutor){
	   	    	$tutorPageFeedbackItems = $desiredTutor->FeedbackItems();		
	   	    	$tutorPageFeedbackItems->add($feedback); 
	   	    	$desiredTutor->write();
		   	    
	   	    }
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