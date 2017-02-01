<?php

class CreateTagsTask extends BuildTask{

    protected $title = 'Create new tag DataObjects';
    protected $description = 'Pulls out the tag field of objects, splits the tags string by comma, and attempts to create a new Tag DataObject';

    protected $enabled = true;

    function run($request){
    	//get all dataobjects from site tree and put in array
        $pages = SiteTree::get();
    	foreach ($pages as $page) {
            echo "<br />Page: " . $page;
    		
            if ($page->Tags){
                $tags = $page->Tags;
                echo "<br />Page tags (string): " . $tags;
                $titles = explode(",", $tags);
                echo "<br />The first tag for this page is: " . $titles[0];
                // makeTags($titles);
                foreach($titles as $title){
                    $tagTest = Tag::get()->filter(array('Title' => $title))->First();
                    if (!$tagTest) {
                        echo "<li>test passed";
                        $t = new Tag();
                        $t->Title = $title;
                        $t->write();
                    }
                    else{
                        $t = Tag::get()->filter(array('Title' => $title));
                        $t->write();
                    }
                }
            }
    	}

    }

}