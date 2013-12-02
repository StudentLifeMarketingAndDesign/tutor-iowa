<?php
/**
 * Defines the HomePage page type
 */
 
class FeedbackItem extends DataObject {
   public static $db = array(
   'Feedback' => 'Text',
   'Name' => 'Varchar',
   'Email' => 'Varchar'
   );
   
   public static $has_one = array(
   'TutorPage' => 'TutorPage'
   );
   
   static $searchable_fields = array('ID', 'Feedback', 'Name');
  
   static $summary_fields = array('ID', 'Feedback', 'Name');
   
   	            

}
 
class FeedbackItem_Controller extends Page_Controller {

	 
	 
}