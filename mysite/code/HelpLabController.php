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

class HelpLabController extends PageController {

	private static $allowed_actions = array("Edit", "HelpLabSaveProfile", "canUserEditHelpLab", "helpLabSaved", "HelpEditProfileForm", "EditorToolbar");

	public function init() {
		parent::init();
		//require google maps API key on helplab pages because they include google maps.
		//Note the current key is for athaax@gmaildotcom, for dev.
		Requirements::javascript("http://maps.googleapis.com/maps/api/js?libraries=geometry&sensor=false&key=AIzaSyDUkOHwlzBjOa5Vb-fKIOYjv5LP4Hrai5E");
	}

	public function Edit() {
		return $this->renderWith(array('HelpLab_Edit', 'Page'));
	}

	public function HelpEditProfileForm() {
		$canUserEdit = $this->canUserEditHelpLab();
		if ($canUserEdit) {
			$tagField = new TutorTagField('Tags', 'Tags');
			$tagField->setTagTopicClass(SiteTree::class);

			$HTMLEditorButtons = array(
				'btnGrp-design',
				'btnGrp-lists',
			);

			$bioField = new TrumbowygHTMLEditorField('Description', 'Description');
			$bioField->setButtons($HTMLEditorButtons);
			
			$availabilityField = new TrumbowygHTMLEditorField('Hours', 'Availability');
			$availabilityField->setButtons($HTMLEditorButtons);

			$fields = new FieldList(
				$bioField,
				$tagField,
				new TextField('Location'),
				//new TextField('Link'),
				new TextField('ContactName', 'Contact Person\'s Name'),
				new TextField('ContactEmail', 'Contact Person\'s Email'),
				//new UploadField('BackgroundImage', 'Background Image'),
				new TextField('PhoneNo', 'Phone Number'),
				new TextField('ExternalScheduleLink', 'Optional link to the lab\'s schedule on another site'),
				new TextareaField('WhatToExpect', 'What to Expect'),
				new TextareaField('HowToPrepare', 'How to Prepare'),

				$availabilityField
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
