<?php

use SilverStripe\Security\Member;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Control\Email\Email;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\View\Requirements;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\Form;
use SilverStripe\Security\Security;

class HelpLab extends Page {
	private static $db = array(
		'Name' => 'Text',
		'Description' => 'HTMLText',
		'Location' => 'Text',
		"Hours" => 'HTMLText',
		'Enabled' => 'Boolean',
		'EndDate' => 'Date',
		'ExtrnlLink' => 'Text',
		'ExternalScheduleLink' => 'Text',
		'ContactName' => 'Text',
		'ContactEmail' => 'Text',
		'PhoneNo' => 'Text',
		'WhatToExpect' => 'HTMLText',
		'HowToPrepare' => 'HTMLText',

	);

	private static $has_one = array(
		'AcademicHelp' => 'AcademicHelp',
		'HomePage' => 'HomePage',
	);

	private static $many_many = array(
		'Members' => Member::class,
	);

	private static $defaults = array('ProvideComments' => '1');

	public function getCMSFields() {

		$fields = parent::getCMSFields();
		$fields->removeFieldFromTab('Root.Main', "Content");

		$fields->addFieldToTab('Root.Main', new TextField("Name", "Help Lab name (can be the same as Page name)"));

		$fields->addFieldToTab('Root.Main', new TextField("Hours"));
		$fields->addFieldToTab('Root.Main', new TextAreaField("Location", 'Address(<br />Street <br />City, Zip Code<br />)'));
		$fields->removeFieldFromTab('Root.Metadata', "Keywords");

			$tagField = new TextareaField('Tags', 'Tags');


		$fields->addFieldToTab('Root.Main', $tagField);
		$fields->addFieldToTab('Root.Main', new TextField("ExtrnlLink", "External link to help lab homepage"));
		$fields->addFieldToTab('Root.Main', new TextField("ContactName", "Contact's Name"));
		$fields->addFieldToTab('Root.Main', new TextField("ContactEmail", "Contact's Email Address"));
		$fields->addFieldToTab('Root.Main', new TextField("ExternalScheduleLink", "External Schedule Link"));

		$fields->addFieldToTab('Root.Main', new TextField("PhoneNo", "Phone Number"));
		$fields->addFieldToTab('Root.Main', new HTMLEditorField("Description", "Description"));
		$fields->addFieldToTab('Root.Main', new HTMLEditorField("WhatToExpect", "What to Expect"));
		$fields->addFieldToTab('Root.Main', new HTMLEditorField("HowToPrepare", "How to Prepare"));



		$memberArray = DataObject::get(Member::class, "ID in (select MemberID from Group_Members where GroupID = (select ID from `Group` where title='Content Authors'))");

		$config = GridFieldConfig_RelationEditor::create();
		$config->getComponentByType(GridFieldDataColumns::class)->setDisplayFields(array(
			'Email' => Email::class,
			//'Artist.Title' => 'Artist'
		));

		$config->getComponentByType(GridFieldAddExistingAutocompleter::class)->setSearchFields(array('FirstName', 'Surname'))->setResultsFormat('$FirstName $Surname');

		$MemberTableField = new GridField(
			'Members',
			Member::class,
			$this->Members(),
			$config
		);
		/*$MemberTableField = new ManyManyDataObjectManager(
		$this,
		'Members',
		'Member',
		array(
		'Email' => 'Email'
		),
		'getCMSFields_forPopup'
		);*/

		$fields->addFieldToTab('Root.HelpLabEditors', $MemberTableField);

		return $fields;

	}
	public function RelatedResources() {

		$searchTerm = $this->Tags . ' ' . $this->Content;

		$results = $this->search($searchTerm);

		//Remove this tutor from results
		$labs = $results->getField('HelpLabs');
		$thisLabInResults = $labs->find('ID', $this->ID);
		$results->getField('HelpLabs')->remove($thisLabInResults);

		return $results;
	}
	public function canUserEditHelpLab() {
		$helplabs = $this->getMemberHelpLabs();
		$labID = $this->ID;
		if ($helplabs) {
			foreach ($helplabs as $lab) {
				$checkID = $lab->ID;
				if ($labID == $checkID) {
					return true;
				}
			}
		} else {
			return false;
		}
		return false;

	}
}

