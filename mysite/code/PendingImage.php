<?php
class PendingImage extends Image {
    
    private static $db = array( 
        'Status' => "Enum(array('Pending', 'Approved', 'Unapproved'))",
        'UnapprovedMessage' => 'Text'
    );
    
    private static $has_one = array(
    );
    
    //private static $searchable_fields = array('ID', 'Feedback', 'Name');
    private static $summary_fields = array();
    private static $field_labels = array( 
    );
    
    protected function onBeforeWrite() {
        parent::onBeforeWrite();
        if (empty($this->pending)){
        
        }   	
    }
}
