<?php

use SilverStripe\Security\Member;
use SilverStripe\ORM\DataObject;
class Message extends DataObject {
  
   private static $db = array(
	   'SenderEmail' => 'Varchar',
	   'SenderName' => 'Varchar',
	   'MessageBody' => 'Text',
	   'RecipientName' => 'Text',
	   'ReadDateTime' => 'Datetime',
	   'MarkAsDeleted' => 'Datetime',
	   'RepliedDateTime' => 'Datetime'
   );
   
   private static $has_one = array(
	   'Recipient' => Member::class
   );
   
   //private static $searchable_fields = array('ID', 'Feedback', 'Name');
  
   private static $summary_fields = array('SenderName', 'SenderEmail', 'RecipientName', 'MessageBody', 'Created');

   private static $field_labels = array(
    	'Created' => 'Sent on',
		'SenderName' => 'Requester Name',
		'SenderEmail' => 'Requester Email',
		'RecipientName' => 'Tutor Name'

   );
   
    
}
