<?php

class TutorController extends ContentController{


	private static $allowed_actions = array(
		'ContactForm', 
		'editProfile', 
		'EditProfileForm', 
		'updateNameFromLdap',
        'view'
    );
    private static $url_handlers = array(
    	'edit//$action' => 'editProfile',
		'updateNameFromLdap//' => 'updateNameFromLdap',
        'view//$URLSegment' => 'view',
        'contact//$URLSegment//$action' => 'doContactTutor'
    );

    public function init(){
		parent::init();
	}

	public function view(){
		$name = $this->getRequest()->param('URLSegment');
		$tutor = Member::get()->filter(array('URLSegment' => $name))->First();
		//print_r($tutor);
		if ($tutor != null) {
			return $this->customise(new ArrayData(array(
						'Member'   => $tutor,
					)))->renderWith(array("TutorPage", "Page"));
		} else {
			return $this->httpError(404, 'Page not found');
		}
	}

	public function ContactForm() {

		// if($this->getRequest()->postVars()){
		// 	return;
		// }
		//print_r($this->get('Page')->toArray());
		$name = $this->getRequest()->param('URLSegment');
		$tutor = Member::get()->filter(array('URLSegment' => $name))->First();

		// debug::show($tutor->Link());

		$fields = new FieldList(
			$messageLabel = new TextAreaField('Body')
			//new HiddenField('TutorID', 'TutorID', $tutor->ID)
		);

		$actions = new FieldList(
			$messageAction = new FormAction('doContactTutor')
		);

		$validator = new RequiredFields('Email');
		$form = new Form($this, 'ContactForm', $fields, $actions, $validator);

		if($tutor){
			$fields->push(new HiddenField('TutorID', 'TutorID', $tutor->ID));
			$messageLabel->setTitle('<span>*</span> Your Message to '. $tutor->FirstName);
			$messageAction->setTitle('Send a Message to '. $tutor->FirstName);
			//add hidden field, relabel fields and include $tutor here
		}

		return $form;			

	}

	public function updateNameFromLdap(){
		$currentUser = Member::CurrentUser();
		$email = $currentUser->Email;

		$userLookup = $currentUser->lookupUser($email);
		//print_r($userLookup);
		if($userLookup){
			//echo 'user found, updating to '.$userLookup['firstName'].' '.$userLookup['lastName'];
			$currentUser->FirstName = $userLookup['firstName'];
			$currentUser->Surname = $userLookup['lastName'];

			$this->FirstName = $userLookup['firstName'];
			$this->Surname = $userLookup['lastName'];

			$this->write();
		}
		$currentUser->write();
		//$this->redirect($this->Link().'edit/');
	}

	public function doContactTutor($data, $form) {
		// print_r($data['TutorID']);
		$tutor = Member::get()->filter(array('ID' => $data['TutorID']))->First();
		// Debug::show($tutor);
		//debug::show($this->URLSegment); //TutorController
		$adminEmail = Config::inst()->get('Email', 'admin_email');

		$currentUser = Member::CurrentUser();

		if(!$currentUser){
			return Security::permissionFailure($this, 'An error on our part has occurred. If you keep seeing this message, please email us at imu-web@uiowa.edu. Sorry for the trouble.');
		}

		$from = $currentUser->Email;
		$name = $currentUser->FirstName.' '.$currentUser->Surname;

		$body = $data["Body"];
		$subject = "[Tutor Iowa] " . $name . " has contacted you.";
		$email = new Email();
		$toString = $tutor->Email;

		$email->setTo($toString);
		$email->setSubject($subject);
		$email->setFrom($adminEmail);
		$email->replyTo($from);
		$email->setBody($name . ' has contacted you. 
		You may reply to their message directly by <strong>replying to this email.</strong> 
		Their email should automatically be filled into the To:" field in your email app. If it isn\'t, please email them directly at <strong>'.$from.'.</strong>  <br /><br />
		Read their message below: <br /><br />' . $body. '<br /><br /><br />'.$name.'<br />'.$from);

		// if ((SS_ENVIRONMENT_TYPE == "live")) {
		// 	$email->send(); 
		// }
		//Debug::show($email);

		$message = new Message();

		$message->SenderName = $name;
		$message->SenderEmail = $from;
		$message->MessageBody = $body;
		$message->RecipientID = $tutor->ID;
		$message->SenderID = $member->ID;
		$message->RecipientName = $tutor->FirstName . ' ' . $tutor->Surname;

		$message->write();
		return $this->redirectBack();
		//return $this->renderWith('TutorController_doContactTutor');
		//return $this->redirect($tutor->Link('?sent=1'));

	}

	public function Sent() {
		return $this->request->getVar('sent');
	}
	public function Saved() {
		return $this->request->getVar('saved');
	}
	public function getFeedbackLink() {
		$linkPage = FeedbackPage::get()->First();
		$tutorID = $this->ID;
		$linkText = $linkPage->Link() . '?TutorID=' . $tutorID;
		return $linkText;
	}

	/**
	 * Main action to handle the Edit Profile Page, parses request for additional actions and calls them.
	 * @return HTMLText || action response.
	 */
	public function editProfile() {
		$currentPage = $this->getRequest()->param('URLSegment');
		$tutor = Member::get()->filter(array('URLSegment' => $currentPage))->First(); //get tutor info

		$action = $this->request->param('action');
		if (isset($action)) {
			$response = $this->$action($this->request);
			return $response;
		}

		$memberID = Member::CurrentUserID();
		if ($memberID == $tutor->ID) {
			$Data = array();
			//print_r(EmailAdmins::gatherStats());
			return $this->customise($Data)->renderWith(array("TutorPage_Edit", "Page"));
		} else {
			// TODO: send User back to edit profile page after they've logged in.
			$this->redirect(Security::login_url());
		}
	}

	/**
	 * Creates a form for Tutors to edit the content of their Profile Page.
	 * @return Form object
	 */
	public function EditProfileForm() {
		$Member = Member::CurrentUser();

		if ($Member) {
			$MemberID = $Member->ID;
			$tagField = new TextareaField('Tags', 'Tags (separate each tag with a comma and a space, example: Chemistry, Biochemistry)');

			$tagsLabel = '<p>Read the <a href="for-tutors/">For Tutors page</a> to learn more about tags and promoting yourself on Tutor Iowa!</p>';
			$HTMLEditorButtons = array(
				'btnGrp-design',
				'btnGrp-lists',
			);

			$bioField = new TrumbowygHTMLEditorField('Content', 'Biography');
			$bioField->setButtons($HTMLEditorButtons);

			$availabilityField = new TrumbowygHTMLEditorField('Hours', 'Availability');
			$availabilityField->setButtons($HTMLEditorButtons);

			$fields = new FieldList(

				// new LiteralField('Name', '<h2>'.$Member->Name.'</h2><p>If your name needs to be updated, <a href="'.$this->Link().'updateNameFromLdap/">click here to update it based on your MyUI preferences</a>.</p>'),
				new LiteralField('Name', '<h2>'.$Member->Name.'</h2>'),
				$bioField,
				$availabilityField,
				new DateField('StartDate', 'Date you would like to start tutoring'),
				new DateField('EndDate', 'Date you expect to stop tutoring'),
				new TextField('PhoneNo', 'Phone number <strong>(will not be shown publicly)</strong>'),
				new TextField('MeetingPreference', 'Meeting preference (on and/or off-campus)'),
				new TextField('HourlyRate', 'Hourly rate'),
				// new TextareaField('WhatToExpect', 'What to expect'),
				// new TextareaField('HowToPrepare', 'How to prepare'),
				new TextField('AcademicStatus', 'Status (undergrad, grad, faculty, staff)'),
				new TextField('GPA', 'GPA <strong>(will not be shown publicly)</strong>'),
				new UniversityIDField('UniversityID', 'University ID <strong>(will not be shown publicly)</strong>'),
				new TextField('Major'),
				new LiteralField('TagsHelpLabel', $tagsLabel),
				$tagField,
				//This does not sync with database (database field is 'Disabled')
				new CheckboxField('Disable', 'Request to disable your page (will no longer be returned as a search result on TutorIowa)')
			);


			$saveAction = new FormAction('SaveProfile', 'Save');
			$saveAction->addExtraClass('radius');

			$actions = new FieldList($saveAction);
			$validator = new RequiredFields('FirstName', 'Surname', 'Email');

			$Form = new FoundationForm($this, 'EditProfileForm', $fields, $actions, $validator);

			//Information must be loaded from both tutor and member because member stores a member/tutor's password
			$Form->loadDataFrom($Member->data());

			//Return the form
			return $Form;
		} else {
			$message = "<a href='Security/login'>You must be logged in to edit your profile. </a>  If you do not have an account,  <a href='registration-page'>register here.</a>";
			return $message;
		}
	}

	/**
	 * Saves Edit Tutor Page Form into Member.
	 * @param $data, $form
	 * @return RedirectBack
	 */
	public function SaveProfile($data, $form) {

		$Member = Member::CurrentUser();

		
		$formData = $form->getData();

		$form->saveInto($Member);

		$formDisabled = $formData['Disable'];
		if ($formDisabled) {
			//If user checked disable page box
			if ($DisablePage = DisablePage::get()->First())
			{
				$parameter = '?ID=' . $Member->ID;
				return $this->redirect($DisablePage->Link($parameter));
			}
		}

		return $this->redirect($this->Link('edit?saved=1'));
	}
}