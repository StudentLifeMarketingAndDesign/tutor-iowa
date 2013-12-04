<?php
/**
 * Defines the HomePage page type
 */
 
class Message extends DataObject {
   private static $db = array(
   'SenderEmail' => 'Varchar',
   'SenderName' => 'Varchar',
   'MessageBody' => 'Text',
   'RecipientName' => 'Text'
   );
   
   private static $has_one = array(
   'Recipient' => 'Member'
   );
   
   //private static $searchable_fields = array('ID', 'Feedback', 'Name');
  
   private static $summary_fields = array('SenderEmail', 'SenderName', 'MessageBody', 'RecipientName');
   
   	            

}
 
