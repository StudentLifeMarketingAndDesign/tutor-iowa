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
	);

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

		// Note: you should use SS template require tags inside your templates 
		// instead of putting Requirements calls here.  However these are 
		// included so that our older themes still work
		Requirements::themedCSS('layout'); 
		Requirements::themedCSS('typography'); 
		Requirements::themedCSS('form'); 
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