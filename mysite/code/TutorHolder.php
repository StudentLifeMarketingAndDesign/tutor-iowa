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
