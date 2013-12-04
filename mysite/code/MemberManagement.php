<?php


//No longer used
class MemberManagement extends DataObject {
    private static $db = array(
    "Name" => "Text",
    "Email" => "Text"
    );
    private static $has_one = array(
    );
    
  }
  
class MemberManagement_Controller extends Page_Controller {
     
}