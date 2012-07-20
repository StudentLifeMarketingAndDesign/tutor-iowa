<?php



//MemberDecorator is not used on the current site

class MemberDecorator extends DataObjectDecorator {
 	
 	
    //Add extra database fields
    public function extraStatics()
    {   
        return array(
            'belongs_many_many' => array(
             	'HelpLabs' => 'HelpLab',
             ),
        );
    }
    
 
     /*
    //Add form fields to CMS
    public function updateCMSFields(FieldSet &$fields) 
    {
             
        $fields->addFieldToTab("Root.Profile", new TextareaField('Bio', 'Bio')); 
        $fields->addFieldToTab("Root.Profile", new TextField('PhoneNo', 'Phone No'));
       
       $tagsTablefield = new DataObjectManager(
         $this,
         'Tags',
         'Tag',
         array(
        'TagLabel' => 'Tag Label'
         ),
         'getCMSFields_forPopup'
      );
      
      //$tablefield->setParentClass('Member');
      
       $fields->addFieldToTab( 'Root.Tags', $tagsTablefield );
       
       /*
       $tagsTable = new ComplexTableField($this, 'Tags', 'Tag');
      $fields->addFieldToTab( 'Root.Tags', $tagsTable);
      
       return $fields;

          
    }
    
    public function getTags(){
	    //return this->extraStatics->Tags();
    }
    
    function populateTemplate() {
	 if (isset($_GET['ID'])){
	 	$ID = $_GET['ID'];
	 	if (is_int(intval($ID))){
	  		$templateInfo = DataObject::get_by_id("SupplementalInstruction", $ID);
	  		return $templateInfo;
	  	}
	 }
  }
*/  
}



class MemberDecorator_Controller extends Page_Controller { 
		
    
} 

*/