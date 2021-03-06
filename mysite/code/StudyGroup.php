<?php
/**
 * Defines the HomePage page type
 */
 
class StudyGroup extends Page {
   private static $db = array(
    'Name' => 'Text',
   	'Location' => 'Text',
   	"Hours" => 'Varchar',
    'Enabled' => 'Boolean',
    'EndDate' => 'Date',
    
   );
   
    private static $has_one = array( 
    'AcademicHelp' => 'AcademicHelp',
    );
    
    private static $defaults = array ('ProvideComments' => '1');
    
    public function getCMSFields() 
    {
    
    	$fields = parent::getCMSFields();
    	
    	$fields->addFieldToTab( 'Root.Main', new TextField("Name", "Study Group name (can be the same as Page name)"));
    	$fields->addFieldToTab( 'Root.Main', new TextField("Hours"));
    	$fields->addFieldToTab( 'Root.Main', new TextField("Location"));
    	$fields->removeFieldFromTab('Root.Metadata', "Keywords"); 
    	$fields->addFieldToTab( 'Root.Main', new TextAreaField("MetaKeywords", "Tags"));
    	
       
        return $fields;
        
     } 
}
 
class StudyGroup_Controller extends Page_Controller {
	
     
}