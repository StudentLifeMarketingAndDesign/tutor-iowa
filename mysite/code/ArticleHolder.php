<?php
class ArticleHolder extends Page {
    public static $allowed_children = array('ArticlePage');
    
    public static $defaults = array ('ProvideComments' => '1',
    
   
    
    );
}
class ArticleHolder_Controller extends Page_Controller {
}