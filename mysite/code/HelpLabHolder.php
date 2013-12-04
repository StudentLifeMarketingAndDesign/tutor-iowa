<?php
/*

HelpLabHolder is just used for site organization purposes.  If you are looking for the page that shows a help lab editor's help labs, consult YourHelpLabs.ss


*/
class HelpLabHolder extends Page {
    private static $db = array(
    );
    private static $has_one = array(
    );
    
    private static $allowed_children = array('HelpLab');
    
    private static $defaults = array ('ProvideComments' => '1',
    
   
    
    );
}
  
class HelpLabHolder_Controller extends Page_Controller {
     
}