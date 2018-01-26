<?php
class TutorPage extends Page {

	//Add extra database fields
	private static $db = array(
		'Bio' => 'HTMLText',
		'PhoneNo' => 'Varchar',
		'Hours' => 'HTMLText',
		'Disabled' => 'Boolean',
		'Approved' => 'Boolean',
		'FirstName' => 'Text',
		'Surname' => 'Text',
		'StartDate' => 'Date',
		'EndDate' => 'Date',
		'Notes' => 'Text',
		'HourlyRate' => 'Text',
		'MeetingPreference' => 'Text',
		'AcademicStatus' => 'Text',
		'UniversityID' => 'Text',
		'Major' => 'Text',
		'GPA' => 'Text',
		'EligibleToTutor' => 'Boolean',
		'PublishFlag' => 'Boolean',
		'ApprovalStatus' => "Enum('Provisional, Active, Inactive, Ineligible')",
		'WhatToExpect' => 'HTMLText',
		'HowToPrepare' => 'HTMLText',
	);

	private static $has_one = array(
		'Member' => 'Member',
		'AcademicHelp' => 'AcademicHelp',
		'HomePage' => 'HomePage',
		'PendingCoverImage' => 'CoverImage',
		'ApprovedCoverImage' => 'CoverImage',
		'UnapprovedCoverImage' => 'CoverImage',
		'PendingProfileImage' => 'ProfileImage',
		'ApprovedProfileImage' => 'ProfileImage',
		'UnapprovedProfileImage' => 'ProfileImage',

	);

	private static $has_many = array(
		'FeedbackItems' => 'FeedbackItem',
	);

	private static $defaults = array(
		'ProvideComments' => '1',
		'UniversityID' => null,
		'GPA' => null,
		'EligibleToTutor' => '1',
	);

	private static $default_sort = 'Surname ASC';

	private static $summary_fields = array(
		'FirstName' => 'First Name',
		'Surname' => 'Last Name',
		'Major' => 'Major',
		'Email' => 'Email',
		'Parent.Title' => 'Approval Status',
		//'ApprovalStatus' => 'Approval Status',
	);
	private static $searchable_fields = array(
		'FirstName',
		'Surname',
		'Major',
		'Email',
		'Parent.Title',
	);

	public function getEmail(){
		$member = $this->Member();
		//print_r($member->Email);
		return $member->Email;
	}

	/**
	 * The following 7 functions are from the previous iteration of TutorIowa, and may no longer be neccessary.
	 */
	public function getCMSFields() {

		$fields = parent::getCMSFields();

		$members = Member::get();
		$membersDropdownSource = $members->Map('ID', 'Email');

		$tagField = new TextareaField("Tags", "Tags");
		//$tagField->setTagTopicClass("SiteTree");

		$fields->renameField("Image", "Photo");
		$fields->removeFieldFromTab('Root.Metadata', "Keywords");
		$fields->removeFieldFromTab('Root.Main', "Content");
		$fields->addFieldToTab('Root.Main', new ReadonlyField("FirstName", "First name of tutor"));
		$fields->addFieldToTab('Root.Main', new ReadonlyField("Surname", "Last name of tutor"));
		$fields->addFieldToTab('Root.Main', new TextField("PhoneNo", "Phone Number"));
		$fields->addFieldToTab('Root.Main', new ReadonlyField("Email"));

		//$approvalStatusField = DropdownField::create('ApprovalStatus', 'ApprovalStatus', singleton('TutorPage')->dbObject('ApprovalStatus')->enumValues());

		//$fields->addFieldToTab('Root.Main', $approvalStatusField);
		$fields->addFieldToTab('Root.Main', new CheckboxField('EligibleToTutor', 'Is this tutor eligible?', true));
		$fields->addFieldToTab('Root.Main', $tagField);
		$fields->addFieldToTab('Root.Main', new TextAreaField("Content", "Biography"));
		$fields->addFieldToTab('Root.Main', new TextAreaField("Hours", "Availability"));

		$fields->addFieldToTab('Root.Main', new TextAreaField("Notes", "Approved Courses And Notes"));
		$fields->addFieldToTab('Root.Main', new DateField("StartDate", "Date you plan to start tutoring"));
		$fields->addFieldToTab('Root.Main', new DateField("EndDate", "Date you expect to stop tutoring"));
		$fields->addFieldToTab('Root.Main', new TextField("HourlyRate", "Hourly rate"));
		$fields->addFieldToTab('Root.Main', new TextField("MeetingPreference", "Meeting preference (on-campus or off-campus)"));
		$fields->addFieldToTab('Root.Main', new TextField("UniversityID", "University ID"));
		$fields->addFieldToTab('Root.Main', new TextField("GPA", "GPA"));
		$fields->addFieldToTab('Root.Main', new TextField("Major"));
		$fields->addFieldToTab('Root.Main', new TextField("AcademicStatus", "Academic Status"));
		$fields->addFieldToTab('Root.Main', new HTMLEditorField("WhatToExpect", "What to Expect"));
		$fields->addFieldToTab('Root.Main', new HTMLEditorField("HowToPrepare", "How to Prepare"));


		$fields->addFieldToTab('Root.Advanced', new DropdownField("MemberID", "Associated User", $membersDropdownSource));

		$gridFieldConfigFeedbackItems = GridFieldConfig_RecordEditor::create();
		$gridfield = new GridField("FeedbackItem", "Feedback Items", $this->FeedbackItems(), $gridFieldConfigFeedbackItems);
		$fields->addFieldToTab('Root.FeedbackItems', $gridfield);

		return $fields;

	}

	public function RelatedResources() {

		$searchTerm = $this->Tags . ' ' . $this->Content;

		$results = $this->search($searchTerm);

		//Remove this tutor from results
		$tutors = $results->getField('Tutors');
		$thisTutorInResults = $tutors->find('ID', $this->ID);
		$results->getField('Tutors')->remove($thisTutorInResults);

		return $results;
	}

	public function getContent() {
		//print_r($this->getField("Content"));
		if ($this->getField("Content")) {
			return $this->getField("Content");
		} else {
			$tempBio = "I haven't filled out my profile yet.";
			return $tempBio;
		}
	}

	private function getEmails() {
		return MemberManagement::get();
	}

	public function isCertfied(){
		$tags = $this->Tags;
		if ($tags->contains("Certified Tutor")){
			return True;
		}
	}

}
class TutorPage_Controller extends Page_Controller {

	private static $allowed_actions = array(
		'ContactForm', 
		'editProfile', 
		'EditProfileForm', 
		'repositionCoverImage',
		'contact'
		//'updateNameFromLdap'
	);

	private static $url_handlers = array(
		'edit//$action' => 'editProfile',
		'updateNameFromLdap//' => 'updateNameFromLdap'
	);
	public function init(){
		parent::init();
		// $currentUser = Member::currentUser();
		// if(!$currentUser){
		// 	return Security::permissionFailure($this, 'hey');
		// }
		

	}


	public function ContactForm() {

		//print_r($this->Email);
		$fields = new FieldList(
			new TextAreaField('Body', '<span>*</span> Your Message to ' . $this->FirstName)
		);

		$actions = new FieldList(
			new FormAction('doContactTutor', 'Send a Message to ' . $this->FirstName)
		);

		$validator = new RequiredFields('Email');
		$form = new FoundationForm($this, 'ContactForm', $fields, $actions, $validator);
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
		$adminEmail = Config::inst()->get('Email', 'admin_email');

		$currentUser = Member::CurrentUser();

		if(!$currentUser){
			return Security::permissionFailure($this, 'hey');
		}

		$from = $currentUser->Email;
		$name = $currentUser->FirstName.' '.$currentUser->Surname;

		$body = $data["Body"];
		$subject = "[Tutor Iowa] " . $name . " has contacted you.";
		$email = new Email();
		$toString = $this->Email;

		$email->setTo($toString);
		$email->setSubject($subject);
		$email->setFrom($adminEmail);
		$email->replyTo($from);
		$email->setBody($name . ' has contacted you. 
		You may reply to their message directly by <strong>replying to this email.</strong> 
		Their email should automatically be filled into the To:" field in your email app. If it isn\'t, please email them directly at <strong>'.$from.'.</strong>  <br /><br />
		Read their message below: <br /><br />' . $body. '<br /><br /><br />'.$name.'<br />'.$from);

		if ((SS_ENVIRONMENT_TYPE == "live")) {
			$email->send(); 
		}

		$message = new Message();

		$message->SenderName = $name;
		$message->SenderEmail = $from;
		$message->MessageBody = $body;
		$message->RecipientID = $this->Member()->ID;
		$message->RecipientName = $this->Member()->FirstName . ' ' . $this->Member()->Surname;

		$message->write();

		return $this->redirect($this->Link('?sent=1'));

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
		$action = $this->request->param('action');
		if (isset($action)) {
			$response = $this->$action($this->request);
			return $response;
		}

		$memberID = Member::CurrentUserID();
		if ($memberID == $this->Member()->ID) {
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
			$Form->loadDataFrom($this->data());

			//Return the form
			return $Form;
		} else {
			$message = "<a href='Security/login'>You must be logged in to edit your profile. </a>  If you do not have an account,  <a href='registration-page'>register here.</a>";
			return $message;
		}
	}

	/**
	 * Saves Edit Tutor Page Form into TutorPage and Member.
	 * @param $data, $form
	 * @return RedirectBack
	 */
	public function SaveProfile($data, $form) {

		$Member = Member::CurrentUser();
		$MemberID = $Member->ID;

		$Tutor = TutorPage::get()->filter(array('MemberID' => $MemberID))->first();

		// Save into the member dataobject.
		$memberFieldList = array(
			"FirstName",
			"Surname"
		);
		$formData = $form->getData();

		$form->saveInto($Tutor);

		/*Preserve this code, for it works the magic of SilverStripe 3 publishing: */
		$Tutor->writeToStage('Stage');
		$Tutor->publish("Stage", "Live");
		Versioned::reading_stage('Live');
		$Tutor->write();

		$formDisabled = $formData['Disable'];
		if ($formDisabled) {
			//If user checked disable page box
			if ($DisablePage = DisablePage::get()->First())
			{
				$parameter = '?ID=' . $Tutor->ID;
				return $this->redirect($DisablePage->Link($parameter));
			}
		}

		return $this->redirect($this->Link('edit?saved=1'));
	}

}
