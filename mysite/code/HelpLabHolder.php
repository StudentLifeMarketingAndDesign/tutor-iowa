<?php
class HelpLabHolder extends Page {
    static $db = array(
    );
    static $has_one = array(
    );
    
    static $allowed_children = array('HelpLab');
    
    static $defaults = array ('ProvideComments' => '1',
    
   
    
    );
}
  
class HelpLabHolder_Controller extends Page_Controller {
     
}