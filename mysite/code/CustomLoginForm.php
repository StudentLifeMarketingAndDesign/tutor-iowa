<?php

class CustomLoginForm extends MemberLoginForm 
{
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
	        				Director::redirect("admin/");
	        			}else{
		        			if ($tutorPage){
		        				
			        			Director::redirect($tutorPage->Link());
			        		}
			        		else {
				        		Director::redirect(Director::getAbsoluteBaseURL());
			        		}
			        	}
	        		
        			}else{
        			
        				if(Permission::check("ADMIN")){
	        				Director::redirect("admin/");
	        			}else{
	        			       			
		        			Director::redirect(Director::baseURL());
		        		}
                   }
        } else {
            if($badLoginURL = Session::get("BadLoginURL")) {
                Director::redirect($badLoginURL);
            } else {
                Director::redirectBack();
            }
        }      
    }
}

?>