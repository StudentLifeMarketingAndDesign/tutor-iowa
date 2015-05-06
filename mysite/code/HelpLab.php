<?php
class HelpLab extends Page {
	private static $db = array(
		'Name' => 'Text',
		'Description' => 'HTMLText',
		'Location' => 'Text',
		"Hours" => 'Text',
		'Enabled' => 'Boolean',
		'EndDate' => 'Date',
		'ExtrnlLink' => 'Text',
		'ExternalScheduleLink' => 'Text',
		'ContactName' => 'Text',
		'ContactEmail' => 'Text',
		'PhoneNo' => 'Text',

	);

	private static $has_one = array(
		'AcademicHelp' => 'AcademicHelp',
		'HomePage' => 'HomePage',
	);

	private static $many_many = array(
		'Members' => 'Member',
	);

	private static $defaults = array('ProvideComments' => '1');

	public function getCMSFields() {

		$fields = parent::getCMSFields();
		$fields->removeFieldFromTab('Root.Main', "Content");

		$fields->addFieldToTab('Root.Main', new TextField("Name", "Help Lab name (can be the same as Page name)"));

		$fields->addFieldToTab('Root.Main', new TextField("Hours"));
		$fields->addFieldToTab('Root.Main', new TextAreaField("Location", 'Address(<br />Street <br />City, Zip Code<br />)'));
		$fields->removeFieldFromTab('Root.Metadata', "Keywords");
		$fields->addFieldToTab('Root.Main', new TextAreaField("MetaKeywords", "Tags"));
		$fields->addFieldToTab('Root.Main', new TextField("ExtrnlLink", "External link to help lab homepage"));
		$fields->addFieldToTab('Root.Main', new TextField("ContactName", "Contact's Name"));
		$fields->addFieldToTab('Root.Main', new TextField("ContactEmail", "Contact's Email Address"));
		$fields->addFieldToTab('Root.Main', new TextField("ExternalScheduleLink", "External Schedule Link"));

		$fields->addFieldToTab('Root.Main', new TextField("PhoneNo", "Phone Number"));
		$fields->addFieldToTab('Root.Main', new HTMLEditorField("Description", "Description"));

		$memberArray = DataObject::get('Member', "ID in (select MemberID from Group_Members where GroupID = (select ID from `Group` where title='Content Authors'))");

		$config = GridFieldConfig_RelationEditor::create();
		$config->getComponentByType('GridFieldDataColumns')->setDisplayFields(array(
			'Email' => 'Email',
			//'Artist.Title' => 'Artist'
		));

		$config->getComponentByType('GridFieldAddExistingAutocompleter')->setSearchFields(array('FirstName', 'Surname'))->setResultsFormat('$FirstName $Surname');

		$MemberTableField = new GridField(
			'Members',
			'Member',
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
		$helplabs = $this->getHelpLabs();
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

class HelpLab_Controller extends Page_Controller {

	private static $allowed_actions = array("Edit", "HelpLabSaveProfile", "canUserEditHelpLab", "helpLabSaved", "HelpEditProfileForm");

	public function init() {
		parent::init();
		//require google maps API key on helplab pages because they include google maps.
		//Note the current key is for athaax@gmaildotcom, for dev.
		Requirements::javascript("http://maps.googleapis.com/maps/api/js?libraries=geometry&sensor=false&key=AIzaSyDUkOHwlzBjOa5Vb-fKIOYjv5LP4Hrai5E");
	}

	public function Edit() {
		/*

		$fields = new FieldSet (
		new TextareaField('Description'),
		new Textareafield('MetaKeywords', 'Tags'),
		new TextField('Location'),
		new TextField('Link'),
		new TextField('ContactName', 'Contact Person\'s Name'),
		new TextField('ContactEmail', 'Contact Person\'s Email'),

		new TextField('PhoneNo', 'Phone Number'),
		new TextField('ExternalScheduleLink', 'Optional link to the lab\'s schedule on another site'),

		new TextField('Hours', 'Availability')
		);





		$actions = new FieldSet(
		new FormAction('HelpLabSaveProfile', 'Save Page')
		);





		$form = new Form($this, 'Edit', $fields, $actions);


		$HelpLabID = $this->ID;

		//return "HelpLab_Live.ID = $HelpLabID";

		//$DisplayedHelpLab = DataObject::get_one("HelpLab", "HelpLab_Live.ID = $HelpLabID");

		//$form->loadDataFrom($this->data());


		 */

		//$data = $this->data();

		return $this->renderWith(array('HelpLab_Edit', 'Page'));

	}

	public function HelpEditProfileForm() {
		$canUserEdit = $this->canUserEditHelpLab();
		if ($canUserEdit) {
			$fields = new FieldList(
				new HTMLEditorField('Description'),
				new Textareafield('MetaKeywords', 'Tags'),
				new TextField('Location'),
				//new TextField('Link'),
				new TextField('ContactName', 'Contact Person\'s Name'),
				new TextField('ContactEmail', 'Contact Person\'s Email'),
				//new UploadField('BackgroundImage', 'Background Image'),
				new TextField('PhoneNo', 'Phone Number'),
				new TextField('ExternalScheduleLink', 'Optional link to the lab\'s schedule on another site'),

				new TextField('Hours', 'Availability')
			);

			$actions = new FieldList(
				new FormAction('HelpLabSaveProfile', 'Save Page')
			);

			$form = new Form($this, 'HelpEditProfileForm', $fields, $actions);

			$HelpLabID = $this->ID;

			//$DisplayedHelpLab = DataObject::get_one("HelpLab", "HelpLab_Live.ID = $HelpLabID");
			$DisplayedHelpLab = HelpLab::get()->filter(array('ID' => $HelpLabID))->first();

			$form->loadDataFrom($DisplayedHelpLab->data());

			return $form;
		} else {
			return Security::PermissionFailure($this->controller, 'You do not have permission to edit this profile.');
		}
	}

	function HelpLabSaveProfile($data, $form) {

		$canUserEdit = $this->canUserEditHelpLab();

		if ($canUserEdit) {

			$labID = $this->ID;

			//$MemberLab = DataObject::get_one('HelpLab', "HelpLab_Live.ID=$labID");
			$MemberLab = HelpLab::get()->filter(array('ID' => $labID))->First();

			$form->saveInto($MemberLab);
			$MemberLab->write();
			$MemberLab->writeToStage("Stage");
			$MemberLab->publish("Stage", "Live");
			return $this->redirect($this->Link('/Edit/?saved=1'));

		} else {

			return Security::PermissionFailure($this->controller, 'You do not have permission to edit this profile.');

		}

	}

	function helpLabSaved() {
		/*
		$params = Director::getURLParams();
		if ($params['saved']){
		return true;
		}
		return false;
		 */
		return $this->request->getVar('saved');
	}
}
