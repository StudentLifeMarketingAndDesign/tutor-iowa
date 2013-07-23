<?php

 
class HelpLab extends Page {
   static $db = array(
    'Name' => 'Text',
    'Description' => 'HTMLText',
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
    	$fields->removeFieldFromTab('Root.Main', "Content"); 

    	$fields->addFieldToTab( 'Root.Main', new TextField("Name", "Help Lab name (can be the same as Page name)"));

    	$fields->addFieldToTab( 'Root.Main', new TextField("Hours"));
    	$fields->addFieldToTab( 'Root.Main', new TextField("Location"));
    	$fields->removeFieldFromTab('Root.Metadata', "Keywords"); 
    	$fields->addFieldToTab( 'Root.Main', new TextAreaField("MetaKeywords", "Tags"));
    	$fields->addFieldToTab('Root.Main', new TextField("ExtrnlLink", "External link to help lab homepage"));
       	$fields->addFieldToTab('Root.Main', new TextField("ContactName", "Contact's Name"));
       	$fields->addFieldToTab('Root.Main', new TextField("ContactEmail", "Contact's Email Address"));
       	$fields->addFieldToTab('Root.Main', new TextField("ExternalScheduleLink", "External Schedule Link"));

    	$fields->addFieldToTab('Root.Main', new TextField("PhoneNo", "Phone Number"));
    	$fields->addFieldToTab( 'Root.Main', new HTMLEditorField("Description", "Description"));

    	
    	
    	$memberArray = DataObject::get('Member', "ID in (select MemberID from Group_Members where GroupID = (select ID from `Group` where title='Content Authors'))");
    	
    	
    	$config = GridFieldConfig_RelationEditor::create();
    	$config->getComponentByType('GridFieldDataColumns')->setDisplayFields(array(
			'Email'=>'Email'
			//'Artist.Title' => 'Artist'
		)); 
		
		$MemberTableField = new GridField(
			'Members',
			'Member',
			$this->Members(), 
			$config
		);
    	/*$MemberTableField = new ManyManyDataObjectManager(
         $this,
         'Members',
         'Member',
         array(
        'Email' => 'Email'
         ),
         'getCMSFields_forPopup'
      );*/
      
    	$fields->addFieldToTab('Root.HelpLabEditors', $MemberTableField);
       
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
	   $canUserEdit = $this->canUserEditHelpLab();
	   if ($canUserEdit){
		   $fields = new FieldList (
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
			        
			    
			    
			  
			     
			    $actions = new FieldList(
		        new FormAction('HelpLabSaveProfile', 'Save Page')
		         );
		            
		        $form = new Form($this, 'HelpEditProfileForm', $fields, $actions);
		            
		        $HelpLabID = $this->ID;
		            
		        //$DisplayedHelpLab = DataObject::get_one("HelpLab", "HelpLab_Live.ID = $HelpLabID");
		        $DisplayedHelpLab = HelpLab::get()->filter(array('HelpLab_Live.ID' => '$HelpLabID'))->first(); 
		        
		        $form->loadDataFrom($DisplayedHelpLab->data());
	
		        return $form;
		 }
		 else {
		 	return Security::PermissionFailure($this->controller, 'You do not have permission to edit this profile.');
		 }
	  }

   
   function HelpLabSaveProfile($data, $form){
    
    	 $canUserEdit = $this->canUserEditHelpLab();
    	 
    	 if ($canUserEdit){
    	    	
		     $labID = $this->ID;
		     	   
		     //$MemberLab = DataObject::get_one('HelpLab', "HelpLab_Live.ID=$labID");
	    	 $MemberLab = HelpLab::get()->filter(array('HelpLab_Live.ID' => '$labID'))->first();
	    	 //return Debug::show($MemberLab);
	    	 
	    	 $form->saveInto($MemberLab); 
	    	 
	    	 $MemberLab->writeToStage("Stage");
	               
	         $MemberLab->publish("Stage","Live");
	                    
	         return Director::redirect($this->Link('/Edit/?saved=1'));  
	      
	     }
	     
	     else {
		
		 	return Security::PermissionFailure($this->controller, 'You do not have permission to edit this profile.');
		 
	     }
         
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