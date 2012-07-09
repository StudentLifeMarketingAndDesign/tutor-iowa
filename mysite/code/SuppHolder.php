<?php
 
class SuppHolder extends Page {
  static $db = array(
   );
  static $has_one = array(
   );
   
  static $allowed_children = array('SupplementalInstruction');
  
  static $defaults = array ('ProvideComments' => '1',
    
   
    
    );

//static $default_child = array('SupplementalInstruction'); */
 
}
 
class SuppHolder_Controller extends Page_Controller {
    
}