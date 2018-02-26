<?php

class ResaveTutorPageTask extends BuildTask{

	protected $title = 'Save (and optionally publish) all tutor pages';
	protected $description = 'Resaves all tutor pages if there needs to be something ran onbeforeWrite()';

	protected $enabled = true;

	public function run($request){
		echo '<p>Gathering all pages..</p>';
		$pages = TutorPage::get();
		echo '<ul>';

		foreach($pages as $page){
			echo '<li>Writing page '.$page->Title.'...';
			$page->write();
			if($page->isPublished()){
				echo '<strong>And publishing</strong>';
				$page->publish('Stage', 'Live');
			}
			echo '</li>';
		}
					
		echo '</ul>';
		echo '<p>Done.</p>';

	}

}