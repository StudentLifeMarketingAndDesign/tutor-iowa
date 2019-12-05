<?php
 
class SuppHolder extends Page {
  private static $db = array(
   );
  private static $has_one = array(
    
   );
   
  private static $allowed_children = array('SupplementalInstruction');
  
  private static $defaults = array ('ProvideComments' => '1',);
  
      
   public function getCMSFields() {
        $fields = parent::getCMSFields();
    	
    	return $fields;   
   }

//static $default_child = array('SupplementalInstruction'); */
 
}
 
