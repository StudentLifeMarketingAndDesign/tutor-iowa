<?php

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Security\Member;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormAction;
use SilverStripe\Control\Email\Email;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\Form;
use SilverStripe\Core\Config\Config;
use SilverStripe\Control\Session;
use SilverStripe\Control\Director;
use SilverStripe\SiteConfig\SiteConfig;

class RegistrationPage extends Page
{
    private static $db = array('Disabled' => 'Boolean');
    private static $has_one = array();
    
    private static $defaults = array('ProvideComments' => '1',);
    
    public function getCMSFields() {
        
        $fields = parent::getCMSFields();
        $fields->removeFieldFromTab("Root.Main", "Content");
        $fields->addFieldToTab('Root.Main', new CheckboxField("Disabled", "Disable the registration form (temporarily)"));
        $fields->addFieldToTab('Root.Main', new HTMLEditorField("Content", "Content"));
        return $fields;
    }
}

