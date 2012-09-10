<?php
/**
 * Defines the HomePage page type
 */
 
class HelpLab extends Page {
   static $db = array(
    'Name' => 'Text',
    'Description' => 'Text',
    'Location' => 'Text',
    "Hours" => 'Text',
    'Enabled' => 'Boolean',
    'EndDate' => 'Date', 
    'ExtrnlLink' => 'Text',
    'PhoneNo' => 'Text',
   
   );
   
   static $has_one = array( 
    'AcademicHelp' => 'AcademicHelp',
    );
    
    static $many_many = array(
      'Members' => 'Member'
   );
 
    
   static $defaults = array ('ProvideComments' => '1');
   
      public function getCMSFields() 
    {
    
    	$fields = parent::getCMSFields();
    	  $fields->removeFieldFromTab('Root.Content.Main', "Content"); 

    	$fields->addFieldToTab( 'Root.Content.Main', new TextField("Name", "Help Lab name (can be the same as Page name)"));

    	$fields->addFieldToTab( 'Root.Content.Main', new TextField("Hours"));
    	$fields->addFieldToTab( 'Root.Content.Main', new TextField("Location"));
    	$fields->removeFieldFromTab('Root.Content.Metadata', "Keywords"); 
    	$fields->addFieldToTab( 'Root.Content.Main', new TextAreaField("MetaKeywords", "Tags"));
    	$fields->addFieldToTab('Root.Content.Main', new TextField("ExtrnlLink", "External link to help lab homepage"));
    	$fields->addFieldToTab('Root.Content.Main', new TextField("PhoneNo", "Phone Number"));
    	$fields->addFieldToTab( 'Root.Content.Main', new TextAreaField("Description", "Description"));

    	
    	
    	$memberArray = DataObject::get('Member', "ID in (select MemberID from Group_Members where GroupID = (select ID from `Group` where title='Content Authors'))");
    	
    	$MemberTableField = new ManyManyDataObjectManager(
         $this,
         'Members',
         'Member',
         array(
        'Email' => 'Email'
         ),
         'getCMSFields_forPopup'
      );
      
    	$fields->addFieldToTab('Root.Content.HelpLabEditors', $MemberTableField);
       
        return $fields;
        
     } 
   
}
 
class HelpLab_Controller extends Page_Controller {

}