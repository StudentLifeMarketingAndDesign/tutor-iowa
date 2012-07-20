<?php

//test comment

class YourHelpLabs extends Page {
  static $db = array(
   );
  static $has_one = array(
   );

  static $defaults = array ('ProvideComments' => '1',
    
   
    
    );
    
   function getHelpLabs(){
	     $Member = Member::CurrentMember();
	     $IDMember = $Member->ID;
	     	     
	     $memberLabs = DataObject::get('HelpLab', "HelpLab_Live.ID in (SELECT DISTINCT HelpLabID from  `HelpLab_Members` where MemberID = $IDMember)");
	     
	     return $memberLabs;
   }
 
}
 
class YourHelpLabs_Controller extends Page_Controller {

  
}