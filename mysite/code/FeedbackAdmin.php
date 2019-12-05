<?php

use SilverStripe\Admin\ModelAdmin;
class FeedbackAdmin extends ModelAdmin {


  private static $managed_models = array('FeedbackItem'); 
  private static $url_segment = 'feedback';
  private static $menu_title = 'Feedback';
  // private static $menu_icon = 'themes/tutor/images/pencil.png';
  public $showImportForm = false; 
  


}