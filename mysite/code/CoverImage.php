<?php
class CoverImage extends PendingImage {
    
    private static $db = array(
        'Top' => 'int'
    );

    private static $belongs_to = array(
        'TutorPage' => 'TutorPage.PendingCoverImage'
    );
    
    private static $summary_fields = array();
    private static $field_labels = array();
    
    protected function onBeforeWrite() {
        parent::onBeforeWrite();	
    }
}
