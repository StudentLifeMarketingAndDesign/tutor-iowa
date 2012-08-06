<?php

class NewsletterPerson extends DataObject {
	
		public static $db = array (
			"EmailAddress" => "Varchar(255)"
		);
		
		public static $has_one = array(
		);	
	
}