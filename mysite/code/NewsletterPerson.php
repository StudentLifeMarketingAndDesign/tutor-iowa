<?php

class NewsletterPerson extends DataObject {
	
		private static $db = array (
			"EmailAddress" => "Varchar(255)"
		);
		
		private static $has_one = array(
		);	
	
}