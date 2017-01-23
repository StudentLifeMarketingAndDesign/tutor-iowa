<?php

class Tag extends DataObject{
	private static $db = array(
			"Title" => "Varchar",
		);

	private static $many_many = array(
		'SiteTrees' => 'SiteTreeFieldExtension'
		);


}

