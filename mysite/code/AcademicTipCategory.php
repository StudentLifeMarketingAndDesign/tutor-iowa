<?php

use SilverStripe\ORM\DataObject;

class AcademicTipCategory extends DataObject {

	private static $db = array(
		'Title' => 'Text',
		'SortOrder' => 'Int'
	);

	private static $many_many = array(
		'Worksheets' => 'AcademicTipWorksheet'
	);

	private static $default_sort = 'SortOrder';
}

