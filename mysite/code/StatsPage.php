<?php
class StatsPage extends Page {

 	private static $db = array( 
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
              
        //$set = DataObject::get("TutorPage");
        $set = TutorPage::get()->innerJoin("TutorPage_Live", "\"TutorPage_Live\".\"ID\" = \"TutorPage\".\"ID\"");
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



    public function RequestsSinceYesterday(){
        $today = ss_datetime::Now()->Format('Y-m-d');
        $days_ago = date('Y-m-d', strtotime('-1 days', strtotime($today)));
        
        $messageCount = $this->getMessagesByDateRange($days_ago, $today)->Count();
        return $messageCount;
    }

    public function RequestsSinceLastWeek(){
        $today = ss_datetime::Now()->Format('Y-m-d');
        $days_ago = date('Y-m-d', strtotime('-7 days', strtotime($today)));

        $messageCount = $this->getMessagesByDateRange($days_ago, $today)->Count();
        return $messageCount;
    }

    public function RequestsSinceLastMonth(){
        $today = ss_datetime::Now()->Format('Y-m-d');
        $days_ago = date('Y-m-d', strtotime('-1 months', strtotime($today)));

        $messageCount = $this->getMessagesByDateRange($days_ago, $today)->Count();
        return $messageCount;
    }

    public function RequestsSinceLastSemester(){
        $today = ss_datetime::Now()->Format('Y-m-d');
        $days_ago = date('Y-m-d', strtotime('-6 months', strtotime($today)));

        $messageCount = $this->getMessagesByDateRange($days_ago, $today)->Count();
        return $messageCount;
    }

    public function RequestsSinceBeginningOfYear(){
        $today = ss_datetime::Now()->Format('Y-m-d');
        $days_ago = date('Y-m-d', strtotime('-1 years', strtotime($today)));

        $messageCount = $this->getMessagesByDateRange($days_ago, $today)->Count();
        return $messageCount;
    }

      

    

     


   



//In template: Yesterday's messages: $RequestsSinceYesterday


    function getMessagesByDateRange($startDate, $endDate){
        $requests = Message::get()->filter(array(
                        "Created:GreaterThanOrEqual" => $startDate, 
                        "Created:LessThanOrEqual" => $endDate
                    ));
        return $requests;
    }

    function getTopSearchTerms(){

        $searchTerms=SearchTerm::get();
        return $searchTerms;
    }
}