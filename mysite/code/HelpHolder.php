<?php
 
class HelpHolder extends Page {
  static $db = array(
   );
  static $has_one = array(
   );
   
  static $allowed_children = array('AcademicHelp');

  static $defaults = array ('ProvideComments' => '1',
    
   
    
    );
 
}
 
class HelpHolder_Controller extends Page_Controller {

  
}