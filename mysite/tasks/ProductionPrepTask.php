<?php

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

		echo "<h2>Removed any pages with New Page as the title</h2>";
		$newPage = Page::get()->filter(array('Title' => 'New Page'))->First();
		if($newPage){
			$newPage->delete();
		}


	}

	
	

}