<?php
class StudyGroupHolder extends Page {
    private static $db = array(
    );
    private static $has_one = array(
    );
    
    private static $allowed_children = array('StudyGroup');
    
    private static $defaults = array ('ProvideComments' => '1',
    
   
    
    );
}
  
class StudyGroupHolder_Controller extends Page_Controller {
     
}