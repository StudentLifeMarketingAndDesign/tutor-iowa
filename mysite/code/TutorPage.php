<?php
class TutorPage extends Page {

	//Add extra database fields
	public static $db = array(
		'Bio' => 'Text',
		'PhoneNo' => 'Varchar',
		'Hours' => 'Text',
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
		'PublishFlag' => 'Boolean',

	);

	private static $has_one = array(
		'Member' => 'Member',
		'AcademicHelp' => 'AcademicHelp',
		'HomePage' => 'HomePage',
	);

	private static $has_many = array(
		'FeedbackItems' => 'FeedbackItem',
	);

	private static $defaults = array('ProvideComments' => '1',
		'UniversityID' => null,
		'GPA' => null,
	);

	private static $default_sort = 'Surname ASC';

	private static $summary_fields = array(
		'FirstName' => 'First Name',
		'Surname' => 'Last Name',
		'Major' => 'Major',
		'Email' => 'Email',
		'Status' => 'Status',
	);

	//Add form fields to CMS
	public function getCMSFields() {

		$fields = parent::getCMSFields();

		$members = Member::get();
		$membersDropdownSource = $members->Map('ID', 'Email');

		$tagField = new TagField("Tags", "Tags");
		$tagField->setTagTopicClass("SiteTree");

		$fields->renameField("Image", "Photo");
		$fields->removeFieldFromTab('Root.Metadata', "Keywords");
		$fields->removeFieldFromTab('Root.Main', "Content");
		$fields->addFieldToTab('Root.Main', new TextField("FirstName", "First name of tutor"));
		$fields->addFieldToTab('Root.Main', new TextField("Surname", "Last name of tutor"));
		$fields->addFieldToTab('Root.Main', new TextField("PhoneNo", "Phone Number"));
		$fields->addFieldToTab('Root.Main', new TextField("Email"));
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
		$fields->addFieldToTab('Root.Advanced', new DropdownField("MemberID", "Associated User", $membersDropdownSource));

		$gridFieldConfigFeedbackItems = GridFieldConfig_RecordEditor::create();
		$gridfield = new GridField("FeedbackItem", "Feedback Items", $this->FeedbackItems(), $gridFieldConfigFeedbackItems);
		$fields->addFieldToTab('Root.FeedbackItems', $gridfield);

		return $fields;

	}

	public function SplitKeywords() {
		$keywords = $this->Tags;

		if (!empty($keywords)) {
			$splitKeywords = explode(',', $keywords);
		}

		if (isset($splitKeywords)) {
			$keywordsList = new ArrayList();
			foreach ($splitKeywords as $data) {
				$do = new DataObject();
				$do->Keyword = $data;
				$keywordsList->push($do);
			}
			return $keywordsList;
		}
	}

	private function getEmails() {
		return MemberManagement::get();
	}

	private function changeParent() {

		$tutorParent = TutorHolder::get()->filter(array('Title' => 'Private Tutors'))->first();

		$this->setParent($tutorParent);
		$this->write();
	}
	private function onWrite() {
		$this->Metakeywords = $this->Tags;
		parent::onWrite();
	}
	public function onBeforePublish() {
		$this->changeParent();

	}

	public function onAfterPublish() {

		$approved = $this->Approved;

		$subject = "TutorIowa approval confirmation";
		$body = "Congratulations, you have been approved as a tutor on Tutor Iowa. You now have full access to edit your profile. Please check out <a href='http://tutor.uiowa.edu/for-tutors'>For Tutors</a> to learn how to effectively utilize tags and efficiently use the website, or refer to the <a href='http://www.youtube.com/watch?v=oQyJIiGs7qU&feature=youtu.be'>Private Tutor Training video</a><br>
     	If you have any questions please email tutoriowa@uiowa.edu.<br>
     	Best,<br>
     	The Tutor Iowa Team";

		$emailHolder = EmailHolder::get()->first();
		$body = $emailHolder->RegistrationConfirm;

		$email = new Email();
		$email->setTo($this->Email);
		$email->setFrom("tutoriowa@uiowa.edu");
		$email->setSubject($subject);
		$email->setBody($body);

		if (SS_ENVIRONMENT_TYPE == "live") {
			$email->send();
		}

	}

}
class TutorPage_Controller extends Page_Controller {
	
	private static $allowed_actions = array('ContactForm', 'editProfile');
	
	private static $url_handlers = array(
       'edit' => 'editProfile'
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

		$from = $data["Email"];
		$name = $data["Name"];
		$body = $data["Body"];

		$subject = "[Tutor Iowa] " . $name . " has contacted you.";

		$email = new Email();
		$toString = $this->Email;
		$email->setTo($toString);
		$email->setSubject($subject);
		$email->setFrom(Email::getAdminEmail());
		$email->replyTo($from);
		$email->setBody($name . ' has contacted you. Read their message below. You may reply to their message directly by replying to this email. <br />' . $body);

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

		$statspage = StatsPage::get()->first();
		$temp = $statspage->TutorRequestCount;
		$temp++;

		$statspage->TutorRequestCount = $temp;

		Versioned::reading_stage('stage');
		$statspage->writeToStage('Stage');
		$statspage->publish("Stage", "Live");
		Versioned::reading_stage('Live');
		$statspage->write();

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
	
	public function editProfile($toggle) {
		$member = Member::CurrentUserID(); 
		if ($member = $this->Member()->ID) {
			$editing = Session::get("editingProfile");
			if ($editing) {
				Session::set("editingProfile", false);
			} else {
				Session::set("editingProfile", true);
			}
		}
			
		$this->redirectBack();
	}
	
	public function Editing() {
		$member = Member::CurrentUserID(); 
		if ($member = $this->Member()->ID) {
			$editingProfile = Session::get("editingProfile");
			return ($editingProfile ? true : false);
		}
	}
	
	function EditProfileForm() {
		$Member = Member::CurrentUser();

		//chromephp::log('EditProfileForm start' . Session::get('saved'));

		if ($Member) {
			//User shouldn't be able to access EditProfileForm unless they're logged in.  If they're not logged in, provide links so that they can login (or register if need be).

			$IDMember = $Member->ID;

			//$Tutor = DataObject::get_one("TutorPage", "MemberID = $IDMember");
			$Tutor = TutorPage::get()->filter(array('MemberID' => $IDMember))->first();

			$tagField = new TagField('Tags', 'Tags');
			$tagField->setTagTopicClass("SiteTree");

			$tagsLabel = '<p>Read the <a href="for-tutors/">For Tutors page</a> to learn more about tags and promoting yourself on Tutor Iowa!</p>';
			$changePassLabel = '<p><a href="Security/ChangePassword" class="button small radius">Reset your password</a></p>';
			$fields = new FieldList(
				new TextField('FirstName', '<span>*</span> First Name'),
				new TextField('Surname', '<span>*</span> Last Name'),
				new UploadField("Image", "Choose a photo of yourself"),
				new UploadField("BackgroundImage", "Choose a background image (the wider, the better.)"),
				new EmailField('Email', '<span>*</span> Email Address'),
				new LiteralField('ChangePassword', $changePassLabel),
				new TextareaField('Content', 'Biography'),
				new TextareaField('Hours', 'Availability'),
				new DateField('StartDate', 'Date you would like to start tutoring'),
				new DateField('EndDate', 'Date you expect to stop tutoring'),
				new TextField('PhoneNo', 'Phone number'),
				new TextField('MeetingPreference', 'Meeting preference (on and/or off-campus)'),
				new TextField('HourlyRate', 'Hourly rate'),
				new TextField('AcademicStatus', 'Status (undergrad, grad, faculty, staff)'),
				new TextField('GPA'),
				new UniversityIDField('UniversityID', 'University ID'),
				new TextField('Major'),
				new LiteralField('TagsHelpLabel', $tagsLabel),
				$tagField
				,

				//This does not sync with database (database field is 'Disabled')
				new CheckboxField('Disable', 'Request to disable your page (will no longer be returned as a search result on TutorIowa)')

			);
			$saveAction = new FormAction('SaveProfile', 'Save');
			$saveAction->addExtraClass('radius');
			// Create action
			$actions = new FieldList(
				$saveAction
			);

			// Create action
			$validator = new RequiredFields('FirstName', 'Surname', 'Email');

			//Create form
			$Form = new FoundationForm($this, 'EditProfileForm', $fields, $actions, $validator);

			//Get current member
			$Member = Member::CurrentUser();

			//Get tutor dataobject to populate form with tutor info (stuff like bio that's stored in tutor table)

			//Information must be loaded from both tutor and member because member stores a member/tutor's password
			$Form->loadDataFrom($Member->data());

			///$Check if user is published yet
			if ($Tutor instanceof TutorPage) {
				//Tutor is published
				$Form->loadDataFrom($Tutor->data());
			} else {
				//Not published (disabled and unapproved users).  The enable function is at at the bottom and handles sending the emails

				return 'You must be confirmed as a user by our administrator to edit your profile.  If you have disabled your account, please click <a href="' . Director::baseURL() . $this->URLSegment . '?enable=1' . '">here</a> to have your account re-enabled.';
			}

			//Return the form
			return $Form;
		} else {
			//Shouldn't happen with current design unless user tries to navigate there directly (there is no link to edit profile when you're not logged in)
			$message = "<a href='Security/login'>You must be logged in to edit your profile. </a>  If you do not have an account,  <a href='registration-page'>register here.</a>";
			return $message;
		}
	}

	//Save profile
	function SaveProfile($data, $form) {
		Session::clear('Saved');
		//chromephp::log('Enters save profile');

		//Check for a logged in member
		if ($CurrentMember = Member::CurrentUser()) {

			//chromephp::log('Current member entered');

			//Check for another member with the same email address

			$email = Convert::raw2sql($data['Email']);

			if ($member = DataObject::get_one("Member", "Email = '" . Convert::raw2sql($data['Email']) . "' AND ID != " . $CurrentMember->ID)) {

				Session::set('Saved', 0); //Display error message
				//chromephp::log('After Email error ' . Session::get('saved'));

				$form->addErrorMessage("Email", 'Sorry, an account with that Email address already exists', "bad");

				Session::set("FormInfo.Form_EditProfileForm.data", $data);

				return $this->redirect($this->Link());

			}
			//Otherwise check that user IDs match and save
			else {

				Session::set('Saved', 1); //Changes saved
				//chromephp::log('After successful validation ');
				//chromephp::log(Session::get('Saved'));
				//chromephp::log(Session::get_all());

				$IDMember = $CurrentMember->ID;

				$Tutor = TutorPage::get()->filter(array('MemberID' => $IDMember))->first();

				$form->saveInto($Tutor);

				/*Preserve this code, for it works the magic of SilverStripe 3 publishing*/
				Versioned::reading_stage('stage');
				$Tutor->writeToStage('Stage');
				$Tutor->publish("Stage", "Live");
				Versioned::reading_stage('Live');
				$Tutor->write();

				// Save into the member dataobject.
				$memberFieldList = array(
					"FirstName",
					"Surname",
					"Email",
				);
				$form->saveInto($CurrentMember, $memberFieldList);

				$CurrentMember->write();

				$formData = $form->getData();
				$formDisabled = $formData['Disable'];

				if ($formDisabled) {
					//If user checked disable page box

					if ($DisablePage = DisablePage::get()->First()) //$DisablePage = DataObject::get_one('DisablePage'))
					{

						$parameter = '?ID=' . $Tutor->ID;

						return $this->redirect($DisablePage->Link($parameter));
					}

				}
				$ID = 92;
				//$test = DataObject::get_by_id('TutorPage', $ID);
				$test = TutorPage::get()->byID($ID);
				/*
				$notSaved = Session::get('ValidationError');
				Debug::show($notSaved);

				if ($notSaved){
				$form->addErrorMessage("Name", 'An error occurred with one or more fields.', "bad");
				Session::set('ValidationError', false);
				Session::set("FormInfo.Form_EditProfileForm.data", $data);
				return Director::redirect($this->Link());
				}
				 */

				//$savedValue = Session::get('Saved');
				//print_r('Saved ' . $savedValue);
				//user_error("breakpoint", E_USER_ERROR);

				return $this->redirect($this->Link());
			}
		}
		//If not logged in then return a permission error
		else {
			return Security::PermissionFailure($this->controller, 'You must <a href="register">registered</a> and logged in to edit your profile:');
		}

	}


}
