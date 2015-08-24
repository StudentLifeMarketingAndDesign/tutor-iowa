<?php
class InboxController extends ContentController {

	private static $allowed_actions = array(
		'index',
		'markAsRead',
		'ReplyForm',
		'unread',
		'unreadCount',
		'nextPage',
		'markAsDeleted',
		'pendingForApproval' => 'ADMIN',
		'processPendingImage' => 'ADMIN',
	);

	private static $url_handlers = array(
		'markAsRead' => 'markAsRead',
		'ReplyForm' => 'ReplyForm',
		'unread' => 'unread',
		'unreadCount' => 'unreadCount',
		'nextPage' => 'nextPage',
		'markAsDeleted' => 'markAsDeleted',
		'processImage' => 'processPendingImage',
	);

	public function init() {
		parent::init();
	}

	/**
	 * Checks if the user is logged in. If set, show the inbox view, otherwise redirect them to the login page.
	 * @return SS_HTTPResponse || redirect
	 */
	public function index() {

		$member = Member::currentUser();
		if (isset($member)) {
			//PendingImage::cleanUpPendingImages();
			$data = array(
				'Title' => 'Inbox',
			);
			return $this->customise($data)->renderWith(array('Inbox', 'Page'));
		} else {
			$this->redirect('security/login');
			//echo 'failure';
		}
	}

	/**
	 * Paginated Messages are tapped into by an infinite scroll script in the front end, but will fallback to the SS paginatedMessages
	 * functionality otherwise.
	 * @return PaginatedList (SS_HTTPResponse)
	 */
	public function paginatedMessages() {
		$member = Member::currentUser();
		if (isset($member)) {
			$list = $member->Messages()->where("MarkAsDeleted IS NULL")->sort('Created DESC');
			$pl = new PaginatedList($list, $this->request);
			$pl->setPageLength(5);
			return $pl;
		} else {
			$this->httpError(404);
		}
	}

	/*
	public function nextPage(SS_HTTPRequest $r) {
	$data = $r->getVars();
	return Convert::raw2json($data);
	}
	 */

	/**
	 * Used to return a current list of messages that are not marked as read to the inbox. Plopped straight into the template.
	 * @return SS_HTTPResponse
	 */
	public function unread() {
		$member = Member::currentUser();
		if (isset($member)) {
			//returns all unread messages as rendered html to slap into the inbox
			$unreadMessageList = DataObject::get("Message", "ReadDateTime IS NULL AND RecipientID =" . $member->ID, "Created DESC");

			$Data = array(
				'unreadMessages' => $unreadMessageList,
			);

			return $this->customise($Data)->renderWith(array('Unread'));
		} else {
			$this->httpError(404);
		}
	}

	/**
	 * Helper function to access the number of unread message associated with $this user
	 * @return int
	 */
	public function unreadCount() {
		$member = Member::currentUser();

		if (isset($member)) {
			$unreadMessageCount = $member->unreadMessageCount();
			return Convert::raw2json($unreadMessageCount);
		} else {
			$this->httpError(404);
		}
	}

	/**
	 * Helper function to retrieve a specific message for handling by other functions (markAsRead, markAsDeleted)
	 * @param SS_HTTPRequest $r
	 * @return Message|false
	 */
	public function markedMessage(SS_HTTPRequest $r) {
		$member = Member::currentUser();

		if (isset($member)) {
			$currentUserID = $member->ID;

			$data = $r->postVars();
			$memberID = (int) $data['MemberID'];
			$messageID = (int) $data['MessageID'];

			if ($memberID == $currentUserID) {
				$markedMessage = Message::get()->byID($messageID);
				return $markedMessage;
			} else {
				return false;
			}
		} else {
			$this->httpError(404);
		}

	}

	/**
	 * Server side method for handling the marksAsRead action for Tutors in their inbox View.
	 * Note: This merely adds a flag to the db record.
	 * @param SS_HTTPRequest $r
	 * @return JSON Response
	 */
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

	/**
	 * Server side method for handling the delete action for Tutors to delete messages in their inbox from the View.
	 * Note: This does not actually delete the file, it merely adds a flag to it's db record.
	 * @param SS_HTTPRequest $r
	 * @return JSON Response
	 */
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

	public function pendingProfileImages() {return ProfileImage::getPending();}
	public function pendingCoverImages() {return CoverImage::getPending();}

	/**
	 * Server side method to handle AJAX Push requests from the Inbox view available to Administrators to approve or deny
	 * TutorPage images (ProfileImage, CoverImage). Makes calls to process the image in the associated TutorPage.
	 * @param SS_HTTPRequest $r
	 * @return JSON Response
	 */
	public function processPendingImage(SS_HTTPRequest $r) {
		if ($r->isAjax() && $r->isPOST()) {
			$data = $r->postVars();
			$imageID = isset($data['ImageID']) ? (int) $data['ImageID'] : NULL;
			$processCode = isset($data['ProcessCode']) ? (int) $data['ProcessCode'] : NULL;
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
			if (isset($TP)) {
				$data["tp"] = $TP->ID;
				$response = $TP->updatePendingImage($pendingImage, $processCode, $unapprovedMessage);
				$data["response"] = $response;
			} else {
				$data["response"] = "no tutor page found";
			}
		} else {
			$data["response"] = "improper";
		}
		$sent = $this->sendImageProcessedEmail($TP, $pendingImage);
		$data["sent"] = $sent;
		$this->response->addHeader("Content-Type", "application/json");
		return Convert::raw2json($data);
	}

	/**
	 * Server side method to handle AJAX Push requests from the Inbox view available to Administrators to approve or deny
	 * TutorPage images (ProfileImage, CoverImage). Returns True if the email was succesfully sent, false otherwise.
	 * @param TutorPage $tutorPage
	 * @param PendingImage $processedImage
	 * @return Boolean
	 */
	public function sendImageProcessedEmail($tutorPage, $processedImage) {
		$notice = ($processedImage->Status == "Approved") ? "Approved, thanks for using Tutor Iowa!" : "Not been approved, you can try uploading a new one now though.";
		$body = "Hi! The image you uploaded to your Profile at Tutor Iowa has been " . $notice . "Please don't reply to this email.";

		$email = new Email();
		$email->setTo($tutorPage->Email);
		$email->setFrom("TutorIowa");
		$email->setSubject("Tutor Iowa Profile Image Processed");
		$email->setBody($body);
		return $email->send(); // returns boolean
	}

}
