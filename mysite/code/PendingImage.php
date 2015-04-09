<?php
class PendingImage extends Image {
    
    private static $db = array( 
        'Status' => "Enum(array('Pending', 'Approved', 'Unapproved'))",
        'UnapprovedMessage' => 'Text'
    );
    
    //private static $searchable_fields = array('ID', 'Feedback', 'Name');
    private static $summary_fields = array();
    private static $field_labels = array( 
    );
    
    protected function onBeforeWrite() {
        parent::onBeforeWrite();
	
    }
    
    /**
    * Nifty function one may call if they wish to delete all the pending images that are not associated with
    * any TutorPages, both the record and the file. They fall through the cracks when a Tutor uploads/removes multiple photos prior to admin approval. 
    * by JS :)
    * @return NULL
    */	
    public static function cleanUpPendingImages() {
        $realPendingImageIDs = array();
        foreach(CoverImage::getPending() as $pc) { array_push($realPendingImageIDs, $pc->ID); }
        foreach(ProfileImage::getPending() as $pp) { array_push($realPendingImageIDs, $pp->ID); }    
        print_r("realPendingImageIDs: " . implode(", ", $realPendingImageIDs));
        foreach(PendingImage::get()->filter("Status", "Pending") as $index => $pi) {
            //print_r("<br><br><br>");
            if (!in_array($pi->ID, $realPendingImageIDs)) {
                print_r("INDEX: " . $index);
                $pi->delete(); // goodbye. 
            }
        }      
    }
    
    /**
    * Counts Actual Pending Images that the Administrator sees. Can also return the count of Pending Image records (including ones that 
    * may not be linked to any tutor pages), if passed a false boolean. 
    * @param Boolean
    * @return Integer
    */	   
    public static function actualPendingImages($actualOnly = true) {
        if ($actualOnly) { self::cleanUpPendingImages(); }
        return Self::get()->filter("Status", "Pending");
    }
}
