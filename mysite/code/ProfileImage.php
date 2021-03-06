<?php
class ProfileImage extends PendingImage {
	
	private static $db = array( 
	    "CropOption" => 'int'
	);
	
    private static $belongs_to = array(
        "TutorPage" => "TutorPage"
    );
	
	private static $summary_fields = array();
	private static $field_labels = array();
	
	protected function onBeforeWrite() {
		parent::onBeforeWrite();
	}
	
	/**
    * Accomplishes same thing as pendingCoverImages() but for pendingProfileImages(). 
    * Note: since the default value of PendingProfileImageID is 0, anything besides that indicates
    * that there is a valid image related to it. 
    * @return ArrayList	
    */	
	public static function getPending() {
        return new ArrayList(self::get()->filter("Status", "Pending")->toArray());
    }

}
