<?php 
use SilverStripe\Security\Member;
use SilverStripe\Control\Session;
use SilverStripe\Versioned\Versioned;
use SilverStripe\Security\Permission;
use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\Security\MemberAuthenticator\MemberLoginForm;

class CustomLoginForm extends MemberLoginForm {
        
    public function dologin($data) {
        
        if($this->performLogin($data)) {
        
        			$member = Member::currentUser();
        			
        			Session::clear('Saved'); 
        			
        			Versioned::reading_stage('Live');
        			//$tutorPage = DataObject::get_one("TutorPage","MemberID = '".$member->ID."'");
        			$tutorPage = TutorPage::get()->filter(array('MemberID' => '$member->ID'))->First();
        			//print_r($tutorPage);
        			
        			if($tutorPage){
            			
        				if(Permission::check("ADMIN")){
	        				 Controller::curr()->redirect("admin/");
	        			}else{
		        			if ($tutorPage){
                                Controller::curr()->redirect($tutorPage->Link());
			        		}
			        		else {
				        		 Controller::curr()->redirect(Director::getAbsoluteBaseURL());
			        		}
			        	}
	        		
        			}else{
        				if(Permission::check("ADMIN")){
	        				 Controller::curr()->redirect("admin/");
	        			}else{
	        			       			
		        			 Controller::curr()->redirect(Director::baseURL());
		        		}
                   }
        } else {
            if($badLoginURL = Session::get("BadLoginURL")) {
                Director::redirect($badLoginURL);
            } else {
                Controller::curr()->redirectBack();
            }
        }      
    }
}
