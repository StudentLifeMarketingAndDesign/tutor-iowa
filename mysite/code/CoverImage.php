<?php
class CoverImage extends PendingImage {
    
    private static $db = array(
        'Top' => 'int'
    );

    private static $belongs_to = array(
        
    );
    
    private static $summary_fields = array();
    private static $field_labels = array();
    
    protected function onBeforeWrite() {
        // Status on PendingImage Class
        parent::onBeforeWrite();
    }
}
