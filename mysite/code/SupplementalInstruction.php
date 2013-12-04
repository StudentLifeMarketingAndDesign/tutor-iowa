<?php

 
class SupplementalInstruction extends Page {
   private static $db = array(
    'Name' => 'Text',
    'Location' => 'Text',
    'SessionLeader' => 'Text',
    "Hours" => 'Varchar',
    'Disabled' => 'Boolean',
    'Misc' => 'Text',
    'EndDate' => 'Date',
    'Schedule' => 'HTMLText'
    
   );
   
   
     private static $has_one = array( 
    'AcademicHelp' => 'AcademicHelp',
    );
    
     private static $many_many = array(
      'Tags' => 'Tag', 
    );
    
    //Comments enabled by default
    
    //Also want pages to be created under a SuppHolder by default
   private static $defaults = array ('ProvideComments' => '1',
     
    );

    function getTags() {
     	return $this->Tags();
     }
     
     
      public function getCMSFields() 
    {
    
    	$fields = parent::getCMSFields();
    	$fields->removeFieldFromTab('Root.Metadata', "Keywords"); 
    	$fields->removeFieldFromTab('Root.Main', "Content");
    	$fields->addFieldToTab( 'Root.Main', new TextAreaField("MetaKeywords", "Tags"));
    	$fields->addFieldToTab( 'Root.Main', new TextField("Name", "Supplemental Instruction name (can be the same as page name)"));
    	$fields->addFieldToTab('Root.Main', new TextField("Location"));
    	$fields->addFieldToTab('Root.Main', new TextField("Hours"));
    	$fields->addFieldToTab('Root.Main', new TextField("SessionLeader", "Session Leader"));
    	$fields->addFieldToTab('Root.Main', new TextAreaField("Content", "Describe the supplemental instruction here"));
    	$fields->addFieldToTab('Root.Main', new HTMLEditorField("Schedule", "Schedule"));

    	
       
        return $fields;
        
     } 

}
 
class SupplementalInstruction_Controller extends Page_Controller {
	
}