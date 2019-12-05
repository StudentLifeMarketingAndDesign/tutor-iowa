<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Lumberjack\Forms\GridFieldConfig_Lumberjack;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\Tab;
use SilverStripe\Lumberjack\Model\Lumberjack;

/**
 * This class is responsible for filtering the SiteTree when necessary and also overlaps into
 * filtering only published posts.
 *
 * @package tutor-iowa
 *
 */
class TutorHolderLumberjack extends Lumberjack {

	/**
	 * {@inheritdoc}
	 */
	public function updateCMSFields(FieldList $fields) {
		$excluded = $this->owner->getExcludedSiteTreeClassNames();

		if (!empty($excluded)) {
			$pages = SiteTree::get()->filter(array(
				'ParentID' => $this->owner->ID,
				'ClassName' => $excluded,
			))->sort('"SiteTree"."Created" ASC');

			$gridField = new GridField(
				"ChildPages",
				$this->getLumberjackTitle(),
				$pages,
				GridFieldConfig_Lumberjack::create()
			);

			$tab = new Tab('ChildPages', $this->getLumberjackTitle(), $gridField);

			$fields->insertBefore($tab, 'Main');
		}
	}
}
