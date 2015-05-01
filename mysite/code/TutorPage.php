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

	public function RelatedResources() {

		$searchTerm = $this->Tags . ' ' . $this->Content;

		$results = $this->search($searchTerm);

		//Remove this tutor from results
		$tutors = $results->getField('Tutors');
		$thisTutorInResults = $tutors->find('ID', $this->ID);
		$results->getField('Tutors')->remove($thisTutorInResults);

		return $results;
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
		$adminEmail = Config::inst()->get('Email', 'admin_email');

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
		$email->setFrom($adminEmail);
		$email->setSubject($subject);
		$email->setBody($body);

		if (SS_ENVIRONMENT_TYPE == "live") {
			$email->send();
		}

	}

}

class TutorPage_Controller extends Page_Controller {

	private static $allowed_actions = array('ContactForm');

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

}