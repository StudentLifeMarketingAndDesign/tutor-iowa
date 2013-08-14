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
   	  		$lastName = $tutorPage->Surname;
   	  		   	  		
   	    }
   	    else {
	   	    $tutorID = 0;
	   	    $firstName = '';
	   	    $lastName = '';
   	    }	  
   	  
	   	  
	  $fields = new FieldList(
	   
	   //new LabelField("label", "Enter first and last name if your feedback concerns a specific tutor.  If your feedback does not concern a specific person, ignore these fields."),
	   new TextField('Name'),
	   new TextField('Email', 'Email Address'),
	   new TextAreaField('Feedback', '<span>*</span>Feedback'),
	   new TextField('FirstName', 'First Name (if your feedback is applicable to a specific tutor)', $firstName),
	   new TextField('Surname', 'Last Name (if your feedback is applicable to a specific tutor)', $lastName),
	   new HiddenField('TutorID', 'TutorID',  $tutorID)
	   );
	   
	   
	    $actions = new FieldList(
	            new FormAction('SubmitFeedbackForm', 'Submit Feedback')
	     );
         
        // Create action
        $validator = new RequiredFields('Feedback');
        
       //Create form
        $Form = new Form($this, 'FeedbackForm', $fields, $actions, $validator);
        
        //$protector = SpamProtectorManager::update_form($form, 'Message', null, "Please enter the following words");
        
       
        
        
        return $Form;

	  
   }
   
   public function ClearSession(){
	    Session::clear('Saved');
    }
   
   public function SubmitFeedbackForm($data, $form){
   
	   
	    
   	    
   	    $feedback = new FeedbackItem();
   	    $form->saveInto($feedback);
   	    
   	    $feedback->write();
   	    
   	    /*print_r($data);
   	    print_r('TutorID = ' . $data['TutorID']);
   	    
   	    user_error("breakpoint", E_USER_ERROR);*/

   	    //For some reason $data['TutorID']
   	    if ($data['TutorID'] != 0){
	    
   	  		$tutorPage = TutorPage::get()->byID($data['TutorID']);
   	  		$tutorPageFeedbackItems = $tutorPage->FeedbackItems();
   	  	   	  		
   	  		//Think I just need to add to the many side of the one-to-many relationship, but I'm not positive
   	  		$tutorPageFeedbackItems->add($feedback); 
   	  		//print_r($tutorPageFeedbackItems);
   	  		//user_error("breakpoint", E_USER_ERROR);
   	  		$tutorPage->write();

   	  		
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