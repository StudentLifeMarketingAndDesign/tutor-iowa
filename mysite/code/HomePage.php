<?php
/**
 * Defines the HomePage page type
 */

class HomePage extends Page {
	private static $db = array(
		'FrontPageBlurb' => 'Text',

	);

	private static $has_one = array(

		"MainImage" => "Image",

	);

	private static $has_many = array(

		'HelpLabs' => 'HelpLab',
		'TutorPages' => 'TutorPage',

	);

	static $defaults = array('ProvideComments' => '1',
	);

	public function getCMSFields() {

		$fields = parent::getCMSFields();

		$config = GridFieldConfig_RelationEditor::create();
		$config->getComponentByType('GridFieldDataColumns')->setDisplayFields(array(
			'EmailAddress' => 'EmailAddress',
		));
		$NewsletterPerson = new GridField(
			'NewsletterPersons',
			'NewsletterPerson',
			NewsletterPerson::get(),
			$config
		);

		$featuredConfig1 = GridFieldConfig_RelationEditor::create();
		$featuredConfig1->getComponentByType('GridFieldDataColumns')->setDisplayFields(array(
			'Title' => 'Title',
		));

		$featuredHelpLabs = new GridField(
			'HelpLabs',
			'HelpLab',
			$this->HelpLabs(),
			$featuredConfig1
		);

		/*** We are not featuring tutors.
		$featuredConfig2 = GridFieldConfig_RelationEditor::create();
		$featuredConfig2->getComponentByType('GridFieldDataColumns')->setDisplayFields(array(
		'Title' => 'Title',
		));

		$featuredTutorPages = new GridField(
		'TutorPages',
		'TutorPage',
		$this->TutorPages(),
		$featuredConfig2
		);*/

		$fields->addFieldToTab("Root.EmailSignups", $NewsletterPerson);
		$fields->addFieldToTab("Root.FeaturedHelpLabs", $featuredHelpLabs);
		//$fields->addFieldToTab("Root.FeaturedTutorPages", $featuredTutorPages);

		$fields->addFieldToTab("Root.Main", new TextField("FrontPageBlurb", "Front Page Blurb"));
		$fields->addFieldToTab("Root.Main", new UploadField("MainImage", "Main Image"));

		return $fields;

	}
	public function RandomTagline() {

		$taglines = array(
			'You got this.',
			"Don't give up.",
			'Learn by tutoring.',
			"College classes are hard, but finding help isn't.",
			"See a tutor, see results.",
			"Get better grades.",
			'Excel.',
			'Peer-to-peer and small group tutoring.',
		);

		$random = array_rand($taglines, 1);
		return $taglines[$random];
	}

}

class HomePage_Controller extends Page_Controller {

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

	public function NewsletterSignedUp() {

		$signedUp = $this->request->getVar('signup');
		if (intval($signedUp) == 1) {

			return true;

		} else {
			return false;

		}

	}

	public function init() {
		RSSFeed::linkToFeed($this->Link() . "rss");
		parent::init();
	}

}
