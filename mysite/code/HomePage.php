<?php

use SilverStripe\Assets\Image;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\TextField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\ORM\ArrayList;
use SilverStripe\Control\RSS\RSSFeed;

/**
 * Defines the HomePage page type
 */

class HomePage extends Page {
	private static $db = array(
		'FrontPageBlurb' => 'Text',

	);

	private static $has_one = array(

		"MainImage" => Image::class,

	);

	private static $has_many = array(

		'HelpLabs' => 'HelpLab',
		'TutorPages' => 'TutorPage',

	);

	private static $defaults = array('ProvideComments' => '1',
	);

	public function RandomBackgroundImage() {
		$randomNumber = rand(1,4);

		return $randomNumber;
	}

	public function getCMSFields() {

		$fields = parent::getCMSFields();

		$config = GridFieldConfig_RelationEditor::create();
		$config->getComponentByType(GridFieldDataColumns::class)->setDisplayFields(array(
			'EmailAddress' => 'EmailAddress',
		));
		$NewsletterPerson = new GridField(
			'NewsletterPersons',
			'NewsletterPerson',
			NewsletterPerson::get(),
			$config
		);

		$featuredConfig1 = GridFieldConfig_RelationEditor::create();
		$featuredConfig1->getComponentByType(GridFieldDataColumns::class)->setDisplayFields(array(
			'Title' => 'Title',
		));

		$featuredHelpLabs = new GridField(
			'HelpLabs',
			'HelpLab',
			$this->HelpLabs(),
			$featuredConfig1
		);

		$fields->addFieldToTab("Root.EmailSignups", $NewsletterPerson);
		$fields->addFieldToTab("Root.FeaturedHelpLabs", $featuredHelpLabs);
		//$fields->addFieldToTab("Root.FeaturedTutorPages", $featuredTutorPages);

		$fields->addFieldToTab("Root.Main", new TextField("FrontPageBlurb", "Front Page Blurb"));
		$fields->addFieldToTab("Root.Main", new UploadField("MainImage", "Main Image"));

		return $fields;

	}
	public function RandomTagline() {

		$taglines = array(
			'You\'ve got this.',
			"Don't give up.",
			'Learn by tutoring.',
			"College classes are hard, but finding help isn't.",
			"See a tutor, see results.",
			"Get better grades.",
			'Excel.',
			'Peer-to-peer tutoring.',
			'Small group tutoring.',
		);

		$random = array_rand($taglines, 1);
		return $taglines[$random];
	}
	public function featuredHelpLabs() {

		if ($this->HelpLabs()->First()) {

			$helpLabs = new ArrayList($this->HelpLabs()->toArray());
			$additionalHelpLabs = new ArrayList(HelpLab::get()->sort("RAND()")->toArray());
			$helpLabs->merge($additionalHelpLabs);

			return $helpLabs;

		} else {
			return HelpLab::get()->sort("RAND()");
		}

	}

}
