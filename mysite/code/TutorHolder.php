<?php
class TutorHolder extends Page {
    static $db = array(
    );
    static $has_one = array(
    );
    
    static $allowed_children = array('TutorPage');
    
    static $defaults = array ('ProvideComments' => '1',
    
   
    
    );
}
  
class TutorHolder_Controller extends Page_Controller {
     
}