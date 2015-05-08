<?php

class RemoveNameTagsTask extends BuildTask {

	protected $title = 'Remove First and Last Names and general cleanup of Tags';
	protected $description = 'Remove tags that contain tutors firstnames and lastnames, other cleanup things' ;

	protected $enabled = true;

	function run($request) {
		$tutors = TutorPage::get();
		

		echo "<h2>Converting Tutors</h2>";
		$this->removeNamesFromTags($tutors);

		

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
			echo " using filter ".$stringtoRemove;
			if(stristr($tags, $stringtoRemove)){
				$tags = str_replace($stringtoRemove, ' ', $tags);
				print_r('<br /><strong>The first filter '.$stringtoRemove.' worked</strong>');
			}

			echo "<br />tags: ".$tags."<br />";
			//All of this is case insensitive
			echo "<br />checking firstname: '".$firstName."'<br />";
			//print_r($tags);
			if(stristr($tags, $firstName)){
				$tags = str_replace($firstName, '', $tags);
				print_r('look at these: '.$tags);
				echo '<br />we found first name and removed it.';
				print_r('firstname'. $firstName);
			}

			if (stristr($tags, $lastName)) {
						$tags = str_replace($lastName, '', $tags);
						print_r('lastname'.$lastName);
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
			$tags = ltrim($tags,  ' .');

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