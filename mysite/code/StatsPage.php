<?php

use SilverStripe\Assets\Image;
use SilverStripe\Forms\LiteralField;

class StatsPage extends Page {

	private static $db = array(
		'TutorRequestCount' => 'Int',
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldFromTab('Root.Main', "Content");
		$fields->removeFieldFromTab('Root.Main', Image::class);
		$fields->removeFieldFromTab('Root.Main', "BackgroundImage");
		$fields->addFieldToTab('Root.Main', $tutorCount = new LiteralField('StatsLinkField', '<a href="stats-page/" target="_blank">Tutor request counts and other statistics can now be found here &rarr;</a>'));

		return $fields;
	}
}
