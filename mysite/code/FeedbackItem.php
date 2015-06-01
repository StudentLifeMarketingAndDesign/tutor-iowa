<?php
/**
 * Defines the HomePage page type
 */
 
class FeedbackItem extends DataObject {
   private static $db = array(
   'Feedback' => 'Text',
   'Name' => 'Varchar',
   'Email' => 'Varchar',
   'SpecificPage' => 'Boolean'
   );
   
   private static $has_one = array(
   'Page' => 'Page'
   );
   
   private static $searchable_fields = array('ID', 'Feedback', 'Name', 'SpecificPage');
  
   private static $summary_fields = array('PageID', 'Page.Title', 'Feedback', 'Name', 'SpecificPage');
   //No ID, Email address, Feedback, Specific Page, PageID + Page Title see summary_fields docs
   	            

}
 
class FeedbackItem_Controller extends Page_Controller {

	 
	 
}