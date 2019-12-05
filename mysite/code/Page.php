<?php

use SilverStripe\Assets\Image;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataObject;
use SilverStripe\Core\Convert;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\ORM\DataList;
use SilverStripe\ORM\DB;
use SilverStripe\View\ArrayData;
use SilverStripe\Security\Member;
use SilverStripe\Security\Security;
use SilverStripe\Forms\TextField;
use SilverStripe\Control\Email\Email;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Control\Session;
use SilverStripe\Core\Config\Config;
use SilverStripe\Versioned\Versioned;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\Form;
use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\Security\Permission;
use SilverStripe\CMS\Controllers\ContentController;

class Page extends SiteTree {

	private static $db = array();

	private static $has_one = array(
		"Image" => Image::class,
		"BackgroundImage" => Image::class,
	);

	private static $defaults = array('ProvideComments' => '1');

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		// $fields->addFieldToTab("Root.Main", new UploadField("Image", "Image"));
		// $fields->addFieldToTab("Root.Main", new UploadField("BackgroundImage", "BackgroundImage"));
		return $fields;
	}
	// public function Breadcrumbs($maxDepth = 20, $unlinked = false, $stopAtPageType = false, $showHidden = false) {
	// 	return parent::Breadcrumbs(20, false, false, true);
	// }

	public function SplitKeywords() {
		$keywords = $this->Tags;
		$keywords = str_replace('Certified Tutor', '', $keywords);



		if ($keywords) {
			$splitKeywords = explode(',', $keywords);
		}

		if (isset($splitKeywords)) {
			$keywordsList = new ArrayList();
			foreach ($splitKeywords as $data) {
				if(trim($data) != ''){
					$do = new DataObject();
					$do->Keyword = $data;
					$keywordsList->push($do);					
				}

			}
			return $keywordsList;
		}
	}

	public function RandomChildren(){
		$children = Page::get()->filter(
			array(
				"ParentID" => $this->ID
			)
		)->sort('RAND()');
		return $children;
	}

	public function search($keyword) {
		$pages = new ArrayList();
		$news = new ArrayList();
		$files = new ArrayList();
		$keywordHTML = htmlentities($keyword, ENT_NOQUOTES, 'UTF-8');
		$keywordFiltered = Convert::raw2sql($keywordHTML);
		$mode = ' IN BOOLEAN MODE';

		$siteTreeClasses = array(SiteTree::class, 'TutorPage', 'SupplementalInstruction', 'HelpLab');
		//add in an classes that extend Page or SiteTree
		$siteTreeMatch = "MATCH( Title, MenuTitle, Content, Tags) AGAINST ('$keywordFiltered'$mode)
                    + MATCH( Title, MenuTitle, Content, Tags) AGAINST ('$keywordFiltered'$mode)";

		/*
		 * Standard pages
		 * SiteTree Classes with the default search MATCH
		 */
		foreach ($siteTreeClasses as $c) {
			$query = DataList::create($c)->where($siteTreeMatch);
			$query = $query->dataQuery()->query();
			$query->SelectField($siteTreeMatch, 'Relevance');
			$records = DB::query($query->sql());
			$objects = array();
			foreach ($records as $record) {
				if (in_array($record['ClassName'], $siteTreeClasses)) {
					$objects[] = new $record['ClassName']($record);
				}
			}

			$pages->merge($objects);
			$pages->removeDuplicates();
			$pages->sort(array('Relevance' => 'DESC', 'Title' => 'ASC'));

			$shuffletutors = $pages->filter(array('ClassName' => 'TutorPage'));
			$shuffletutors = $shuffletutors->toArray();
			shuffle($shuffletutors);
			$tutors = new ArrayList($shuffletutors);

			$SupplementalInstructions = $pages->filter(array('ClassName' => 'SupplementalInstruction'));
			$HelpLabs = $pages->filter(array('ClassName' => 'HelpLab'));

			if ($HelpLabs->First() || $tutors->First() || $SupplementalInstructions->First()) {
				$resultsFound = true;
			} else {
				$resultsFound = false;
			}

			//$data = array('Tutors' => $pages->filter(array('ClassName' => 'TutorPage')), 'SupplementalInstructions' => $pages->filter(array('ClassName' => 'SupplementalInstruction')), 'HelpLabs' => $pages->filter(array('ClassName' => 'HelpLab')), 'Query' => $keyword, 'Title' => 'Search Results');
			$data = new ArrayData(
				array(
					'Tutors' => $tutors,
					'SupplementalInstructions' => $SupplementalInstructions,
					'HelpLabs' => $HelpLabs,
					'Query' => $keyword,
					'Title' => 'Search Results',
					'HasResults' => $resultsFound,
				)

			);

			return $data;
		}
	}
	public function getMemberHelpLabs() {
		$Member = Member::CurrentUser();
		if ($Member) {
			$IDMember = $Member->ID;

			//$memberLabs = DataObject::get('HelpLab', "HelpLab_Live.ID in (SELECT DISTINCT HelpLabID from  `HelpLab_Members` where MemberID = $IDMember)");
			$memberLabs = $Member->HelpLabs();
			if ($memberLabs) {
				return $memberLabs;
			}
		}
	}
}

