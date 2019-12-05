<?php

use SilverStripe\Admin\ModelAdmin;
class MessageAdmin extends ModelAdmin {


  private static $managed_models = array('Message'); 
  private static $url_segment = 'messages';
  private static $menu_title = 'Messages';
  // private static $menu_icon = 'themes/tutor/images/pencil.png';
  public $showImportForm = false; 
  


}
