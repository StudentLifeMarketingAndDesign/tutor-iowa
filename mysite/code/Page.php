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
	public function Breadcrumbs($maxDepth = 20, $unlinked = false, $stopAtPageType = false, $showHidden = false) {
		return parent::Breadcrumbs(20, false, false, true);
	}

	public function SplitKeywords() {
		$keywords = $this->Tags;
		if ($keywords) {
			$splitKeywords = explode(',', $keywords);
		}

		if (isset($splitKeywords)) {
			$keywordsList = new ArrayList();
			foreach ($splitKeywords as $data) {
				$do = new DataObject();
				$do->Keyword = $data;
				$keywordsList->push($do);
			}
			return $keywordsList;
		}
	}

	public function search($keyword) {
		$pages = new ArrayList();
		$news = new ArrayList();
		$files = new ArrayList();
		$keywordHTML = htmlentities($keyword, ENT_NOQUOTES, 'UTF-8');
		$keywordFiltered = Convert::raw2sql($keywordHTML);
		$mode = ' IN BOOLEAN MODE';

		$siteTreeClasses = array('SiteTree', 'TutorPage', 'SupplementalInstruction', 'HelpLab');
		//add in an classes that extend Page or SiteTree
		$siteTreeMatch = "MATCH( Title, MenuTitle, Content, Tags) AGAINST ('$keywordFiltered'$mode)
                    + MATCH( Title, MenuTitle, Content, Tags) AGAINST ('$keywordFiltered'$mode)";

		/*
		 * Standard pages
		 * SiteTree Classes with the default search MATCH
		 */
		foreach ($siteTreeClasses as $c) {
			$query = DataList::create($c)->where($siteTreeMatch);
			$query = $query->dataQuery()->query();
			$query->SelectField($siteTreeMatch, 'Relevance');
			$records = DB::query($query->sql());
			$objects = array();
			foreach ($records as $record) {
				if (in_array($record['ClassName'], $siteTreeClasses)) {
					$objects[] = new $record['ClassName']($record);
				}
			}

			$pages->merge($objects);
			$pages->removeDuplicates();
			$pages->sort(array('Relevance' => 'DESC', 'Title' => 'ASC'));

			$shuffletutors = $pages->filter(array('ClassName' => 'TutorPage'));
			$shuffletutors = $shuffletutors->toArray();
			shuffle($shuffletutors);
			$tutors = new ArrayList($shuffletutors);

			$SupplementalInstructions = $pages->filter(array('ClassName' => 'SupplementalInstruction'));
			$HelpLabs = $pages->filter(array('ClassName' => 'HelpLab'));

			if ($HelpLabs->First() || $tutors->First() || $SupplementalInstructions->First()) {
				$resultsFound = true;
			} else {
				$resultsFound = false;
			}

			//$data = array('Tutors' => $pages->filter(array('ClassName' => 'TutorPage')), 'SupplementalInstructions' => $pages->filter(array('ClassName' => 'SupplementalInstruction')), 'HelpLabs' => $pages->filter(array('ClassName' => 'HelpLab')), 'Query' => $keyword, 'Title' => 'Search Results');
			$data = new ArrayData(
				array(
					'Tutors' => $tutors,
					'SupplementalInstructions' => $SupplementalInstructions,
					'HelpLabs' => $HelpLabs,
					'Query' => $keyword,
					'Title' => 'Search Results',
					'HasResults' => $resultsFound,
				)

			);

			return $data;
		}
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

		$data = $this->search($keyword);

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
	public function getTagsCollection() {

		$entries = SiteTree::get();
		//$entries = SiteTree::get()->filter(array("ClassName" => "TutorPage", "ClassName" => "HelpLab"));
		// Extract all tags from each entry
		$tagCounts = array(); // Mapping of tag => frequency

		foreach ($entries as $entry) {
			$theseTags = $entry->SplitKeywords();
			if (isset($theseTags)) {
				foreach ($theseTags as $tag => $tagLabel) {
					if ($tagLabel->Keyword != '') {
						$tagLabels[$tag] = $tagLabel;
						//getting the count into key => value map
						$tagCounts[$tag] = isset($tagCounts[$tag]) ? $tagCounts[$tag] + 1 : 1;
					}
				}
			}
		}

		if (empty($tagCounts)) {
			return null;
		}

		$minCount = min($tagCounts);
		$maxCount = max($tagCounts);

		// Apply sorting mechanism
		// if($this->Sortby == "alphabet") {
		// 	// Sort by name
		// 	ksort($tagCounts);
		// } else {
		// 	 // Sort by frequency
		// 	uasort($tagCounts, function($a, $b) {
		// 		return $b - $a;
		// 	});
		// }

		uasort($tagCounts, function ($a, $b) {
			return $b - $a;
		});

		// Apply limiting
		if ($this->Limit > 0) {
			$tagCounts = array_slice($tagCounts, 0, $this->Limit, true);
		}

		// Calculate buckets of popularities
		$numsizes = count(array_unique($tagCounts)); //Work out the number of different sizes
		$popularities = self::config()->popularities;
		$buckets = count($popularities);
		// If there are more frequencies than buckets, divide frequencies into buckets
		if ($numsizes > $buckets) {
			$numsizes = $buckets;
		}

		// Adjust offset to use central buckets (if using a subset of available buckets)
		$offset = round(($buckets - $numsizes) / 2);
		$output = new ArrayList();
		foreach ($tagCounts as $tag => $count) {

			// Find position of $count in the selected range, adjusted for bucket range used
			if ($maxCount == $minCount) {
				$popularity = $offset;
			} else {
				$popularity = round(
					($count - $minCount) / ($maxCount - $minCount) * ($numsizes - 1)
				) + $offset;
			}
			$class = $popularities[$popularity];

			$output->push(new ArrayData(array(
				"Title" => $tagLabels[$tag]->Keyword,
				"Count" => $count,
				"Class" => $class,
				//"Link" => Controller::join_links($container->Link('tag'), urlencode($tag))
			)));
		}

		// $output is now a sorted ArrayList full of tags.

		//The following will grab 5 unpopular tags and shuffle them into the top 20 popular ones

		$unPoptags = new ArrayList();
		$collection = $output->toArray();
		$unPoptagsLimit = 5;

		//print_r($collection);

		foreach ($collection as $tag) {
			$tag = $tag->toMap();

			if ($tag['Count'] <= $minCount + ($unPoptagsLimit - 1)) {
				$unPoptags->add($tag);

			}
		}

		$unPoptags = $unPoptags->toArray();
		//print_r($unPoptags);

		if (count($unPoptags) >= $unPoptagsLimit) {
			$unPopKeys = array_rand($unPoptags, $unPoptagsLimit);
		} else {
			$unPopKeys = array_rand($unPoptags, count($unPoptags));
		}

		foreach ($unPopKeys as $key) {
			$unPopTagsFiltered[] = $unPoptags[$key];
		}

		$finalTagCollection = $unPopTagsFiltered;

		$i = 0;

		foreach ($collection as $tag) {
			$tag = $tag->toMap();
			array_push($finalTagCollection, $tag);
			if (++$i > 20) {
				break;
			}
		}

		shuffle($finalTagCollection);
		$finalOutput = new ArrayList($finalTagCollection);
		return $finalOutput;
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

	public function getRandomSupplementalInstruction() {
		$suppInstruction = SupplementalInstruction::get()->sort('RAND()');
		return $suppInstruction;
	}
	public function getRandomHelpLabs() {
		$helpLabs = HelpLab::get()->sort('RAND()');
		return $helpLabs;
	}

	public function getRandomTutors() {
		$tutors = TutorPage::get()->sort('RAND()');
		return $tutors;
	}
}