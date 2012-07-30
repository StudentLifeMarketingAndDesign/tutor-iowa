<?php
/**
 * Defines the HomePage page type
 */
 
class HelpLab extends Page {
   static $db = array(
    'Name' => 'Text',
    'Description' => 'Text',
    'Location' => 'Text',
    "Hours" => 'Varchar',
    'Enabled' => 'Boolean',
    'EndDate' => 'Date', 
    'Link' => 'Text',
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
    	
    	$fields->addFieldToTab( 'Root.Content.Main', new TextField("Name", "Help Lab name (can be the same as Page name)"));
    	$fields->addFieldToTab( 'Root.Content.Main', new TextField("Hours"));
    	$fields->addFieldToTab( 'Root.Content.Main', new TextField("Location"));
    	$fields->removeFieldFromTab('Root.Content.Metadata', "Keywords"); 
    	$fields->addFieldToTab( 'Root.Content.Main', new TextAreaField("MetaKeywords", "Tags"));
    	
    	$fields->addFieldToTab('Root.Content.Main', new TextField("Link"));
    	$fields->addFieldToTab('Root.Content.Main', new TextField("PhoneNo", "Phone Number"));
    	
    	
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
      
    	$fields->addFieldToTab('Root.Content.Main', $MemberTableField);
       
        return $fields;
        
     } 
   
}
 
class HelpLab_Controller extends Page_Controller {

}