<?php
class StatsPage extends Page {

 
    
    
   public function getCMSFields() {
        $fields = parent::getCMSFields();
     
        $fields->addFieldToTab('Root.Content.Main', $tutorCount = new TextField('Placeholder1', 'Number of tutors in database'));
        $fields->addFieldToTab('Root.Content.Main', $tutorRequestCount = new TextField('Placeholder2', 'Number of tutor requests made'));
              
        $set = DataObject::get("TutorPage");
        $count = $set->Count();
        $tutorCount->setValue($count);
                
        
               
        return $fields;
    }
}
class StatsPage_Controller extends Page_Controller {
}