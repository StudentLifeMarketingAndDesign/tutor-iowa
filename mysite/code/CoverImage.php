<?php
class CoverImage extends PendingImage {
    
    private static $db = array(
        'Top' => 'Percentage'
    );

    private static $belongs_to = array(
        
    );
    
    private static $summary_fields = array();
    private static $field_labels = array();
    
    protected function onBeforeWrite() {
        // Status on PendingImage Class
        parent::onBeforeWrite();
    }
    
    // couldn't get the build in Nice() function to work, so I overload it here. 
    public function NiceTop() {
        $topPercentage = (string)$this->Top * 100;
        return $topPercentage . "%";
    }
}
