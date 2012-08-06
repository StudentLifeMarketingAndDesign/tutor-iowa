<?php
class TutorPagePublish extends SiteTreeDecorator { 

   static $allowed_actions = array(
        'onAfterUnpublish',
        'unpublish'
    );
     

	function extraStatics() { 
	   return array( 
	           
	 
	); 
	}
	
	
}

class TutorPagePublish_Controller extends Page_Controller { 
	/*
	function onBeforeUnpublish(){
		if ($this->Approved == 0){
		   $this->Approved = 1;
		}
		else {
			$this->Approved = 0;
		}
			    
	    	   
	}
	*/
}