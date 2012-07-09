<?php
/**
 * Defines the HomePage page type
 */
 
class HelpLab extends Page {
   static $db = array(
    'Name' => 'Text',
    'Location' => 'Text',
    "Hours" => 'Varchar',
    'Enabled' => 'Boolean',
    'EndDate' => 'Date', 

   );
   
   static $has_one = array( 
    'AcademicHelp' => 'AcademicHelp',
    );
    
   static $defaults = array ('ProvideComments' => '1');
   
      public function getCMSFields() 
    {
    
    	$fields = parent::getCMSFields();
    	
    	$fields->addFieldToTab( 'Root.Content.Main', new TextField("Name", "Help Lab name (can be the same as Page name)"));
    	$fields->addFieldToTab( 'Root.Content.Main', new TextField("Hours"));
    	$fields->addFieldToTab( 'Root.Content.Main', new TextField("Location"));
    	$fields->removeFieldFromTab('Root.Content.Metadata', "Keywords"); 
    	$fields->addFieldToTab( 'Root.Content.Main', new TextAreaField("MetaKeywords", "Tags"));
    	
       
        return $fields;
        
     } 
   
}
 
class HelpLab_Controller extends Page_Controller {

}