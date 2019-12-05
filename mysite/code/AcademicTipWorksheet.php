<?php

use SilverStripe\Assets\File;
use SilverStripe\Forms\FieldList;
use SilverStripe\TagField\TagField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\DataObject;

class AcademicTipWorksheet extends DataObject {

	private static $db = array(
		'Title' => 'Text',
		'Content' => 'HTMLText'
		
	);

	private static $has_one = array(
		'Worksheet' => 'File'
	);


	private static $belongs_many_many = array(
		'Categories' => 'AcademicTipCategory'
	);


	public function getCMSFields() {
		$fields = new FieldList();


		$tagField = TagField::create(
		    'Categories',
		    'Categories',
		    AcademicTipCategory::get(),
		    $this->Categories()
		)->setCanCreate(true);     // new tag DataObjects can be created

		$uploadField = new UploadField('Worksheet','Worksheet');

		$fields->push(new TextField('Title', 'Title'));
		$fields->push($uploadField);
		$fields->push($tagField);
		$fields->push(new HTMLEditorField('Content', 'Short Description'));


		// $fields->push(new UploadField("Image", "Image"));
		// $fields->push(new TreeDropdownField("AssociatedPageID", "Link to this page", "SiteTree"));
		// $fields->push(new TextField('ExternalLink', 'Use the external link instead:'));
		// $fields->push(new HTMLEditorField('Content', 'Content'));

		return $fields;
	}




}