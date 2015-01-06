<?php
class TutorHolder extends Page {
    private static $db = array(
    );
    private static $has_one = array(
    );
    
    private static $allowed_children = array('TutorPage');
    
    private static $defaults = array ('ProvideComments' => '1');
    
    private static $extensions = array(
		'PageHolderExtension'
   	);

	private static $excluded_children = array('TutorPage');

}
  
class TutorHolder_Controller extends Page_Controller {
     
}