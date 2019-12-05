<?php

use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;


//test comment

class HelpHolder extends Page {
  private static $db = array(
   );
  private static $has_one = array(
   );
   
  private static $allowed_children = array('HelpLab');

  private static $defaults = array ('ProvideComments' => '1');
  
   public function getCMSFields() {
        $fields = parent::getCMSFields();
    	$fields->addFieldToTab("Root.Main", new UploadField(Image::class, Image::class));
    	
    	return $fields;   
   }
}
 
