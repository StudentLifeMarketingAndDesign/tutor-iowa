<?php

global $project;
$project = 'mysite';

global $database;
$database = 'tutor';

MySQLDatabase::set_connection_charset('utf8');
// Use _ss_environment.php file for configuration
require_once "conf/ConfigureFromEnv.php";

// This line set's the current theme. More themes can be
// downloaded from http://www.silverstripe.org/themes/
SSViewer::set_theme('blackcandy');

// Set the site locale
i18n::set_locale('en_US');
// enable nested URLs for this site (e.g. page/sub-page/)
SiteTree::enable_nested_urls();

//Added by Dre
FulltextSearchable::enable();

Object::useCustomClass('MemberLoginForm', 'CustomLoginForm');


if(Director::isLive()) {
	Director::forceSSL(array('/^tutor-application/', '/^Security/','/^admin/'));
}

