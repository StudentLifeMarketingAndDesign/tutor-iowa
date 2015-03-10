<?php
class Message extends DataObject {
  
   private static $db = array(
	   'SenderEmail' => 'Varchar',
	   'SenderName' => 'Varchar',
	   'MessageBody' => 'Text',
	   'RecipientName' => 'Text',
	   'ReadDateTime' => 'SS_Datetime',
	   'MarkAsDeleted' => 'SS_Datetime',
	   'RepliedDateTime' => 'SS_Datetime'
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
   
   
   // I believe these functions prevent anybody from editing or creating messages
   public function canEdit($member = null) {
	   return false;
   }
   
   public function canCreate($member = null) {
       return false;
   }
    
}
