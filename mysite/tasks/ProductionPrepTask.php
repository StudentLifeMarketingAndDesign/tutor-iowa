<?php

use SilverStripe\CMS\Model\RedirectorPage;
use SilverStripe\Dev\BuildTask;

class ProductionPrepTask extends BuildTask {

	protected $title = 'Production Prep Task';
	protected $description = 'Add HelpLabHolder and SuppHolder to Find Help Page';

	protected $enabled = true;

	function run($request) {
		$suppHolder = SuppHolder::get()->First();
		$helpLabs = HelpHolder::get()->First();
		$findHelp = FindHelpPage::get()->First();
		$feedbackPage = FeedbackPage::get()->First();


		if(!RedirectorPage::get()->filter(array('Title' => 'Private Tutors'))->First()){
			$privateTutorsRedirect = new RedirectorPage();
			echo "<h2>Adding Private Tutor Redirect to Find Help Page</h2>";
			$privateTutorsRedirect->ParentID = 61;
			$privateTutorsRedirect->Title = "Private Tutors";
			$privateTutorsRedirect->LinkToID = 15;
			$privateTutorsRedirect->doPublish();
		}

		echo "<h2>Adding Supplement holder to Find Help Page</h2>";
		$suppHolder->ParentID = 61;
		$suppHolder->doPublish();



		echo "<h2>Adding Help Lab Holder to Find Help Page</h2>";
		$helpLabs->ParentID = 61;
		$helpLabs->doPublish();		
		
		$feedbackPage->ShowInMenus = 0;
		$feedbackPage->doPublish();

		$helpLabs->ShowInMenus = 1;
		$helpLabs->doPublish();

		$suppHolder->ShowInMenus = 1;
		$suppHolder->doPublish();

		if(!RedirectorPage::get()->filter(array('Title' => 'Search Tutor Iowa'))->First()){
				echo "<h2>Adding Search Tutor Iowa Redirect to Find Help Page</h2>";
				$searchTutorRedirect = new RedirectorPage();
				$searchTutorRedirect->ParentID = 61;
				$searchTutorRedirect->Title = "Search Tutor Iowa";
				$searchTutorRedirect->RedirectionType = 'External';
				$searchTutorRedirect->ExternalURL = "http://tutor.uiowa.edu/home/SearchForm";
				$searchTutorRedirect->doPublish();
		}
		


		echo "<h2>Removed any pages with New Page as the title</h2>";
		$newPage = Page::get()->filter(array('Title' => 'New Page'))->First();
		if($newPage){
			$newPage->delete();
		}



		echo "<h2>Create Ineligible Tutors Holder</h2>";
		$this->createIneligibleHolder();
	}



	function createIneligibleHolder(){
		if(!TutorHolder::get()->filter(array('Title' => 'Ineligible Tutors'))->First()){
			$newPage = new TutorHolder();
			$newPage->Title ="Ineligible Tutors";
			$newPage->ShowInMenus = 0;
			$newPage->write();		
			$newPage->doPublish();
			$newPage->writeToStage("Live");
		}
	}

	
	

}