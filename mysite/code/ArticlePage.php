<?php
class ArticlePage extends Page {

 private static $db = array(
        'Date' => 'Date',
        'Author' => 'Text'
    );
    
 private static $has_one = array( 
 
 );
 private static $defaults = array ('ProvideComments' => '1',
    
   
    
    );
    
    
   public function getCMSFields() {
        $fields = parent::getCMSFields();
     
        $fields->addFieldToTab('Root.Main', $dateField = new DateField('Date','Article Date (for example: 1/20/2010)'), 'Content');
        $dateField->setConfig('showcalendar', true);
        $dateField->setConfig('dateformat', 'dd/MM/YYYY');
        $fields->addFieldToTab('Root.Main', new UploadField('Image', 'Image'));
        $fields->addFieldToTab('Root.Main', new TextField('Author','Author Name'), 'Content');
     
        return $fields;
    }
}
class ArticlePage_Controller extends Page_Controller {
}