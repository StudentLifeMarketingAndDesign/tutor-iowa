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
  
   private static $summary_fields = array('SenderName', 'SenderEmail', 'RecipientName', 'MessageBody', 'Created');

   private static $field_labels = array(
      'Created' => 'Sent on',
      'SenderName' => 'Requester Name',
      'SenderEmail' => 'Requester Email',
      'RecipientName' => 'Tutor Name'

   );
   
   public function canEdit($member = null) {
	   return false;
   }
       public function canCreate($member = null) {
        return false;
   }
 
}
 
