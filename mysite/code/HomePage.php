<?php
/**
 * Defines the HomePage page type
 */
 
class HomePage extends Page {
   static $db = array(
   );
 
   static $defaults = array ('ProvideComments' => '1'
   );  
   static $has_one = array ('MainImage' => 'Image');
    
    public function getCMSFields() 
    {
    $fields = parent::getCMSFields();

    $fields->addFieldToTab('Root.Content.Main', new ImageField('MainImage', 'Main Image'));
    
    return $fields;
    }
}
 
class HomePage_Controller extends Page_Controller {
     function LatestNews($num=5) {
	     $news = DataObject::get_one("ArticleHolder");
	     return ($news) ? DataObject::get("ArticlePage", "ParentID = $news->ID", "Date DESC", "", $num) : false;
	  }
	 
	 public function rss() {
		 $rss = new RSSFeed($this->Children(), $this->Link(), "Tutor news");
		 $rss->outputToBrowser();
     }
     
     public function init() {
	     RSSFeed::linkToFeed($this->Link() . "rss");    
	     parent::init();
	 }
	 
	 
}