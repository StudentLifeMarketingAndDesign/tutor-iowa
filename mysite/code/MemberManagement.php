<?php


//No longer used



class MemberManagement extends DataObject {
    static $db = array(
    "Name" => "Text",
    "Email" => "Text"
    );
    static $has_one = array(
    );
    
  }
  
class MemberManagement_Controller extends Page_Controller {
     
}