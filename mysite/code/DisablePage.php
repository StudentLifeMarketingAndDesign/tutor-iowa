<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\Form;
use SilverStripe\Security\Member;
use SilverStripe\Core\Config\Config;
use SilverStripe\Control\Email\Email;
use SilverStripe\Control\Director;
use SilverStripe\SiteConfig\SiteConfig;


/**
 *

It is my assumption that Disable Page can only be reached from the EditProfilePage and hence there is no checking for whether there is a current member on this page (it's assumed since you have to be logged in to access the Edit Profile Page)
 */

class DisablePage extends Page {
	private static $db = array(
	);
	private static $has_one = array(
	);

	private static $defaults = array('ProvideComments' => '1',

	);

}

