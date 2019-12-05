<?php
use SilverStripe\Forms\Form;
use SilverStripe\Security\Member;
use SilverStripe\Control\Email\Email;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Core\Config\Config;
use SilverStripe\Security\Security;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Versioned\Versioned;

class TutorPage extends Page {

	//Add extra database fields
	private static $db = array(
		'Bio' => 'HTMLText',
		'PhoneNo' => 'Varchar(255)',
		'Hours' => 'HTMLText',
		'Disabled' => 'Boolean',
		'Approved' => 'Boolean',
		'FirstName' => 'Text',
		'Surname' => 'Varchar(255)',
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
		// 'ApprovalStatus' => "Enum('Provisional, Active, Inactive, Ineligible')",
		'WhatToExpect' => 'HTMLText',
		'HowToPrepare' => 'HTMLText',
	);

	private static $has_one = array(
		'Member' => Member::class,
		'AcademicHelp' => 'AcademicHelp',
		'HomePage' => 'HomePage'
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

	public function getTitle(){
		$member = $this->Member();

		//Only show surnames when a user is logged in.
		if( Member::currentUserID() ) {
		    return $member->FirstName.' '.$member->Surname;
		} else {
		   return $member->FirstName;
		}
	}

	public function getMenuTitle(){
		return $this->getTitle();
	}

	public function getCMSFields() {

		$fields = parent::getCMSFields();

		$members = Member::get();
		$membersDropdownSource = $members->Map('ID', Email::class);

		$tagField = new TextareaField("Tags", "Tags");
		//$tagField->setTagTopicClass("SiteTree");

		$fields->renameField(Image::class, "Photo");
		$fields->removeFieldFromTab('Root.Metadata', "Keywords");
		$fields->removeFieldFromTab('Root.Main', "Content");
		$fields->addFieldToTab('Root.Main', new ReadonlyField("FirstName", "First name of tutor"));
		$fields->addFieldToTab('Root.Main', new ReadonlyField("Surname", "Last name of tutor"));
		$fields->addFieldToTab('Root.Main', new TextField("PhoneNo", "Phone Number"));
		$fields->addFieldToTab('Root.Main', new ReadonlyField(Email::class));

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

	public function isCertified(){
		$tags = $this->Tags;
		if (strpos($tags, 'Certified Tutor') === false) {
		    return false;
		}else{
			return true;
		}
	}

}
