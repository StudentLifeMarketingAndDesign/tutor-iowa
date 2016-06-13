<?php

class AcademicTipWorksheetHolder extends Page {

	
	public function getCMSFields() {
		
		$fields = parent::getCMSFields();

		$gridFieldConfigWorksheetViewer = GridFieldConfig_RecordEditor::create();
		$gridfield = new GridField("WorksheetViewer", "Worksheet Viewer", AcademicTipWorksheet::get(), $gridFieldConfigWorksheetViewer);
		$fields->addFieldToTab('Root.Main', $gridfield);

		return $fields;
	}
}


class AcademicTipWorksheetHolder_Controller extends Page_Controller {
}