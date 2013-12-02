<?php
 
class SuppHolder extends Page {
  static $db = array(
   );
  static $has_one = array(
  	"Image" => "Image"
   );
   
  static $allowed_children = array('SupplementalInstruction');
  
  static $defaults = array ('ProvideComments' => '1',);
  
      
   public function getCMSFields() {
        $fields = parent::getCMSFields();
    	$fields->addFieldToTab("Root.Main", new UploadField("Image", "Image"));
    	
    	return $fields;   
   }

//static $default_child = array('SupplementalInstruction'); */
 
}
 
class SuppHolder_Controller extends Page_Controller {
    
}