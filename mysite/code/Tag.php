<?php

class Tag extends DataObject{
	private static $db = array(
			"Title" => "Varchar",
		);

	private static $belongs_many_many = array(
		'SiteTrees' => 'SiteTreeFieldExtension'
		);


}

