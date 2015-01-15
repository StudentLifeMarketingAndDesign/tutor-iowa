<?php
//MemberDecorator is not used on the current site

class MemberExtension extends DataExtension {

    private static $belongs_many_many = array(
        "HelpLabs" => "HelpLab"
    );
    
    private static $has_many = array(
		"Messages" => "Message"
	);
    
    /*
    public function Messages(){
	    $member = $this->owner; 
	    
	    $memberId = $member->ID;
	    $this->owner->ID
	    
    }
	*/
	
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

