<?php

class TagsCollection extends DataObject{
	private static $db = array(
			"Title" => "Varchar",
			"Count" => "Int"
		);
	public function getCMSFields() {

		$fields = parent::getCMSFields();
		
		$fields->addFieldToTab( 'Root.Main', new TextField( "Title", "Tag" ) );
		$fields->addFieldToTab( 'Root.Main', new TextField( "Count", "Count" ) );
		

		return $fields;

	}

}

