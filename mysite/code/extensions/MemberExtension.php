<?php
class MemberExtension extends DataExtension {

	private static $db = array(
		'PhoneNo' => 'Varchar',
		'Hours' => 'HTMLText',
		'UniversityID' => 'Text',
		'Major' => 'Text',
		'GPA' => 'Text',
		'AcademicStatus' => 'Text',
		'EligibleToTutor' => 'Boolean',
		'ApprovalStatus' => "Enum('Inactive, Provisional, Active')",
		'Disabled' => 'Boolean',
		'Approved' => 'Boolean',
		'FirstName' => 'Text',
		'Surname' => 'Text',
		'StartDate' => 'Date',
		'EndDate' => 'Date',
		'Notes' => 'Text',
		'HourlyRate' => 'Text',
		'MeetingPreference' => 'Text',
		'Status' => 'Text',
		'Bio' => 'HTMLText',
		'PublishFlag' => 'Boolean',
		'WhatToExpect' => 'HTMLText',
		'HowToPrepare' => 'HTMLText',
		'URLSegment' => 'Varchar(255)'
		
	);

	private static $defaults = array(
		'ProvideComments' => '1',
		'UniversityID' => null,
		'GPA' => null,
		'EligibleToTutor' => '1',
		'ApprovalStatus' => 'Inactive'
	);

    private static $belongs_many_many = array(
        "HelpLabs" => "HelpLab"
    );
    
    private static $has_many = array(
		"Messages" => "Message",
	);

	public function getCMSFields() {

		$fields = parent::getCMSFields();


		$fields->addFieldToTab('Root.TutorInformation', new ReadonlyField("FirstName", "First name of tutor"));
		$fields->addFieldToTab('Root.TutorInformation', new ReadonlyField("Surname", "Last name of tutor"));
		$fields->addFieldToTab('Root.TutorInformation', new TextField("PhoneNo", "Phone Number"));
		$fields->addFieldToTab('Root.TutorInformation', new ReadonlyField("Email"));

		$approvalStatusField = DropdownField::create('ApprovalStatus', 'ApprovalStatus', singleton('TutorPage')->dbObject('ApprovalStatus')->enumValues());

		$fields->addFieldToTab('Root.TutorInformation', $approvalStatusField);
		$fields->addFieldToTab('Root.TutorInformation', new CheckboxField('EligibleToTutor', 'Is this tutor eligible?', true));
		$fields->addFieldToTab('Root.TutorInformation', new CheckboxField('Disabled', 'Is this tutor page disabled?', true));
		$fields->addFieldToTab('Root.TutorInformation', $tagField);
		$fields->addFieldToTab('Root.TutorInformation', new TextAreaField("Content", "Biography"));
		$fields->addFieldToTab('Root.TutorInformation', new TextAreaField("Hours", "Availability"));

		$fields->addFieldToTab('Root.TutorInformation', new TextAreaField("Notes", "Approved Courses And Notes"));
		$fields->addFieldToTab('Root.TutorInformation', new DateField("StartDate", "Date you plan to start tutoring"));
		$fields->addFieldToTab('Root.TutorInformation', new DateField("EndDate", "Date you expect to stop tutoring"));
		$fields->addFieldToTab('Root.TutorInformation', new TextField("HourlyRate", "Hourly rate"));
		$fields->addFieldToTab('Root.TutorInformation', new TextField("MeetingPreference", "Meeting preference (on-campus or off-campus)"));
		$fields->addFieldToTab('Root.TutorInformation', new TextField("UniversityID", "University ID"));
		$fields->addFieldToTab('Root.TutorInformation', new TextField("GPA", "GPA"));
		$fields->addFieldToTab('Root.TutorInformation', new TextField("Major"));
		$fields->addFieldToTab('Root.TutorInformation', new TextField("AcademicStatus", "Academic Status"));
		$fields->addFieldToTab('Root.TutorInformation', new HTMLEditorField("WhatToExpect", "What to Expect"));
		$fields->addFieldToTab('Root.TutorInformation', new HTMLEditorField("HowToPrepare", "How to Prepare"));

		// $gridFieldConfigFeedbackItems = GridFieldConfig_RecordEditor::create();
		// $gridfield = new GridField("FeedbackItem", "Feedback Items", $this->FeedbackItems(), $gridFieldConfigFeedbackItems);
		// $fields->addFieldToTab('Root.FeedbackItems', $gridfield);

		return $fields;

	}
	
	/**
	 * {@inheritdoc}
	 */
	public function onBeforeWrite() {
		$this->owner->generateURLSegment();
	}

	/**
	 * Generates a unique URLSegment from the title.
	 *
	 * @param int $increment
	 *
	 * @return string
	 */
	public function generateURLSegment($increment = null) {
		$filter = new URLSegmentFilter();

		$this->owner->URLSegment = $filter->filter($this->owner->FirstName).'-'.$filter->filter($this->owner->Surname);


		if (is_int($increment)) {
			$this->owner->URLSegment .= '-'.$increment;
		}

		$duplicate = DataList::create($this->owner->ClassName)->filter(array(
				'URLSegment' => $this->owner->URLSegment
			));

		if ($this->owner->ID) {
			$duplicate = $duplicate->exclude('ID', $this->owner->ID);
		}

		if ($duplicate->count() > 0) {
			if (is_int($increment)) {
				$increment += 1;
			} else {
				$increment = 0;
			}

			$this->owner->generateURLSegment((int) $increment);
		}
		print_r($this->owner->URLSegment);

		return $this->owner->URLSegment;
	}

	public function Link() {
		return 'tutor/view/'.$this->owner->URLSegment;
		print_r($this->owner->URLSegment);
	}

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

