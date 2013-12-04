<?php
 
class SuppHolder extends Page {
  private static $db = array(
   );
  private static $has_one = array(
  	"Image" => "Image"
   );
   
  private static $allowed_children = array('SupplementalInstruction');
  
  private static $defaults = array ('ProvideComments' => '1',);
  
      
   public function getCMSFields() {
        $fields = parent::getCMSFields();
    	$fields->addFieldToTab("Root.Main", new UploadField("Image", "Image"));
    	
    	return $fields;   
   }

//static $default_child = array('SupplementalInstruction'); */
 
}
 
class SuppHolder_Controller extends Page_Controller {
    
}