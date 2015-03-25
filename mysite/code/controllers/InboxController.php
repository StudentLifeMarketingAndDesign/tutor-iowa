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
       'processImage' => 'processPendingImage'
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
	
	public function processPendingImage(SS_HTTPRequest $r) {
    	if ($r->isAjax() && $r->isPOST()) {			
    		$data = $r->postVars();
    		$imageID = isset($data['ImageID']) ? (int)$data['ImageID'] : NULL;
    		$processCode =  isset($data['ProcessCode']) ? (int)$data['ProcessCode'] : NULL;
            $unapprovedMessage = isset($data['UnapprovedMessage']) ? $data['UnapprovedMessage'] : NULL;
            
            $pendingImage = PendingImage::get()->byID($imageID);
            // 1 = approve, 2 = Unapproved
    		if ($processCode === 1) {
                $pendingImage->Status = "Approved";
    		} else if ($processCode === 2) {
                $pendingImage->Status = "Unapproved";
                $pendingImage->UnapprovedMessage = $unapprovedMessage;
    		}
            $pendingImage->write();
            $TP = TutorPage::get()->where("PendingCoverImageID OR PendingProfileImageID = " . $pendingImage->ID)->first();
            $data["tp"] = $TP->ID;
            $response = $TP->updatePendingImage($pendingImage, $processCode, $unapprovedMessage);  
    		$data["response"] = $response;
		} else {
			$data["response"] = "improper";
		}
		$sent = $this->sendPendingImageEmail($TP, $pendingImage);	
		$data["sent"] = $sent;	
		$this->response->addHeader("Content-Type", "application/json");
		return Convert::raw2json($data);
	}
	
	public function sendPendingImageEmail($Tutor, $processedImage) {
    	$notice = ($processedImage->Status == "Approved") ? "Approved, thanks for using Tutor Iowa!" : "Not been approved, you can try uploading a new one now though."; 
    	$body = "Hi! The image you uploaded to your Profile at Tutor Iowa has been " . $notice . "Please don't reply to this email.";
    		
        $email = new Email(); 
        $email->setTo($Tutor->Email); 
        $email->setFrom("TutorIowa"); 
        $email->setSubject("Tutor Iowa Profile Image Processed"); 
        $email->setBody($body); 
        return $email->send(); // returns boolean
	}
	
}
