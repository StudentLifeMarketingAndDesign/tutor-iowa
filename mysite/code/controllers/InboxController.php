<?php
class Inbox_Controller extends Page_Controller {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */

	private static $allowed_actions = array(
		'markAsRead', 
		'ReplyForm',
		'unread',
		'nextPage'
		//only allow replyform if the user is logged in
	);

	private static $url_handlers = array(
       // 'inbox/markAsRead' => 'markAsRead'
       'markAsRead' => 'markAsRead',  
       'ReplyForm' => 'ReplyForm',
       'unread' => 'unread',
       'nextPage' => 'nextPage' 
    );
    
	public function init() {
		parent::init();
		
	}
	
	public function index(){
		$member = Member::currentUser();
		
		if (isset($member)) {
			/*
			$messages = $member->Messages();
			
			$Data = array (
				"Messages" => $messages
			);

			//print_r($messages);
			//print_r(gettype($inbox));
			return $this->customise($Data)->renderWith(array('Inbox', 'Page'));
			*/
			return $this->renderWith(array('Inbox', 'Page'));

		} else {
			
			$this->redirect('security/login');
		}

	}
	
	public function paginatedMessages() {
		$member = Member::CurrentUser(); 
		$list = $member->Messages()->sort('Created DESC');;
		$pl = new PaginatedList($list, $this->request);
		$pl->setPageLength(5);
		return $pl;
	    
    }
	
	public function nextPage(SS_HTTPRequest $r) {
		$data = $r->getVars();
		return Convert::raw2json($data);
	}
	
	public function unread() {
		//returns all unread messages as rendered html to slap into the inbox
		$unreadMessageList = DataObject::get("Message", "ReadDateTime IS NULL AND RecipientID =" . Member::currentUserID(), "Created DESC");
				
		return $this->renderWith("Unread");
	}
	
	private static function unreadMessageCount() {
		$member = Member::currentUser();
		$messages = $member->Messages("ReadDateTime = NULL");
		
		return $messages->Debug();
	}

	private function markAsRead(SS_HTTPRequest $r) {

		if ($r->isAjax() && $r->isPOST() ) {
			$currentUserID = Member::currentUserID();
			
			$data = $r->postVars();
			$memberID = (int)$data['MemberID'];
			$messageID = (int)$data['MessageID'];
			
			if ($memberID == $currentUserID) {
				$MarkedMessage = Message::get()->byID($messageID);
								
				$MarkedMessage->ReadDateTime = time();
				$MarkedMessage->write();
				
				//$data['MessageBody'] = $MarkedMessage->MessageBody;
				
			} else {
				$data['Failed'] = "Unauthorized";
			}
		
		} else {
			$data = "improper";
		}		
		
		return Convert::raw2json($data);

	}
		

	public function getFeedbackLink(){
		$linkPage = FeedbackPage::get()->First();
		$tutorID = $this->ID;
		$linkText = $linkPage->Link() . '?TutorID=' . $tutorID;
		return $linkText;
	}  

	
}
