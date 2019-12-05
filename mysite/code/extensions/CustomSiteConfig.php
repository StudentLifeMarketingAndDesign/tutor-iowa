<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\DataExtension;
class CustomSiteConfig extends DataExtension {

	private static $db = array(
		'LoginContent' => 'HTMLText',
		'DisableAccountEmail' => 'HTMLText',
		'RegistrationRequest' => 'HTMLText'
	);

	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab("Root.Main",
			new HTMLEditorField("RegistrationRequest", "Registration Request Receipt (sent to tutors immediately upon filling out the registration form).")
		);
		$fields->addFieldToTab("Root.Main",
			new HTMLEditorField("DisableAccountEmail", "Disable Account Email (sent to tutors when they request that their page be disabled)")
		);

	}
}