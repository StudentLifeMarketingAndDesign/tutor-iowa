<?php
class ProfileImage extends PendingImage {
	
	private static $db = array( 
	
	);
	
	private static $belongs_to = array(
		'TutorPage' => 'TutorPage.PendingProfileImage'
	);
	
	private static $summary_fields = array();
	private static $field_labels = array( 
	);
	
	protected function onBeforeWrite() {
		parent::onBeforeWrite();
	
	}
   	
}
