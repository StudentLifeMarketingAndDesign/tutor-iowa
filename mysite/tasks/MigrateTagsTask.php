<?php

class MigrateTagTasks extends BuildTask{

	protected $title = 'Migrate Metakeywords to Tags';
	protected $description = 'Migrate tags entered in the MetaKeywords field to a field called "Tags" for Tutors and Help Labs.';

	protected $enabled = true;

	function run($request){
		$tutors = TutorPage::get();
		$helpLabs = HelpLab::get();

		foreach($tutors as $tutor){
			$tutor->Tags = $tutor->MetaKeywords;
			echo "<li>Converting ".$tutor->Title." MetaKeywords to Tags.</li>";
			$tutor->write();
			if($tutor->isPublished()){
				$tutor->doPublish();
			}

		}




	}

}