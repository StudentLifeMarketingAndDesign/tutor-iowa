<?php
class TutorHolder extends Page {
	private static $db = array(
	);
	private static $has_one = array(
	);

	private static $allowed_children = array('TutorPage');

	private static $icon = 'mysite/cms_icons/amount.png';

	/**
	 * This sets the title for our gridfield.
	 *
	 * @return string
	 */
	public function getLumberjackTitle() {
		return _t('TutorHolder.LumberjackTitle', 'Tutor Pages');
	}

	public function getCMSFields() {

		$fields = parent::getCMSFields();

		$pages = SiteTree::get()->filter(array(
			'ParentID' => $this->owner->ID,
		));

		$tutorFieldConfig = GridFieldConfig_Lumberjack::create();
		$tutorFieldConfig->addComponent(new GridFieldBulkManager());
		$tutorFieldConfig->getComponentByType('GridFieldBulkManager')->removeBulkAction('bulkEdit');
		$tutorFieldConfig->getComponentByType('GridFieldBulkManager')->removeBulkAction('delete');
		$tutorFieldConfig->getComponentByType('GridFieldBulkManager')->removeBulkAction('unLink');
		$tutorFieldConfig->getComponentByType('GridFieldBulkManager')->addBulkAction('publish', 'Publish', 'GridFieldBulkActionPublishHandler',null);
		$tutorFieldConfig->getComponentByType('GridFieldBulkManager')->addBulkAction('unPublish', 'Unpublish', 'GridFieldBulkActionUnpublishHandler',null);
		$tutorFieldConfig->getComponentByType('GridFieldBulkManager')->addBulkAction('markIneligible', 'Mark as Ineligible', 'GridFieldBulkActionMarkIneligibleHandler',null);
		

		$gridField = new GridField(
			"ChildPages",
			$this->getLumberjackTitle(),
			$pages,
			$tutorFieldConfig
		);

		$tab = new Tab('ChildPages', $this->getLumberjackTitle(), $gridField);

		$fields->insertBefore($tab, 'Main');

		return $fields;

	}

}
class TutorHolder_Controller extends Page_Controller {

}
