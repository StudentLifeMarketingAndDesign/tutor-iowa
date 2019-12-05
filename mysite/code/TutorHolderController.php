<?php

class TutorHolderController extends PageController {
	public function init() {
		$url = $this->URLSegment;
		if($url == 'provisional-tutors' || $url == 'inactive-tutors'){
			$this->redirect('private-tutors');
		}
		// RSSFeed::linkToFeed($this->Link() . "rss");
		 parent::init();
	}
}
