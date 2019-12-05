<?php

use SilverStripe\TagField\TagField;
use SilverStripe\ORM\DataObject;

class TagsCollection extends DataObject{
	private static $db = array(
			"Title" => "Varchar",
			"Count" => "Int"
		);
	public function getCMSFields() {

		$fields = parent::getCMSFields();
		
		$fields->addFieldToTab( 'Root.Main', new TagField( "Title", "Tag" ) );
		

		

		return $fields;

	}

}

