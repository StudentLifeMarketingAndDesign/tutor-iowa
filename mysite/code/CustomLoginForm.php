<?php

class CustomLoginForm extends MemberLoginForm 
{
    public function dologin($data) {
        if($this->performLogin($data)) {
        
        			$member = Member::currentUser();
        
        			$tutorPage = DataObject::get_one("TutorPage","MemberID = '".$member->ID."'");
        			
        			//print_r($tutorPage);
        			
        			
        	
        			
        			if($tutorPage){
        				if(Permission::check("ADMIN")){
	        				Director::redirect("admin/");
	        			}else{
        			
			        		Director::redirect($tutorPage->Link());
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