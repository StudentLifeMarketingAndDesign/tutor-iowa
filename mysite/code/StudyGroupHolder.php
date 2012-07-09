<?php
class StudyGroupHolder extends Page {
    static $db = array(
    );
    static $has_one = array(
    );
    
    static $allowed_children = array('StudyGroup');
    
    static $defaults = array ('ProvideComments' => '1',
    
   
    
    );
}
  
class StudyGroupHolder_Controller extends Page_Controller {
     
}