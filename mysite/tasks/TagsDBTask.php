<?php

class TagsDBTask extends BuildTask {

	protected $title = 'Build TagsCollection Database';
	protected $description = 'Create TagsCollection Database based of popular searches';

	protected $enabled = true;
	protected $Limit = 1000;


	function run($request) {


		/*
			
			[1] :
				[Title] : Chem
				[Count] : 45
			

		*/

		// $searchTerms = SearchTerm::get()->map('Title');
		// $searchTerms = $searchTerms->values();
		$currTags = TagsCollection::get()->map('Title');
		$currTags = $currTags->values();
		// $collection = $this->getTagsCollection()->map('Title');

		$searchTerms = SearchTerm::get()->toNestedArray();
		$collection = $this->getTagsCollection()->toNestedArray();
		//print_r($searchTerms);
		//print_r($searchTerms[0]['Title']);
		//print_r($collection);

		$popularTags = array_intersect($searchTerms, $collection);

			foreach ($popularTags as $popularTag) {
				if (!in_array($popularTag, $currTags)){

					$tagHolder = new TagsCollection();
					$tagHolder->Title = $popularTag;
					// $tagHolder->Count = $this->mergeCount($searchTerms, $collection);
					$tagHolder->write();
				}
			}
		}

	private function mergeCount($popularTag){
		
		$filter1 = SearchTerm::get()->map('Title');
		$filter2 = $this->getTagsCollection()->map('Title');
		print_r($filter1);
		print_r($filter2);
		$count1 = $filter1->SearchCount;
		$count2 = $filter2->Count;
	

		$finalCount = $count1 + $count2;

		return $finalCount;


	}
	

}