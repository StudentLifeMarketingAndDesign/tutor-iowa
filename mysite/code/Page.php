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
		// $fields->addFieldToTab("Root.Main", new UploadField("Image", "Image"));
		// $fields->addFieldToTab("Root.Main", new UploadField("BackgroundImage", "BackgroundImage"));
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

	public function RandomChildren(){
		$children = Page::get()->filter(
			array(
				"ParentID" => $this->ID
			)
		)->sort('RAND()');
		return $children;
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
	public function getMemberHelpLabs() {
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
	private static $allowed_actions = array(
		'logout', 
		'FeedbackForm',
		'hawkCheck'
	);

	private static $url_handlers = array(
		'hawkCheck//' => 'hawkCheck'
	);

	public function hawkCheck(){
	
		if(!Member::currentUser()){
			return Security::permissionFailure($this);
		}
		
		// return $this->renderWith(array('TutorPage', 'Page'));
		return $this->redirect($this->Link());
	}

	public function FeedbackForm() {

		$getVars = $this->request->getVars();

		//If directed to feedback page from a tutor's page, set the hidden field Tutor ID to have the value of the GET parameter
		/* if (isset($getVars['TutorID'])){
		$tutorID = $getVars['TutorID'];
		$tutorPage = TutorPage::get()->byID($tutorID);
		$firstName = $tutorPage->FirstName;
		$surname = $tutorPage->Surname;

		}
		else {
		$tutorID = 0;
		$firstName = '';
		$surname = '';
		}*/
		$tutorID = 0;
		$firstName = '';
		$surname = '';

		if (Member::currentUser()) {
			$member = Member::currentUser();
			$memberName = $member->FirstName . ' ' . $member->Surname;
			$memberEmail = $member->Email;
		} else {
			$memberName = '';
			$memberEmail = '';
		}

		if ($this->ClassName == "TutorPage") {
			$niceName = "tutor";
		} else if ($this->ClassName == "HelpLab") {
			$niceName = "help lab";
		} else if ($this->ClassName == "SupplementalInstruction") {
			$niceName = "supplemental instruction";
		} else {
			$niceName = "page";
		}

		$checkbox = new Checkboxfield('SpecificPage', 'This feedback is related to this ' . $niceName . ': <strong>' . $this->Title . '</strong>');

		if ($this->ClassName == "TutorPage" || $this->ClassName == "HelpLab" || $this->ClassName == "SupplementalInstruction") {
			$checkbox->setValue('1');
		}

		$fields = new FieldList(

			//new LabelField("label", "Enter first and last name if your feedback concerns a specific tutor.  If your feedback does not concern a specific person, ignore these fields."),
			new TextField('Name', '<span>*</span>Your Name', $memberName),
			new EmailField('Email', '<span>*</span>Your Email Address', $memberEmail),
			$checkbox,
			new TextAreaField('Feedback', '<span>*</span>Your Feedback'),
			new HiddenField('PageID', 'PageID', $this->ID)
		);

		if($this->ClassName == "FeedbackPage"){
			$fields->removeByName("SpecificPage");
		}

		$actions = new FieldList(
			new FormAction('SubmitFeedbackForm', 'Submit Feedback')
		);

		// Create action
		$validator = new RequiredFields('Name', 'Email', 'Feedback');

		//Create form
		$Form = new FoundationForm($this, 'FeedbackForm', $fields, $actions, $validator);


		return $Form;

	}

	public function ClearSession() {
		Session::clear('Saved');
	}

	public function SubmitFeedbackForm($data, $form) {

		$adminEmail = Config::inst()->get('Email', 'admin_email');

		$feedback = new FeedbackItem();
		$form->saveInto($feedback);

		$feedback->write();

		if ($feedback->SpecificPage == "1") {
			
			$relatedPage = Page::get_by_id("Page", $feedback->PageID);

		}
		
		$subject = "Feedback submitted";

		//check data for errors
		$name = Convert::raw2sql($data['Name']);
		$userEmail = Convert::raw2sql($data['Email']);
		$feedback = Convert::raw2sql($data['Feedback']);


		if (isset($relatedPage)){
			$body = '' . $name . " has submitted feedback for page " . $relatedPage->Title . ". <br><br>Feedback:" . $feedback;
		} else {
			$body = '' . $name . " has submitted feedback. " . "<br><br>Feedback:" . $feedback;
		}

		$email = new Email();
		$email->setTo($adminEmail);
		$email->setFrom($adminEmail);
		$email->setSubject($subject);
		$email->setBody($body);
		if (SS_ENVIRONMENT_TYPE == "live") {
			$email->send(); 
		}

		Session::set('Saved', 1);

		return $this->redirect($this->Link());

	}

	public function Saved() {
		$saved = Session::get('Saved');
		if ($saved == 1) {
			return true;
		} else {
			return false;
		}

	}
	//If current user has page at ALL, published or draft
	public function currentMemberPage() {
		$currentMember = Member::currentUser();

		if (isset($currentMember->ID)) {
			$currentMemberID = $currentMember->ID;
		} else {
			return false;
		}

		//$tutorPage = TutorPage::get("TutorPage")->where("MemberID = " . $currentMemberID)->First();
		$tutorPageStage = Versioned::get_by_stage('TutorPage', 'Stage')->filter(array('MemberID' => $currentMemberID))->First();
		//print_r($tutorPageStage);
		if (isset($tutorPageStage)) {
			return $tutorPageStage;
		}else{
			$tutorPageLive = Versioned::get_by_stage('TutorPage', 'Live')->filter(array('MemberID' => $currentMemberID))->First();
			return $tutorPageLive;			
		}
	}
	//If current user has a published page
	public function approvedTutor() {

		$currentMember = Member::currentUser();

		if (isset($currentMember->ID)) {
			$currentMemberID = $currentMember->ID;
		} else {
			return false;
		}

		$tutorPage = TutorPage::get()->filter(array('MemberID' => $currentMemberID))->First();

		return $tutorPage;
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

	public function logout() {
		Security::logout(false);
		Controller::curr()->redirect("home/");
	}

	public function LogoutLink() {
		$backURL = '?BackURL=' . urlencode($this->owner->Link());
		return Controller::join_links(Director::absoluteBaseURL() . Config::inst()->get('Security', 'logout_url'), $backURL);
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