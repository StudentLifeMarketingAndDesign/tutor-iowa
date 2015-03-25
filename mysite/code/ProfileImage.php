<?php
class ProfileImage extends PendingImage {
	
	private static $db = array( 
	    "CropOption" => 'int'
	);
	
    private static $belongs_to = array(
        
    );
	
	private static $summary_fields = array();
	private static $field_labels = array( 
	);
	
	protected function onBeforeWrite() {
		parent::onBeforeWrite();
	
	}
   	
}
