<?php
class Page extends SiteTree {

	public static $db = array(
	);

	public static $has_one = array(
	);
	
	static $defaults = array ('ProvideComments' => '1',
    
   
    
    );
    


}

class Page_Controller extends ContentController {

public function currentMemberPage(){
	$currentMember = Member::currentUser();
	$currentMemberID = $currentMember->ID;
	
	
	$tutorPage = DataObject::get_one("TutorPage", "MemberID = ".$currentMemberID);
	
	//print_r($tutorPage);
	
	if(isset($tutorPage)){
		return $tutorPage;
		
	}
	
	
}

public function getHelpLab(){
	if ($this->isHelpLab()){
		$HelpLab = DataObject::get_one("YourHelpLabs");		
		return $HelpLab;	
	}
}

public function isHelpLab(){

	$Member = Member::CurrentMember();
	$IDMember = $Member->ID;
	#$memberLabs = DataObject::get('Member', "ID in (SELECT DISTINCT MemberID from  `HelpLab_Members`)");
	
	$memberLabs = DataObject::get('Member', "ID=$IDMember and ID in (SELECT DISTINCT MemberID from  `HelpLab_Members`)");
	
	return $memberLabs;
	 
}


public function News($number=3){
	$articles = DataObject::get("ArticlePage", $filter = null, $sort = "Date DESC", $join = null, $limit = $number);
	if($articles)
		return $articles;
	
}

 function results($data, $form){

      $results = $form->getResults();
      
      $supplementalInstructions = new DataObjectSet();
      $tutors = new DataObjectSet();
      $helpLabs = new DataObjectSet();
      
      foreach($results AS $result) { 
      
         if($result->ClassName == "SupplementalInstruction") {
         	$supplementalInstructions->push($result);
          }
          
         if($result->ClassName == "TutorPage") {
         
         	$tutorObject = DataObject::get_by_id("TutorPage", $result->ID);
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
   }
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
	public static $allowed_actions = array (
	'logout'
	);
	
	
	//I want logout to redirect to the home page
	
	function logout() { 
		Security::logout(false); 
		Director::redirect("home/"); 
	}

	function LogoutLink() { 
		return $this->Link('logout');
	}
	
	public function init() {
		parent::init();
		
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
}