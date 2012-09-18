<?php
class EmailHolder extends Page {

   static $db = array(
   'RegistrationRequest' => 'Text',
   'RegistrationConfirm' => 'Text',
   'RequestTutor' => 'Text',
   'DisablePage' => 'Text',
   'EnablePage' => 'Text'
   
   );

    static $allowed_children = array();
    
    static $defaults = array (
    
   
    
    );
    
    public function getCMSFields() 
    {
    	$fields = parent::getCMSFields();
    	
    	$fields->removeFieldFromTab('Root.Content.Metadata', "Keywords"); 
        $fields->removeFieldFromTab('Root.Content.Main', "Content");
        $fields->addFieldToTab( 'Root.Content.Main', new TextAreaField("RegistrationRequest", "Edit the registration request here"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextAreaField("RegistrationConfirm", "Edit the registration confirmation email here"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextAreaField("RequestTutor", "Edit the email that goes out to request a tutor here"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextAreaField("DisablePage", "Edit the email a user gets when they request to disable their page here"));
        $fields->addFieldToTab( 'Root.Content.Main', new TextAreaField("EnablePage", "Edit the email a user gets when they request to enable their page here"));
    	
    	return $fields;
    }

}
class EmailHolder_Controller extends Page_Controller {

}