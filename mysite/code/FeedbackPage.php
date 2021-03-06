<?php
/**
 * Defines the HomePage page type
 */

class FeedbackPage extends Page {
	private static $db = array(

	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$gridFieldConfigFeedbackViewer = GridFieldConfig_RecordEditor::create();
		$gridfield = new GridField("FeedbackViewer", "Feedback Viewer", FeedbackItem::get(), $gridFieldConfigFeedbackViewer);
		$fields->addFieldToTab('Root.Main', $gridfield);

		return $fields;
	}

}

class FeedbackPage_Controller extends Page_Controller {

}