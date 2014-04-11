<?php

global $project;
$project = 'mysite';

global $database;
$database = 'tutor';

MySQLDatabase::set_connection_charset('utf8');
// Use _ss_environment.php file for configuration
require_once("conf/ConfigureFromEnv.php");

// This line set's the current theme. More themes can be
// downloaded from http://www.silverstripe.org/themes/
SSViewer::set_theme('blackcandy');

// Set the site locale
i18n::set_locale('en_US');

// enable nested URLs for this site (e.g. page/sub-page/)
SiteTree::enable_nested_urls();

//Added by Drew
FulltextSearchable::enable();

include("recaptchaKeys.php");
//Director::set_environment_type("live");

//PageComment::enableModeration();

//Validator::set_javascript_validation_handler('none');
//SpamProtectorManager::set_spam_protector("RecaptchaProtector");

Email::setAdminEmail("tutoriowa@uiowa.edu");
//error_reporting(E_ALL);
Object::useCustomClass('MemberLoginForm', 'CustomLoginForm');
//Object::add_extension('TutorPage', 'TutorPagePublish');

Object::add_extension("TutorPage", "TutorPageExtension");
Object::add_extension("SiteTree", "SiteTreeFieldExtension");
/* ---- */