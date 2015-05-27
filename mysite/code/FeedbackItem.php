<?php
/**
 * Defines the HomePage page type
 */
 
class FeedbackItem extends DataObject {
   private static $db = array(
   'Feedback' => 'Text',
   'Name' => 'Varchar',
   'Email' => 'Varchar'
   );
   
   private static $has_one = array(
   'Page' => 'Page'
   );
   
   private static $searchable_fields = array('ID', 'Feedback', 'Name');
  
   private static $summary_fields = array('ID', 'Feedback', 'Name');
   
   	            

}
 
class FeedbackItem_Controller extends Page_Controller {

	 
	 
}