<?php
class ArticleHolder extends Page {
    static $allowed_children = array('ArticlePage');
    
    static $defaults = array ('ProvideComments' => '1',
    
   
    
    );
}
class ArticleHolder_Controller extends Page_Controller {
}