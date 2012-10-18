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
    'ExternalScheduleLink' => 'Text',
    'ContactName' => 'Text',
    'ContactEmail' => 'Text',
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
       	$fields->addFieldToTab('Root.Content.Main', new TextField("ContactName", "Contact's Name"));
       	$fields->addFieldToTab('Root.Content.Main', new TextField("ContactEmail", "Contact's Email Address"));
       	$fields->addFieldToTab('Root.Content.Main', new TextField("ExternalScheduleLink", "External Schedule Link"));

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
	public function Edit(){
			/*
	 			
			$fields = new FieldSet (
			  	new TextareaField('Description'),
			    new Textareafield('MetaKeywords', 'Tags'),
			    new TextField('Location'),
			    new TextField('Link'),
			    new TextField('ContactName', 'Contact Person\'s Name'),
			    new TextField('ContactEmail', 'Contact Person\'s Email'),
	
			    new TextField('PhoneNo', 'Phone Number'),
			    new TextField('ExternalScheduleLink', 'Optional link to the lab\'s schedule on another site'),
	
			    new TextField('Hours', 'Availability')
			 );
		        
		    
		     	
		  
		     
		    $actions = new FieldSet(
	        new FormAction('HelpLabSaveProfile', 'Save Page')
	         );
	         
	 


	            
	        $form = new Form($this, 'Edit', $fields, $actions);
	        
	     
	        $HelpLabID = $this->ID;
	        
	        //return "HelpLab_Live.ID = $HelpLabID";
	        	        	            
	        //$DisplayedHelpLab = DataObject::get_one("HelpLab", "HelpLab_Live.ID = $HelpLabID");
	            
	        //$form->loadDataFrom($this->data());
	        
	        
	        */
	        
	        //$data = $this->data();
	        
	        return $this->renderWith(array('HelpLab_Edit', 'Page'));
	      
	           	         
   }
   
   
	function HelpEditProfileForm(){
	   $fields = new FieldSet (
		  	new TextareaField('Description'),
		    new Textareafield('MetaKeywords', 'Tags'),
		    new TextField('Location'),
		    new TextField('Link'),
		    new TextField('ContactName', 'Contact Person\'s Name'),
		    new TextField('ContactEmail', 'Contact Person\'s Email'),

		    new TextField('PhoneNo', 'Phone Number'),
		    new TextField('ExternalScheduleLink', 'Optional link to the lab\'s schedule on another site'),

		    new TextField('Hours', 'Availability')
		       );
		        
		    
		    
		  
		     
		    $actions = new FieldSet(
	        new FormAction('HelpLabSaveProfile', 'Save Page')
	         );
	            
	        $form = new Form($this, 'HelpEditProfileForm', $fields, $actions);
	            
	        $HelpLabID = $this->ID;
	            
	        $DisplayedHelpLab = DataObject::get_one("HelpLab", "HelpLab_Live.ID = $HelpLabID");
	            
	        $form->loadDataFrom($DisplayedHelpLab->data());

	        return $form;
   }

   
   function HelpLabSaveProfile($data, $form){
    
    	    	
	     $labID = $this->ID;
	     	   
	     $MemberLab = DataObject::get_one('HelpLab', "HelpLab_Live.ID=$labID");
    	 
    	 //return Debug::show($MemberLab);
    	 
    	 $form->saveInto($MemberLab); 
    	 
    	 $MemberLab->writeToStage("Stage");
               
         $MemberLab->publish("Stage","Live");
                    
         return Director::redirect($this->Link('/Edit/?saved=1'));  
         
   }
   
   function canUserEditHelpLab(){
	   $helplabs = $this->getHelpLabs();
	   $labID = $this->ID;
	   if ($helplabs){
		   foreach($helplabs as $lab){
		   		$checkID = $lab->ID;
		   		if ($labID == $checkID){
			   		return true;
		   		}
		   }
	   }
	   else {
		   return false;
	   }
	   return false;
	   
   }
   
    function Lab()
    {
        $temp = $this->request->getVar('ID');
        $id = intval($temp);
        
        $lab = DataObject::get_by_id("HelpLab", $id);
        
        return $lab;
 
    }   
   
   function helpLabSaved(){
   		/*
	   	$params = Director::getURLParams();
	   	if ($params['saved']){
		   	return true;
	   	}
	   	return false;
	   	*/
	   	return $this->request->getVar('saved');
   }
}