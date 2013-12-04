<?php

//test comment

class HelpHolder extends Page {
  private static $db = array(
   );
  private static $has_one = array(
  	"Image" => "Image"
   );
   
  private static $allowed_children = array('HelpLab');

  private static $defaults = array ('ProvideComments' => '1');
  
   public function getCMSFields() {
        $fields = parent::getCMSFields();
    	$fields->addFieldToTab("Root.Main", new UploadField("Image", "Image"));
    	
    	return $fields;   
   }
}
 
class HelpHolder_Controller extends Page_Controller {

  
}