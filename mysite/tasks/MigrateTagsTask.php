<?php

class MigrateTagsTask extends BuildTask {

	protected $title = 'Migrate Metakeywords to Tags';
	protected $description = 'Migrate tags entered in the MetaKeywords field to a field called "Tags" for Help Labs ONLY';

	protected $enabled = true;

	function run($request) {
		//$supps = SupplementalInstruction::get();
		$helpLabs = HelpLab::get();

		//echo "<h2>Converting Supp Instructions</h2>";
		//$this->convertTags($supps);

		echo "<h2>Converting Help Labs</h2>";
		$this->convertTags($helpLabs);

		// echo "<h2>Cleaning up tutor tags</h2>";
		// $this->removeNamesFromTags($tutors);

	}

	function convertTags($objectList) {
		foreach ($objectList as $object) {
			$object->Tags = $object->MetaKeywords;
			echo "<li>Converting " . $object->Title . " MetaKeywords to Tags ";
			if ($object->ClassName == "TutorPage") {
				$object->EligibleToTutor = true;
				echo " Also making them eligible to tutor.";
			}
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

	function removeNamesFromTags($objectList) {
		foreach ($objectList as $object) {
			$tags = $object->Tags;
			$firstName = trim($object->FirstName);
			$lastName = trim($object->Surname);
			$title = $object->Title;

			//$stringtoRemove = $firstName.' '.$lastName.', ';

			$stringtoRemove = $title;

			echo "<li>Removing tags from " . $object->Title;
			//echo "<br />tags: ".$tags."<br />";
			echo " using filter " . $stringtoRemove;
			if (stristr($tags, $stringtoRemove)) {
				$tags = str_replace($stringtoRemove, ' ', $tags);
				print_r('<br /><strong>The first filter ' . $stringtoRemove . ' worked</strong>');
			}

			echo "<br />tags: " . $tags . "<br />";
			//All of this is case insensitive
			echo "<br />checking firstname: '" . $firstName . "'<br />";
			//print_r($tags);
			if (stristr($tags, $firstName)) {
				$tags = str_replace($firstName, '', $tags);
				print_r('look at these: ' . $tags);
				echo '<br />we found first name and removed it.';
				print_r('firstname' . $firstName);
			}

			if (stristr($tags, $lastName)) {
				$tags = str_replace($lastName, '', $tags);
				print_r('lastname' . $lastName);
			}

			$tags = ltrim($tags, ',');
			$tags = ltrim($tags, ' ,');
			$tags = ltrim($tags, ' , ');
			$tags = ltrim($tags, ';');
			$tags = ltrim($tags, ' ;');
			$tags = ltrim($tags, ' ; ');
			$tags = ltrim($tags, '-');
			$tags = ltrim($tags, ' -');
			$tags = ltrim($tags, '.');
			$tags = ltrim($tags, ' .');

			$tags = preg_replace('/,,+/', ',', $tags);
			$tags = preg_replace('/,  ,  ,+/', ',', $tags);
			$tags = preg_replace('/;+/', ',', $tags);

			//people to checkout (their tags) Alexander Starr ",  , , ,"

			//Eliminate any "hanging" commas or commas with whitespace in front of them.

			$object->Tags = $tags;

			$object->write();
			$object->writeToStage("Stage");
			if ($object->isPublished()) {
				echo "<strong>AND publishing</strong>";
				$object->doPublish();
				$object->writeToStage("Live");
			}
			echo ".</li><br /><br /><hr />";

		}

	}

}