<?php
/**
 * Defines the ContactFormPage page type
 */
 
class ContactFormPage extends Page {
   static $db = array(
      
   );
   
   static $has_one = array( 
    );
    
    static $many_many = array(
   );
 
    
   static $defaults = array ('ProvideComments' => '1');
   
      public function getCMSFields() 
    {
    
    	$fields = parent::getCMSFields();
    	
       
        return $fields;
        
     } 
   
}
 
class ContactFormPage_Controller extends Page_Controller {

  function ContactForm(){
  

     	  
     	$tutorID = intval($this->request->getVar('tutor-id'));
     	$tutor = DataObject::get_by_id("TutorPage", $tutorID);
     	
     	
     	if($tutor){
     	
		   	$fields = new FieldSet(
		   	new TextField('Email', '<span>*</span> Your Email Address'),
		   	new TextAreaField('Body',  '<span>*</span> Your Message to '.$tutor->FirstName),
		   	new HiddenField("TutorID", $tutor->ID)
		   
		   	);
		   	
		   	$actions = new FieldSet(
	            new FormAction('doContactTutor', 'Contact Tutor')
	            
	        );
	        
	        $validator = new RequiredFields('Email');
	        $form = new Form($this, 'ContactForm', $fields, $actions, $validator);
	        $protector = SpamProtectorManager::update_form($form, 'Message');
	
	        return $form;
        }
        
	   
    }
    
    function doContactTutor($data,$form){
	    
	    $tutor = DataObject::get_by_id("TutorPage", $data['TutorID']);
	    $subject = "A student has requested you as a tutor";
	    //$body = "Sent by " . $data["Email"] . "<br><br>" . $data["Body"];
	    
	    $from = $data["Email"];
	    $body = $data["Body"];
		         	 
	    $email = new Email(); 
	    $email->setTo($tutor->Email); 
	    $email->setSubject($subject); 
	  	$email->setFrom($from);
	    $email->setBody($body);
	    $email->send();
	    
	    $statspage = DataObject::get_one('StatsPage');
	    $temp = $statspage->TutorRequestCount;
	    $temp++;
	   
	    $statspage->TutorRequestCount = $temp;
	    //return Debug::show($statspage);
	    $statspage->writeToStage('Stage'); 
	    $statspage->publish("Stage", "Live");	    
	        	
	    return Director::redirect($this->Link('?saved=1'));   
	    	
	    
    }

}