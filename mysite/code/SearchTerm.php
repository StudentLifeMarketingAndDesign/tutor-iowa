<?php

use SilverStripe\ORM\DataObject;
class SearchTerm extends DataObject {

	private static $db = array(
		'Title' => 'Varchar(255)',
		'SearchCount' => 'Int',
	);

	private static $defaults = array(
		'SearchCount' => 1,
	);

}
