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
		'unreadCount',
		'nextPage',
		'markAsDeleted',
		'pendingForApproval' => 'ADMIN',
		'processPendingImage' => 'ADMIN'
		//only allow replyform if the user is logged in
	);

	private static $url_handlers = array(
       'markAsRead' => 'markAsRead',  
       'ReplyForm' => 'ReplyForm',
       'unread' => 'unread',
       'unreadCount' => 'unreadCount',
       'nextPage' => 'nextPage',
       'markAsDeleted' => 'markAsDeleted',
       'process' => 'processPendingImage'
    );
    
	public function init() {
		parent::init();	
	}
	
	public function index(){
		$member = Member::currentUser();
		if (isset($member)) {
			return $this->renderWith(array('Inbox', 'Page'));
		} else {		
			$this->redirect('security/login');
		}

	}
	
	public function paginatedMessages() {
		$member = Member::currentUser();
		$list = $member->Messages()->where("MarkAsDeleted IS NULL")->sort('Created DESC');;
		$pl = new PaginatedList($list, $this->request);
		$pl->setPageLength(5);
		return $pl;
	    
    }
	
	public function nextPage(SS_HTTPRequest $r) {
		$data = $r->getVars();
		return Convert::raw2json($data);
	}
	
	public function unread() {
		$member = Member::currentUser();
		//returns all unread messages as rendered html to slap into the inbox
		$unreadMessageList = DataObject::get("Message", "ReadDateTime IS NULL AND RecipientID =" . $member->ID, "Created DESC");
		
		$Data = array (
			'unreadMessages' => $unreadMessageList
		);

		return $this->customise($Data)->renderWith(array('Unread'));

	}
	
	public function unreadCount() {
		$member = Member::currentUser();
		$unreadMessageCount = $member->unreadMessageCount();	
		return Convert::raw2json($unreadMessageCount);
	}

	public function markAsRead(SS_HTTPRequest $r) {
		if ($r->isAjax() && $r->isPOST() && $markedMessage = $this->markedMessage($r)) {
			$markedMessage->ReadDateTime = time();
			$markedMessage->write();

			// get new SS_datetime
			$markedMessage = Message::get()->byID($markedMessage->ID);
			$data["ReadDateTime"] = $markedMessage->ReadDateTime;
				
		} else {
			$data['Failed'] = "Unauthorized";
		}
		
		return Convert::raw2json($data);

	}
	
	public function markedMessage($r) {
		$member = Member::currentUser();
		$currentUserID = $member->ID;
			
		$data = $r->postVars();
		$memberID = (int)$data['MemberID'];
		$messageID = (int)$data['MessageID'];
			
		if ($memberID == $currentUserID) {
			$markedMessage = Message::get()->byID($messageID);
			return $markedMessage;
		} else {
			return false;
		}
			
	}
	
	public function markAsDeleted(SS_HTTPRequest $r) {
		if ($r->isAjax() && $r->isPOST() && $markedMessage = $this->markedMessage($r)) {			

			$this->markAsRead($r);
			$markedMessage->MarkAsDeleted = time();
			$markedMessage->write();
			
			// get new SS_datetime
			$markedMessage = Message::get()->byID($markedMessage->ID);
			$data["markAsDeleted"] = $markedMessage->MarkAsDeleted;
		} else {
			$data = "improper";
		}		
		$this->response->addHeader("Content-Type", "application/json");
		return Convert::raw2json($data);
	}
		
	public function getFeedbackLink(){
		$linkPage = FeedbackPage::get()->First();
		$tutorID = $this->ID;
		$linkText = $linkPage->Link() . '?TutorID=' . $tutorID;
		return $linkText;
	}  
	
	public function pendingProfileImages() {
		$pending = ProfileImage::get()->filter(array('Status' => 'Pending'));
		return $pending;
		
	}
	
	public function pendingCoverImages() {
        $pending = CoverImage::get()->filter(array('Status' => 'Pending'));
		return $pending;
	}
	
	public function processPendingImage() {
    	if ($r->isAjax() && $r->isPOST()) {			
            $member = Member::currentUser();
    		$currentUserID = $member->ID;	
    		$data = $r->postVars();
    		$imageID = (int)$data['ImageID'];
    		// 1 = approve, 2 = disapprove
    		$processID = (int)$data['ProcessID'];
    		if ($processID === 2) {
        		$disapproveMessage = $data['disapproveMessage'];
    		}
    			
    		if ($memberID == $currentUserID) {
    			$markedMessage = Message::get()->byID($messageID);
    			return $markedMessage;
            }

		} else {
			$data = "improper";
		}		
		$this->response->addHeader("Content-Type", "application/json");
		return Convert::raw2json($data);
	}
	
}
