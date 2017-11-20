<?php
class MemberExtension extends DataExtension {

	private static $db = array(
		'Bio' => 'HTMLText',
		'PhoneNo' => 'Varchar',
		'Hours' => 'HTMLText',
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
		'ApprovalStatus' => "Enum('Provisional, Active, Inactive, Ineligible')",
		'WhatToExpect' => 'HTMLText',
		'HowToPrepare' => 'HTMLText',
		'Status' => 'Text'
	);

	private static $has_one = array(
		'AcademicHelp' => 'AcademicHelp',
		'HomePage' => 'HomePage',
		'PendingCoverImage' => 'CoverImage',
		'ApprovedCoverImage' => 'CoverImage',
		'UnapprovedCoverImage' => 'CoverImage',
		'PendingProfileImage' => 'ProfileImage',
		'ApprovedProfileImage' => 'ProfileImage',
		'UnapprovedProfileImage' => 'ProfileImage',

	);

    private static $belongs_many_many = array(
        "HelpLabs" => "HelpLab"
    );
    
    private static $has_many = array(
		"Messages" => "Message",
		'FeedbackItems' => 'FeedbackItem'
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
	);
	private static $searchable_fields = array(
		'FirstName',
		'Surname',
		'Major',
		'Email',
		'Parent.Title',
	);

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
		$fields->addFieldToTab('Root.Main', new TextField("Status", 'Tutor Status'));
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

	//TutorPage functions migrated to member
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
	//end TutorPage functions

    public function unreadMessageCount(){
	    $member = $this->owner; 
	    
	    //return the count of Messages without a ReadDateTime.
	    return $member->Messages()->where("ReadDateTime IS NULL")->Count();    
    }
    
    public function allMessageCount() {
	   $member = $this->owner; 
	   //return the count of Messages without a ReadDateTime.
	   
	   return $member->Messages()->Count(); 
    }

}

