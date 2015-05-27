<?php
class CustomSiteConfig extends DataExtension {

	private static $db = array(
		'LoginContent' => 'HTMLText',
	);

	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab("Root.Main",
			new HTMLEditorField("LoginContent", "Login Box Text")
		);
	}
}