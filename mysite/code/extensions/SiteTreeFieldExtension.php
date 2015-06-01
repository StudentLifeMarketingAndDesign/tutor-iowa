<?php

class SiteTreeFieldExtension extends DataExtension {

	private static $db = array(
		'MetaKeywords' => 'Text',
		'Tags' => 'Text',
	);

	public function SplitKeywords() {
		$tags = preg_split("/\s*,\s*/", trim($this->owner->Tags));
		$results = array();
		foreach ($tags as $tag) {
			if ($tag) {
				$results[mb_strtolower($tag)] = $tag;
			}

		}
		return $results;
	}

}