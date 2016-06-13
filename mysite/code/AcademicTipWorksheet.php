<?php

class AcademicTipWorksheet extends DataObject {

	private static $db = array(
		'Title' => 'Text',
		'Content' => 'HTMLText',
		
		
	);

	private static $has_one = array(
		'Worksheet' => 'File'
	);


	private static $belongs_many_many = array(
		'Categories' => 'AcademicTipCategory'
	);


	public function getCMSFields() {
		$fields = parent::getCMSFields();

$tagField = TagField::create(
    'Categories',
    'Categories',
    AcademicTipCategory::get(),
    $this->Categories()
)->setCanCreate(true);     // new tag DataObjects can be created

		//$tagField = new TagField('Categories', 'Categories');

		$uploadField = new UploadField('Worksheet','Worksheet');
  

        $fields->addFieldToTab('Root.Main', $uploadField);
		$fields->addFieldToTab('Root.Main', $tagField);
		



		return $fields;

	}



}