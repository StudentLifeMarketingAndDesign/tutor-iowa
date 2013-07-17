<?php
class StatsPage extends Page {

 	static $db = array( 
 	'TutorRequestCount' => 'Int',
 	);
 	/*
 	static $defaults = array(
 	'TutorRequestCount' => '0'
 	);
    */
    
   public function getCMSFields() {
        $fields = parent::getCMSFields();
        
        $fields->removeFieldFromTab('Root.Main', "Content");
        $fields->addFieldToTab('Root.Main', $tutorCount = new ReadonlyField('Placeholder1', 'Number of tutors in database'));
        $fields->addFieldToTab('Root.Main', $tutorRequestCount = new ReadonlyField('TutorRequestCount', 'Number of tutor requests made'));
              
        $set = DataObject::get("TutorPage");
        $count = $set->Count();
        $tutorCount->setValue($count);
                
        //$tutorRequestCount->setValue($_TUTOR_REQUEST_COUNT);
        //$tutor = DataObject::get_one("TutorPage");
        //$requestCount = $tutor::getTest();
        //$tutorRequestCount->setValue($_TUTOR_REQUEST_COUNT);
        
        //$tutorRequestCount->setValue($this->TutorRequestCount);
        
               
        return $fields;
    }
}
class StatsPage_Controller extends Page_Controller {
}