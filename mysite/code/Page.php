<?php
class Page extends SiteTree {

	private static $db = array(
	
	);

	private $has_one = array(
  	"Image" => "Image",
   );
	
	private static $defaults = array ('ProvideComments' => '1',
    
   
    
    );
    
   public function getCMSFields() 
    {
    	$fields = parent::getCMSFields();
    	$fields->addFieldToTab("Root.Main", new UploadField("Image", "Image"));
    	return $fields;
	}

}

class Page_Controller extends ContentController {


	
    public function SplitKeywords(){
	    $keywords = $this->MetaKeywords;
	    
	    if($keywords){
		   $splitKeywords = explode(',', $keywords); 
	    }
	    
	    if($splitKeywords){
			$keywordsList = new ArrayList(); 
			foreach($splitKeywords as $data) { 
				$do=new DataObject(); 
				$do->Keyword = $data; 
				$keywordsList->push($do); 
			} 
			return $keywordsList; 
			}
    }
public function currentMemberPage(){
	$currentMember = Member::currentUser();
	$currentMemberID = $currentMember->ID;
	
	
	//$tutorPage = DataObject::get_one("TutorPage", "MemberID = ".$currentMemberID);
	$tutorPage = TutorPage::get("TutorPage")->where("MemberID = ".$currentMemberID)->First();
	
	//print_r($tutorPage);
	
	if(isset($tutorPage)){
		return $tutorPage;
		
	}
	
	
}

public function getHelpLab(){
	if ($this->isHelpLab()){
		//$HelpLab = DataObject::get_one("YourHelpLabs");	
	    $HelpLab = YourHelpLabs::get("YourHelpLabs")->First();	
		return $HelpLab;	
	}
}

public function NewsletterSignUpForm(){
		$emailLabelText = '<p>Enter your email address below to keep up-to-date with TutorIowa. We\'ll occasionally
		send you a newsletter with tips on finding help this academic year!</p>';
	    $fields = new FieldList(
          	new LiteralField('EmailLabel', $emailLabelText),
            new EmailField('EmailAddress', 'Your Email Address')
                     
        );
        
        $actions = new FieldList(
            new FormAction('doNewsletterSignup', 'Sign Up!')
        );
        // Create action
        $validator = new RequiredFields('Email');
        
        $form = new Form($this, 'NewsletterSignUpForm', $fields, $actions, $validator);
        
        $protector = SpamProtectorManager::update_form($form, 'Message');
 
        return $form;      
	
}

public function doNewsletterSignup($data, $form){
	$newsletterPerson = new NewsletterPerson;
	$form->saveInto($newsletterPerson); 
	
	$newsletterPerson->write();
	
	Controller::curr()->redirect("home/?signup=1");


	
}




public function isHelpLab(){

	$Member = Member::currentUser();
	
	if ($Member){
		
		$IDMember = $Member->ID;
	
	
		#$memberLabs = DataObject::get('Member', "ID in (SELECT DISTINCT MemberID from  `HelpLab_Members`)");
		
		//$memberLabs = DataObject::get('Member', "ID=$IDMember and ID in (SELECT DISTINCT MemberID from  `HelpLab_Members`)");
		$memberLabs = Member::get()->where("ID=$IDMember and ID in (SELECT DISTINCT MemberID from  `HelpLab_Members`)");
	
		
		return $memberLabs;
		
    }
	
	return false;
	 
}

/*
public function isHelpLabCached(){
	return (Session::get("isHelpLabCached") == 1);
}

public function isHelpLabSession(){
	return (Session::get("isHelpLabSession") == 1);
}
*/

public function News($number=3){
	//$articles = DataObject::get("ArticlePage", $filter = null, $sort = "Date DESC", $join = null, $limit = $number);
	$articles = ArticlePage::get()->sort('Date DESC');
	
	if($articles)
		return $articles;
	
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
function results($data, $form, $request)
  {	
    $keyword = trim($request->requestVar('Search'));
    $keyword = Convert::raw2sql($keyword);
    $keywordHTML = htmlentities($keyword, ENT_NOQUOTES, 'UTF-8');    
        
    $pages = new ArrayList();
    $news = new ArrayList();
    $files = new ArrayList();
    
    $mode = ' IN BOOLEAN MODE';
    //$mode = ' WITH QUERY EXPANSION';
    //$mode = '';
        
    $siteTreeClasses = array('TutorPage', 'SupplementalInstruction', 'HelpLab'); //add in an classes that extend Page or SiteTree
    $siteTreeMatch = "MATCH( Title, MenuTitle, Content, MetaKeywords) AGAINST ('$keyword'$mode)
                    + MATCH( Title, MenuTitle, Content, MetaKeywords) AGAINST ('$keywordHTML'$mode)";
    
    
    /*
     * Standard pages
     * SiteTree Classes with the default search MATCH
     */
    foreach ( $siteTreeClasses as $c )
    {
      $query = DataList::create($c)
        ->where($siteTreeMatch);
      $query = $query->dataQuery()->query();
      $query->addSelect(array('Relevance' => $siteTreeMatch));
      
      $records = DB::query($query->sql());
      $objects = array();
      foreach( $records as $record )
      {
        if ( in_array($record['ClassName'], $siteTreeClasses) )
          $objects[] = new $record['ClassName']($record);
      }
      $pages->merge($objects);
    }

    /* ** */    
    $pages->sort(array(
      'Relevance' => 'DESC',
      'Title' => 'ASC'
    ));
    
    $data = array(
      'Tutors' => $pages->filter(array('ClassName' => 'TutorPage')),
      'SupplementalInstructions' => $pages->filter(array('ClassName' => 'SupplementalInstruction')),
      'HelpLabs' => $pages->filter(array('ClassName' => 'HelpLab')),
	  'Query' => $keyword,
	  'Title' => 'Search Results'
		); 
    /*

           $data = array( 
       'Results' => $results, 
       'Tutors' => $tutors,
       'SupplementalInstructions' => $supplementalInstructions,
       'HelpLabs' => $helpLabs,
       'Query' => $form->getSearchQuery(), 
       'Title' => 'Search Results' 
       );*/
    
    if ( $pages->count() == 0 
      && $news->count() == 0
      && $files->count() == 0 )
    {
    	$data['NoResults'] =1;
    }else{
    	
    }
    
    return $this->customise($data)->renderWith(array('Page_results', 'Page')); 
}

/* Old Results Function For Reference Only */
/*
 function results($data, $form){
	  $form->setPageLength(99999); //Makeshift way of disabling pagination for results
      $results = $form->getResults();
      
      
      $supplementalInstructions = new ArrayList();
      $tutors = new ArrayList();
      $helpLabs = new ArrayList();
      
      foreach($results AS $result) { 
      
         if($result->ClassName == "SupplementalInstruction") {
         	$supplementalInstructions->push($result);
          }
          
         if($result->ClassName == "TutorPage") {
           
         	//$tutorObject = DataObject::get_by_id("TutorPage", $result->ID);
         	$tutorObject = TutorPage::get()->byID($result->ID);
         	$tutors->push($tutorObject);
         	//print_r($result);
          }
          
         if($result->ClassName == "HelpLab") {
         	$helpLabs->push($result);
          }                  
          
      }
      //print_r($tutors);
       $data = array( 
       'Results' => $results, 
       'Tutors' => $tutors,
       'SupplementalInstructions' => $supplementalInstructions,
       'HelpLabs' => $helpLabs,
       'Query' => $form->getSearchQuery(), 
       'Title' => 'Search Results' 
       );

       return $this->customise($data)->renderWith(array('Page_results', 'Page')); 
   }*/


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
	private static $allowed_actions = array (
	'logout'
	);
	
	
	//I want logout to redirect to the home page
	
	function logout() { 
		Security::logout(false); 
		Controller::curr()->redirect("home/"); 
	}

	function LogoutLink() { 
		return $this->Link('logout');
	}
	
	public function init() {
		parent::init();
		//require_once '/Applications/MAMP/htdocs/tutoriowa3/ChromePhp.php';
		Requirements::block('/cms/css/layout.css'); 

		if (isset($_GET['setTheme'])) {
      if (Director::isDev() || Permission::check('ADMIN')) {
        Session::set('theme', $_GET['setTheme']);
      } else {
        Security::permissionFailure(null,
          'Please log in as an administrator to switch theme.');
      }
    }
 
    if (isset($_GET['theme'])) {
      if (Director::isDev() || Permission::check('ADMIN')) {
        SSViewer::set_theme($_GET['theme']);
      } else {
        Security::permissionFailure(null,
          'Please log in as an administrator to set the theme.');
      }
 
    } elseif (Session::get('theme')) {
      SSViewer::set_theme(Session::get('theme'));
    }


	}
	
  function getHelpLabs(){
     $Member = Member::CurrentUser();
     if ($Member){
     	$IDMember = $Member->ID;    
     	//$memberLabs = DataObject::get('HelpLab', "HelpLab_Live.ID in (SELECT DISTINCT HelpLabID from  `HelpLab_Members` where MemberID = $IDMember)");
     	$memberLabs = HelpLab::get()->where("HelpLab_Live.ID in (SELECT DISTINCT HelpLabID from  `HelpLab_Members` where MemberID = $IDMember)");
     	if ($memberLabs) {
     		return $memberLabs;
     	}
     }
   }
	
	/*
	public function getDisabled() { //This is used to check whether the user's account is disabled.  If it is, a link to enable the account should appear
		$Member = Member::CurrentMember();
		
		$IDMember = $Member->ID;
		$Tutor = DataObject::get_one("TutorPage", "MemberID = $IDMember");
		if ($Tutor){
			$TutorDisabled = $Tutor->Disabled;
		else {
			return false;
		}
		return $TutorDisabled;
	}
	*/
	
	function getTest(){	
		 $tutorParent = DataObject::get_one('TutorHolder', "Title = 'Private Tutors'");
		 Debug::show($tutorParent);
		 $title = $tutorParent->Title;
		 return "HI!!!";
	 }
	 
	
	 
}

