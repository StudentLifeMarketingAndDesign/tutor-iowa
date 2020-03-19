<?php

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Lumberjack\Forms\GridFieldConfig_Lumberjack;
use Colymba\BulkManager\BulkManager;
use SilverStripe\Forms\GridField\GridFieldPaginator;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\Tab;

class TutorHolder extends Page {
	private static $db = array(
	);
	private static $has_one = array(
	);

	private static $allowed_children = array('TutorPage');

	private static $icon_class = 'font-icon-torsos-all';

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
		))->sort('Created DESC');

		$tutorFieldConfig = GridFieldConfig_Lumberjack::create();
		$tutorFieldConfig->addComponent(new BulkManager());
		$tutorFieldConfig->getComponentByType(GridFieldPaginator::class)->setItemsPerPage(50);
		$tutorFieldConfig->getComponentByType(BulkManager::class)->removeBulkAction('Colymba\BulkManager\BulkAction\EditHandler');
		$tutorFieldConfig->getComponentByType(BulkManager::class)->removeBulkAction('Colymba\BulkManager\BulkAction\DeleteHandler');
		$tutorFieldConfig->getComponentByType(BulkManager::class)->removeBulkAction('Colymba\BulkManager\BulkAction\UnlinkHandler');
		$tutorFieldConfig->getComponentByType(BulkManager::class)->addBulkAction('Colymba\BulkManager\BulkAction\PublishHandler');
		$tutorFieldConfig->getComponentByType(BulkManager::class)->addBulkAction('Colymba\BulkManager\BulkAction\UnpublishHandler');
		$tutorFieldConfig->getComponentByType(BulkManager::class)->addBulkAction( 'GridFieldBulkActionMarkIneligibleHandler');
		

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
