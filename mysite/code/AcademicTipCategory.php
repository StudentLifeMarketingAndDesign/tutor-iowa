<?php

class AcademicTipCategory extends DataObject {

	private static $db = array(
		'Title' => 'Text',
	);

	private static $many_many = array(
		'Worksheets' => 'AcademicTipWorksheet'
	);
}

