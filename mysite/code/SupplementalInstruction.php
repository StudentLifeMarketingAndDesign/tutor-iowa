<?php

 
class SupplementalInstruction extends Page {
   static $db = array(
    'Name' => 'Text',
    'Location' => 'Text',
    'SessionLeader' => 'Text',
    "Hours" => 'Varchar',
    'Disabled' => 'Boolean',
    'Misc' => 'Text',
    'EndDate' => 'Date',
    
   );
   
   
      static $has_one = array( 
    'AcademicHelp' => 'AcademicHelp',
    );
    
      static $many_many = array(
      'Tags' => 'Tag', 
    );
    
    //Comments enabled by default
    
    //Also want pages to be created under a SuppHolder by default
    static $defaults = array ('ProvideComments' => '1',
     
    );

    function getTags() {
     	return $this->Tags();
     }
     
     
      public function getCMSFields() 
    {
    
    	$fields = parent::getCMSFields();
    	$fields->removeFieldFromTab('Root.Content.Metadata', "Keywords"); 
    	$fields->removeFieldFromTab('Root.Content.Main', "Content");
    	$fields->addFieldToTab( 'Root.Content.Main', new TextAreaField("MetaKeywords", "Tags"));
    	$fields->addFieldToTab( 'Root.Content.Main', new TextField("Name", "Supplemental Instruction name (can be the same as page name)"));
    	$fields->addFieldToTab('Root.Content.Main', new TextField("Location"));
    	$fields->addFieldToTab('Root.Content.Main', new TextField("Hours"));
    	$fields->addFieldToTab('Root.Content.Main', new TextField("SessionLeader", "Session Leader"));
    	$fields->addFieldToTab('Root.Content.Main', new TextAreaField("Content", "Describe the supplemental instruction here"));
    	
       
        return $fields;
        
     } 

}
 
class SupplementalInstruction_Controller extends Page_Controller {
	
}