<?php
 
 
 //NOT IN USE 
class IsDisabled extends DataObject {
   private static $db = array(
   'Disabled' => 'Boolean'
   );
   private static $has_one = array(
   'Member' => 'Member'
   );
   /*
   public function __construct(){
	  parent::__construct();
	  $this->Disabled = 0;
	  $this->write();
   }
   */
}
 
class IsDisabled_Controller extends Page_Controller {
     
}