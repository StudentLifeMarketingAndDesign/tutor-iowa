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

	public function PopularSearches() {
		return SearchTerm::get()->sort('SearchCount DESC');
	}

	/*public function featuredTutorPages() {
	if ($this->TutorPages()->First()) {

	$TutorPages = new ArrayList($this->TutorPages()->toArray());
	$additionalTutorPages = new ArrayList(TutorPage::get()->sort("RAND()")->toArray());
	$TutorPages->merge($additionalTutorPages);

	return $TutorPages;

	} else {
	return TutorPage::get()->sort("RAND()");
	}

	}*/
	public function NewsletterSignedUp() {

		$signedUp = $this->request->getVar('signup');
		// print_r($this->request);

		// print_r(Director::urlParams());
		if (intval($signedUp) == 1) {

			return true;

		} else {
			return false;

		}

	}

	public function rss() {
		$rss = new RSSFeed($this->Children(), $this->Link(), "Tutor news");
		$rss->outputToBrowser();
	}

	public function init() {
		RSSFeed::linkToFeed($this->Link() . "rss");
		parent::init();
	}

}
