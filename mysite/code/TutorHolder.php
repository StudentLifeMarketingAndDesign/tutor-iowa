<?php
class TutorHolder extends Page {
	private static $db = array(
	);
	private static $has_one = array(
	);

	private static $allowed_children = array('TutorPage');

	private static $extensions = array(
		'PageHolderExtension',
	);

	private static $pageholder_insertBefore = 'Content';

	private static $excluded_children = array('TutorPage');

	private static $icon = 'mysite/cms_icons/amount.png';
}
class TutorHolder_Controller extends Page_Controller {

}
