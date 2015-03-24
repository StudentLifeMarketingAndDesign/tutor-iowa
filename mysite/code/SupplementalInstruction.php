<?php

class SupplementalInstruction extends Page {
	private static $db = array(
		'Name' => 'Text',
		'Location' => 'Text',
		'SessionLeader' => 'Text',
		"Hours" => 'Varchar',
		'Disabled' => 'Boolean',
		'Misc' => 'Text',
		'EndDate' => 'Date',
		'Schedule' => 'HTMLText',

	);

	private static $has_one = array(
		'AcademicHelp' => 'AcademicHelp',
	);

	public function getCMSFields() {

		$fields = parent::getCMSFields();
		$fields->removeFieldFromTab('Root.Metadata', "Keywords");
		$fields->removeFieldFromTab('Root.Main', "Content");
		$fields->addFieldToTab('Root.Main', new Tagfield("Tags", "Tags"));
		$fields->addFieldToTab('Root.Main', new TextField("Name", "Supplemental Instruction name (can be the same as page name)"));
		$fields->addFieldToTab('Root.Main', new TextField("Location"));
		$fields->addFieldToTab('Root.Main', new TextField("Hours"));
		$fields->addFieldToTab('Root.Main', new TextField("SessionLeader", "Session Leader"));
		$fields->addFieldToTab('Root.Main', new TextAreaField("Content", "Describe the supplemental instruction here"));
		$fields->addFieldToTab('Root.Main', new HTMLEditorField("Schedule", "Schedule"));

		return $fields;

	}

}

class SupplementalInstruction_Controller extends Page_Controller {

}