<?php

class MigrateTagsTask extends BuildTask {

	protected $title = 'Migrate Metakeywords to Tags';
	protected $description = 'Migrate tags entered in the MetaKeywords field to a field called "Tags" for Tutors and Help Labs.';

	protected $enabled = true;

	function run($request) {
		$tutors = TutorPage::get();
		$helpLabs = HelpLab::get();

		echo "<h2>Converting Tutors</h2>";
		$this->convertTags($tutors);

		echo "<h2>Converting Help Labs</h2>";
		$this->convertTags($helpLabs);

	}

	function convertTags($objectList) {
		foreach ($objectList as $object) {
			$object->Tags = $object->MetaKeywords;
			echo "<li>Converting " . $object->Title . " MetaKeywords to Tags ";
			$object->write();
			$object->writeToStage("Stage");
			if ($object->isPublished()) {
				echo "<strong>AND publishing</strong>";
				$object->doPublish();
				$object->writeToStage("Live");
			}
			echo ".</li>";

		}

	}

}