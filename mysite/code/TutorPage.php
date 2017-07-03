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
		'Email' => 'Text',
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

	private static $show_in_sitetree = false;
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
	/**
	 * Main Function for managing Pending, Approved, and Unapproved Images. Called by InboxController::processPendingImage()
	 * to process approval/unapproval of TutorPage images by TutorIowa Administrators.
	 * @param PendingImage $image
	 * @param int (1,2) $processCode
	 * @param string $message
	 * @return Array
	 */
	public function updatePendingImage($image, $processCode, $message) {
		$imgClass = $image->class;
		if (($imgClass) == "CoverImage") {
			if ($processCode === 1) {
				$this->ApprovedCoverImageID = $image->ID;
				$this->UnapprovedCoverImageID = 0;
			} else if ($processCode === 2) {
				$this->UnapprovedCoverImageID = $image->ID;
			}
			$this->PendingCoverImageID = 0; // reset the pending cover image relation
			$success = "CoverImage Processed";
		} else if (($imgClass) == "ProfileImage") {
			if ($processCode === 1) {
				$this->ApprovedProfileImageID = $image->ID;
				$this->UnapprovedProfileImageID = 0;
			} else if ($processCode === 2) {
				$this->UnapprovedProfileImageID = $image->ID;
			}
			$this->PendingProfileImageID = 0; //reset the pending profile image relation
			$success = "ProfileImage Processed";
		}
		$written = $this->write();
		$response = array("ProcessCode" => $processCode, "Success" => $success, "Written" => $written);
		return $response;
	}
	/*public function canView($member = null) {
	parent::canView();

	if ($this->ApprovalStatus == "Active") {
	return true;
	} else {
	return Permission::check('ADMIN');
	}

	}*/
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
		$fields->addFieldToTab('Root.Main', new TextField("FirstName", "First name of tutor"));
		$fields->addFieldToTab('Root.Main', new TextField("Surname", "Last name of tutor"));
		$fields->addFieldToTab('Root.Main', new TextField("PhoneNo", "Phone Number"));
		$fields->addFieldToTab('Root.Main', new TextField("Email"));

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

}
class TutorPage_Controller extends Page_Controller {

	private static $allowed_actions = array('ContactForm', 'editProfile', 'EditProfileForm', 'repositionCoverImage');

	private static $url_handlers = array(
		'edit//$action' => 'editProfile',
	);

	public function ContactForm() {

		$fields = new FieldList(
			new TextField('Email', '<span>*</span> Your Email Address'),
			new TextField('Name', '<span>*</span> Your First and Last Name'),
			new TextAreaField('Body', '<span>*</span> Your Message to ' . $this->Member()->FirstName)
		);

		$actions = new FieldList(
			new FormAction('doContactTutor', 'Send a Message to ' . $this->FirstName)
		);

		$validator = new RequiredFields('Email');
		$form = new FoundationForm($this, 'ContactForm', $fields, $actions, $validator);
		$form->enableSpamProtection();
		return $form;

	}

	public function doContactTutor($data, $form) {
		$adminEmail = Config::inst()->get('Email', 'admin_email');

		$from = $data["Email"];
		$name = $data["Name"];
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

		if (SS_ENVIRONMENT_TYPE == "live") {
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
			//$tagField->setTagTopicClass("SiteTree");

			/* handles uploads for pending photos */

			/* UNCOMMENT TO ENABLE COVER/PROFILE IMAGE EDITING */
			//$pendingCoverImage = new UploadField("PendingCoverImage", "Upload a new Cover Photo. (The wider, the better!)");
			//$pendingCoverImage->setCanPreviewFolder(false)->setOverwriteWarning(false)->setAllowedFileCategories('image')->setAutoUpload(true)->setFolderName("Uploads/Tutors/" . $Member->ID);

			//$pendingProfileImage = new UploadField("PendingProfileImage", "Choose your Profile Photo");
			//$pendingProfileImage->setCanPreviewFolder(false)->setOverwriteWarning(false)->setAllowedFileCategories('image')->setAutoUpload(true)->setFolderName("Uploads/Tutors/" . $Member->ID);
			/* UNCOMMENT TO ENABLE COVER/PROFILE IMAGE EDITING */

			$tagsLabel = '<p>Read the <a href="for-tutors/">For Tutors page</a> to learn more about tags and promoting yourself on Tutor Iowa!</p>';
			$changePassLabel = '<p><a href="Security/ChangePassword" class="button small radius">Reset your password</a></p>';
			$HTMLEditorButtons = array(
				'btnGrp-design',
				'btnGrp-lists',
			);

			$bioField = new TrumbowygHTMLEditorField('Content', 'Biography');
			$bioField->setButtons($HTMLEditorButtons);

			$availabilityField = new TrumbowygHTMLEditorField('Hours', 'Availability');
			$availabilityField->setButtons($HTMLEditorButtons);

			$fields = new FieldList(
				/* UNCOMMENT TO ENABLE COVER/PROFILE IMAGE EDITING */
				//$pendingCoverImage,
				//$pendingProfileImage,
				/* UNCOMMENT TO ENABLE COVER/PROFILE IMAGE EDITING */

				new TextField('FirstName', '<span>*</span> First Name'),
				new TextField('Surname', '<span>*</span> Last Name'),
				new EmailField('Email', '<span>*</span> Email Address'),
				new LiteralField('ChangePassword', $changePassLabel),
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

			if ($this->UnapprovedCoverImage()->exists()) {
				$message = "Sorry, your last uploaded cover image was not approved." . $this->UnapprovedCoverImage()->UnapprovedMessage;
				$unapprovedCoverLabel = new LabelField("UnapprovedCoverImageMessage", $message);
				$fields->insertAfter($unapprovedCoverLabel, "PendingCoverImage");
			}
			if ($this->UnapprovedProfileImage()->exists()) {
				$message = "Sorry, your last uploaded profile image was not approved. " . $this->UnapprovedProfileImage()->UnapprovedMessage . " Upload a new image";
				$unapprovedProfileLabel = new LabelField("UnapprovedCoverImageMessage", $message);
				$fields->insertAfter($unapprovedProfileLabel, "PendingProfileImage");
			}

			$saveAction = new FormAction('SaveProfile', 'Save');
			$saveAction->addExtraClass('radius');

			$actions = new FieldList($saveAction);
			$validator = new RequiredFields('FirstName', 'Surname', 'Email');

			$Form = new FoundationForm($this, 'EditProfileForm', $fields, $actions, $validator);
			//$Form->setTemplate('EditTutorFormTemplate');

			//Information must be loaded from both tutor and member because member stores a member/tutor's password
			$Form->loadDataFrom($Member->data());
			$Form->loadDataFrom($this->data());

			///$Check if user is published yet
			/*
			if ($this instanceof TutorPage) {
			//Tutor is published
			$Form->loadDataFrom($Tutor->data());
			} else {
			//Not published (disabled and unapproved users).  The enable function is at at the bottom and handles sending the emails

			return 'You must be confirmed as a user by our administrator to edit your profile.  If you have disabled your account, please click <a href="' . Director::baseURL() . $this->URLSegment . '?enable=1' . '">here</a> to have your account re-enabled.';
			}
			 */

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
		/* Meant to check and ensure email is duplicated with another in the DB. Can be refactored :D
		$email = Convert::raw2sql($data['Email']);
		if ($member = DataObject::get_one("Member", "Email = '" . Convert::raw2sql($data['Email']) . "' AND ID != " . $CurrentMember->ID)) {
		$form->addErrorMessage("Email", 'Sorry, an account with that Email address already exists', "bad");
		Session::set("FormInfo.Form_EditProfileForm.data", $data);
		return $this->redirect($this->Link());
		}
		 */
		$Member = Member::CurrentUser();
		$MemberID = $Member->ID;

		$Tutor = TutorPage::get()->filter(array('MemberID' => $MemberID))->first();

		/*Preserve this code, for it works the magic of SilverStripe 3 publishing
		Versioned::reading_stage('stage');
		$Tutor->writeToStage('Stage');
		$Tutor->publish("Stage", "Live");
		Versioned::reading_stage('Live');
		$Tutor->write();
		 */

		// Save into the member dataobject.
		$memberFieldList = array(
			"FirstName",
			"Surname",
			"Email",
		);
		$formData = $form->getData();
		//print_r($formData);

		$pci = isset($formData["PendingCoverImage"]["Files"]) ? array_shift($formData["PendingCoverImage"]["Files"]) : NULL;
		$ppi = isset($formData["PendingProfileImage"]["Files"]) ? array_shift($formData["PendingProfileImage"]["Files"]) : NULL;
		$pendingImages = array($this->PendingCoverImage()->ID, $this->PendingProfileImage()->ID);

		if (!empty($pendingImages)) {
			if ($pendingImages[0] > 0 && empty($pci)) {
				DataObject::delete_by_id("PendingImage", $pendingImages[0]);
			}
			if ($pendingImages[1] > 0 && empty($ppi)) {
				DataObject::delete_by_id("PendingImage", $pendingImages[1]);
			}
		}
		$form->saveInto($Tutor);
		$form->saveInto($Member, $memberFieldList);

		$Tutor->writeToStage('Stage');
		$Tutor->publish("Stage", "Live");
		Versioned::reading_stage('Live');
		$Tutor->write();
		
		$Member->write();

		$formDisabled = $formData['Disable'];
		if ($formDisabled) {
			//If user checked disable page box
			if ($DisablePage = DisablePage::get()->First()) //$DisablePage = DataObject::get_one('DisablePage'))
			{
				$parameter = '?ID=' . $Tutor->ID;
				return $this->redirect($DisablePage->Link($parameter));
			}
		}

		return $this->redirect($this->Link('edit?saved=1'));
	}
	/**
	 * Server Side Action to handle saving the position of the cover image.
	 * Recieves Top variable from TutorPage Repo
	 * @param SS_HTTPRequest $r (HTTP Post)
	 * @return JSON String
	 */
	public function repositionCoverImage(SS_HTTPRequest $r) {
		$data = $r->postVars();
		$top = (float) $data['Top'];
		$coverImage = $this->ApprovedCoverImage();
		$coverImage->setField('Top', $top);
		$coverImage->write();
		return Convert::raw2json($data);
	}

	/**
	 * Server Side Action that handles removeing Cover Image.
	 * Note: This only unsets the relation, doesn't actually destroy CoverImage record or file.
	 * If we want to change this, simply uncomment one of the #'d lines below
	 * @param SS_HTTPRequest $r (HTTP Post)
	 * @return JSON String
	 */
	public function removeCoverImage(SS_HTTPRequest $r) {
		$data = $r->postVars();
		$DO = $this->dataRecord; // retrieves TutorPage Object associated with controller...
		#CoverImage::get()->byID($DO->ApprovedCoverImageID)->deleteDatabaseOnly(); //uncomment this line to delete ONLY CoverImage record
		#CoverImage::get()->byID($DO->ApprovedCoverImageID)->delete(); // uncomment this line to delete CoverImage Record AND file.
		$DO->ApprovedCoverImageID = 0; // unset relation.
		$confirm = $DO->write();
		$data['confirm'] = $confirm; // return confirmation along with initial data through the JSON response
		return Convert::raw2json($data);
	}

	/**
	 * Server Side Action that handles removeProfileImage.
	 * Note: This only unsets the relation, doesn't actually destroy ProfileImage record or file.
	 * If we want to change this, simply uncomment one of the #'d lines below
	 * @param SS_HTTPRequest $r (HTTP Post)
	 * @return JSON String
	 */
	public function removeProfileImage(SS_HTTPRequest $r) {
		$data = $r->postVars();
		$DO = $this->dataRecord; // retrieves TutorPage Object associated with controller...
		#ProfileImage::get()->byID($DO->ApprovedProfileImageID)->delete(); // uncomment this line to delete CoverImage Record AND file.
		#ProfileImage::get()->byID($DO->ApprovedProfileImageID)->deleteDatabaseOnly(); //uncomment this line to delete ONLY CoverImage record
		$DO->ApprovedProfileImageID = 0; // unset relation
		$confirm = $DO->write();
		$data['confirm'] = $confirm; // return confirmation along with initial data through the JSON response
		return Convert::raw2json($data);
	}
}
