<?php
class EmailHolder extends Page {

   private static $db = array(
   'RegistrationRequest' => 'HTMLText',
   'RegistrationConfirm' => 'HTMLText',
   //'RequestTutor' => 'Text',
   'DisablePage' => 'HTMLText',
   'EnablePage' => 'HTMLText'
   
   );

    private static $allowed_children = array();
    
    private static $defaults = array (
    
   
    
    );
    
    public function getCMSFields() 
    {
    	$fields = parent::getCMSFields();
    	
    	$fields->removeFieldFromTab('Root.Metadata', "Keywords"); 
        $fields->removeFieldFromTab('Root.Main', "Content");
        $fields->addFieldToTab( 'Root.Main', new HTMLEditorField("RegistrationRequest", "Edit the registration request here"));
        $fields->addFieldToTab( 'Root.CMain', new HTMLEditorField("RegistrationConfirm", "Edit the registration confirmation email here"));
       // $fields->addFieldToTab( 'Root.Content.Main', new HTMLEditorField("RequestTutor", "Edit the email that goes out to request a tutor here"));
        $fields->addFieldToTab( 'Root.Main', new HTMLEditorField("DisablePage", "Edit the email a user gets when they request to disable their page here"));
        $fields->addFieldToTab( 'Root.Main', new HTMLEditorField("EnablePage", "Edit the email a user gets when they request to enable their page here"));
    	
    	return $fields;
    }

}
class EmailHolder_Controller extends Page_Controller {

}