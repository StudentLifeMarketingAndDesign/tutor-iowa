<?php
//MemberDecorator is not used on the current site

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
	
	
	/*
	private function getMessages($memberObject) {
		
		$memberMessages = $this->owner->Messages();
		//print_r($memberMessages);
		
		$Data = array();
		
		foreach ($memberMessages as $key => $message) {
			$Data[$key]['SenderEmail'] = $message->SenderEmail;
			$Data[$key]['SenderName'] = $message->SenderName;
			//print_r(get_class($message->MessageBody));
			$Data[$key]['MessageBody'] = $message->MessageBody;
			$Data[$key]['RecipientName'] = $message->RecipientName;
		}
		
		$ArrayList = new ArrayList($Data);
		
		return $memberMessages;
	}
	*/
}

