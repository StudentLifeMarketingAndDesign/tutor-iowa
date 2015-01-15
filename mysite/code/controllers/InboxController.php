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
		'ReplyForm'
		//only allow replyform if the user is logged in
	);

	private static $url_handlers = array(
       // 'inbox/markAsRead' => 'markAsRead'
       'markAsRead' => 'markAsRead',  
       'ReplyForm' => 'ReplyForm'      
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

	public function markAsRead(SS_HTTPRequest $r) {

		if ($r->isAjax() && $r->isPOST() ) {
			$currentUserID = Member::currentUserID();
			
			$data = $r->postVars();
			$memberID = (int)$data['MemberID'];
			$messageID = (int)$data['MessageID'];
			
			if ($memberID == $currentUserID) {
				$MarkedMessage = Message::get()->byID($messageID);
								
				$MarkedMessage->ReadDateTime = time();
				$MarkedMessage->write();
				
				$data['MessageBody'] = $MarkedMessage->MessageBody;
				$jsonResponse = Convert::raw2json($data);
			} else {
				$data['Failed'] = "Unauthorized";
			}
		
			return $jsonResponse;
		} else {
			$this->index();
		}		
	}
	
	
	public function ReplyForm() {

		$fields = new FieldList(
			//new TextField('Email', '<span>*</span> Your Email Address'),
			//new TextField('Name', '<span>*</span> Your First and Last Name'),
			new TextAreaField('Body',  '<span>*</span> Your Message to ')

			);

		$actions = new FieldList(
			new FormAction('doReplyToStudent', 'Reply to Student')

			);

		$validator = new RequiredFields('Body');
		$form = new FoundationForm($this, 'ReplyForm', $fields, $actions, $validator);
	    //$protector = SpamProtectorManager::update_form($form, 'Message');
		//$form->enableSpamProtection();
		return $form;
	}

	public function doReplyToStudent($data, $form){

		$from = Member::currentUser()->Email;
		$name = Member::currentUser()->Name;    
		$body = $data["Body"];

		$subject = "[Tutor Iowa] ".$name." has contacted you.";
	    //$body = "Sent by " . $data["Email"] . "<br><br>" . $data["Body"];


	    //Emails from TutorUniverse.com should fail silently and a notification of the contact attempt should be sent to tutoriowa@uiowa.edu 
		$fromSubstring = stripos($from, 'TutorUniverse.com');


		if (!(($fromSubstring == false) || ($fromSubstring == ''))){
			$email = new Email(); 
			$email->setTo('dustin-quam@uiowa.edu; tutoriowa@uiowa.edu;');
			$email->setSubject('TutorUniverse email blocked');
			$email->setFrom(Email::getAdminEmail());
			$email->replyTo($from);
			$email->setBody($body);
			$email->send(); 	
		}

	    //If the email is not from TutorUniverse, send the email
		else {       

			$email = new Email(); 
			$toString = $this->Email;
			$email->setTo($toString); 
			$email->setSubject($subject); 
			$email->setFrom(Email::getAdminEmail());
			$email->replyTo($from);
			$email->setBody($name.' has contacted you. Read their message below. You may reply to their message directly by replying to this email. <br />'.$body);
			// Uncomment this before prouction
			//$email->send();

			$message = new Message();

			$message->SenderName = $name;
			$message->SenderEmail = $from;
			$message->MessageBody = $body;
			$message->RecipientID = $this->Member()->ID;
			$message->RecipientName = $this->Member()->FirstName.' '.$this->Member()->Surname;		    

			$message->write();

			$statspage = StatsPage::get()->first(); 
			$temp = $statspage->TutorRequestCount;
			$temp++;

			$statspage->TutorRequestCount = $temp;
		    //return Debug::show($statspage);
			Versioned::reading_stage('stage');

			$statspage->writeToStage('Stage');

			$statspage->publish("Stage", "Live");

			Versioned::reading_stage('Live');

			$statspage->write();	    

		} 

		return $this->redirect($this->Link('?sent=1'));   


	}

	public function Sent(){
		return $this->request->getVar('sent');
	}

	public function Saved(){
		return $this->request->getVar('saved');
	}

	public function getFeedbackLink(){
		$linkPage = FeedbackPage::get()->First();
		$tutorID = $this->ID;
		$linkText = $linkPage->Link() . '?TutorID=' . $tutorID;
		return $linkText;
	}  

	
}
