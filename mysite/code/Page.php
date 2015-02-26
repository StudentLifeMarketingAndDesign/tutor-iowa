<?php
class Page extends SiteTree {

	private static $db = array();

	private static $has_one = array(
		"Image" => "Image",
		"BackgroundImage" => "Image",
	);

	private static $defaults = array('ProvideComments' => '1');

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->addFieldToTab("Root.Main", new UploadField("Image", "Image"));
		$fields->addFieldToTab("Root.Main", new UploadField("BackgroundImage", "BackgroundImage"));
		return $fields;
	}
}

class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array('logout');

	public function SplitKeywords() {
		$keywords = $this->MetaKeywords;

		if ($keywords) {
			$splitKeywords = explode(',', $keywords);
		}

		if ($splitKeywords) {
			$keywordsList = new ArrayList();
			foreach ($splitKeywords as $data) {
				$do = new DataObject();
				$do->Keyword = $data;
				$keywordsList->push($do);
			}
			return $keywordsList;
		}
	}
	public function currentMemberPage() {
		$currentMember = Member::currentUser();

		if (isset($currentMember->ID)) {
			$currentMemberID = $currentMember->ID;
		} else {
			return false;
		}

		$tutorPage = TutorPage::get("TutorPage")->where("MemberID = " . $currentMemberID)->First();

		if (isset($tutorPage)) {
			return $tutorPage;
		}
	}

	public function getHelpLab() {
		if ($this->isHelpLab()) {
			$HelpLab = YourHelpLabs::get("YourHelpLabs")->First();
			return $HelpLab;
		}
	}

	public function NewsletterSignUpForm() {
		$emailLabelText = '<p>Enter your email address below to keep up-to-date with TutorIowa. We\'ll occasionally
    send you a newsletter with tips on finding help this academic year!</p>';
		$fields = new FieldList(new LiteralField('EmailLabel', $emailLabelText), new EmailField('EmailAddress', 'Your Email Address'));

		$actions = new FieldList(new FormAction('doNewsletterSignup', 'Sign Up!'));

		// Create action
		$validator = new RequiredFields('Email');

		$form = new Form($this, 'NewsletterSignUpForm', $fields, $actions, $validator);
		$form->enableSpamProtection();

		return $form;
	}

	public function doNewsletterSignup($data, $form) {
		$newsletterPerson = new NewsletterPerson;
		$form->saveInto($newsletterPerson);

		$newsletterPerson->write();

		Controller::curr()->redirect("home/?signup=1");
	}

	public function isHelpLab() {

		$Member = Member::currentUser();

		if ($Member) {

			$IDMember = $Member->ID;
			$memberLabs = Member::get()->where("ID=$IDMember and ID in (SELECT DISTINCT MemberID from  `HelpLab_Members`)");

			return $memberLabs;
		}

		return false;
	}

	public function News($number = 3) {
		$articles = ArticlePage::get()->sort('Date DESC');
		if ($articles) {
			return $articles;
		}
	}

	/**
	 * Process and render search results.
	 *
	 * !! NOTE
	 * _config.php includes:
	 *
	 * FulltextSearchable::enable();
	 * Object::add_extension('ExtendedPage', "FulltextSearchable('HeadlineText')");
	 * Object::add_extension('NewsStory', "FulltextSearchable('Name,Content')");
	 * !!
	 *
	 * @param array $data The raw request data submitted by user
	 * @param Form $form The form instance that was submitted
	 * @param SS_HTTPRequest $request Request generated for this action
	 */
	function results($data, $form, $request) {
		$keyword = trim($request->requestVar('Search'));
		$keyword = Convert::raw2sql($keyword);
		$keywordHTML = htmlentities($keyword, ENT_NOQUOTES, 'UTF-8');

		$this->addSearchTermToLibrary($keyword);

		$pages = new ArrayList();
		$news = new ArrayList();
		$files = new ArrayList();

		$mode = ' IN BOOLEAN MODE';

		$siteTreeClasses = array('TutorPage', 'SupplementalInstruction', 'HelpLab');
		//add in an classes that extend Page or SiteTree
		$siteTreeMatch = "MATCH( Title, MenuTitle, Content, Tags) AGAINST ('$keyword'$mode)
                    + MATCH( Title, MenuTitle, Content, Tags) AGAINST ('$keywordHTML'$mode)";

		/*
		 * Standard pages
		 * SiteTree Classes with the default search MATCH
		 */
		foreach ($siteTreeClasses as $c) {
			$query = DataList::create($c)->where($siteTreeMatch);
			$query = $query->dataQuery()->query();
			$query->addSelect(array('Relevance' => $siteTreeMatch));

			$records = DB::query($query->sql());
			$objects = array();
			foreach ($records as $record) {
				if (in_array($record['ClassName'], $siteTreeClasses)) {
					$objects[] = new $record['ClassName']($record);
				}
			}

			$pages->merge($objects);
		}

		$pages->sort(array('Relevance' => 'DESC', 'Title' => 'ASC'));

		$data = array('Tutors' => $pages->filter(array('ClassName' => 'TutorPage')), 'SupplementalInstructions' => $pages->filter(array('ClassName' => 'SupplementalInstruction')), 'HelpLabs' => $pages->filter(array('ClassName' => 'HelpLab')), 'Query' => $keyword, 'Title' => 'Search Results');

		if ($pages->count() == 0 && $news->count() == 0 && $files->count() == 0) {
			$data['NoResults'] = 1;
		} else {
		}

		return $this->customise($data)->renderWith(array('Page_results', 'Page'));
	}

	private function addSearchTermToLibrary($keyword) {

		$term = SearchTerm::get()->filter(array('Title' => $keyword))->First();

		if (isset($term)) {
			$term->SearchCount = $term->SearchCount + 1;
			$term->write();
		} else {
			$term = new SearchTerm();
			$term->Title = $keyword;
			$term->write();
		}

	}

	//I want logout to redirect to the home page

	function logout() {
		Security::logout(false);
		Controller::curr()->redirect("home/");
	}

	function LogoutLink() {
		return $this->Link('logout');
	}

	public function SiteAdmin() {
		if (Permission::check('ADMIN')) {
			return true;
		}
	}

	public function LatestNews($num = 5) {
		$news = ArticlePage::get()->sort('Sort')->limit($num);
		return $news;

	}

	function getHelpLabs() {
		$Member = Member::CurrentUser();
		if ($Member) {
			$IDMember = $Member->ID;

			//$memberLabs = DataObject::get('HelpLab', "HelpLab_Live.ID in (SELECT DISTINCT HelpLabID from  `HelpLab_Members` where MemberID = $IDMember)");
			$memberLabs = $Member->HelpLabs();
			if ($memberLabs) {
				return $memberLabs;
			}
		}
	}
}
