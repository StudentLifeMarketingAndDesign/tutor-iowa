<?php

use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\ORM\ArrayList;


class AcademicTipWorksheetHolder extends Page {

	
	public function getCMSFields() {
		
		$fields = parent::getCMSFields();

		$gridFieldConfigWorksheetViewer = GridFieldConfig_RecordEditor::create();
		$gridfield = new GridField("WorksheetViewer", "Worksheet Viewer", AcademicTipWorksheet::get(), $gridFieldConfigWorksheetViewer);
		$fields->addFieldToTab('Root.Main', $gridfield, 'Content');

		return $fields;
	}

	public function Categories(){
		$cats = AcademicTipCategory::get();

		$catsWithSheets = new ArrayList();

		foreach($cats as $cat){
			if($cat->Worksheets()->First()){
				$catsWithSheets->push($cat);
			}
		}

		return $cats;
	}

	public function RandomWorksheets(){
		$worksheets = AcademicTipWorksheet::get()->sort('RAND()');
		return $worksheets;
	}

	public function UncategorizedWorksheets(){
		$worksheets = AcademicTipWorksheet::get();

		$uncatWorksheets = new ArrayList();

		foreach($worksheets as $worksheet){
			if(!($worksheet->Categories()->First())){
				$uncatWorksheets->push($worksheet);
			}
		}

		return $uncatWorksheets;


	}
}