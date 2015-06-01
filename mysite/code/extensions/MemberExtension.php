<?php
class MemberExtension extends DataExtension {

    private static $belongs_many_many = array(
        "HelpLabs" => "HelpLab"
    );
    
    private static $has_many = array(
		"Messages" => "Message"
	);
    
    	
    public function unreadMessageCount(){
	    $member = $this->owner; 
	    
	    //return the count of Messages without a ReadDateTime.
	    return $member->Messages()->where("ReadDateTime IS NULL")->Count();    
    }
    
    public function allMessageCount() {
	   $member = $this->owner; 
	   //return the count of Messages without a ReadDateTime.
	   
	   return $member->Messages()->Count(); 
    }
}

