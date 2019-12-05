<?php

use SilverStripe\ORM\DataObject;



//No longer used
class MemberManagement extends DataObject {
    private static $db = array(
    "Name" => "Text",
    "Email" => "Text"
    );
    private static $has_one = array(
    );
    
  }
  
