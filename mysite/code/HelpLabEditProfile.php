<?php
class HelpLabEditProfile extends Page {
  static $db = array(
   "TempID" => "Text"
   );
  static $has_one = array(
   );

  static $defaults = array ('ProvideComments' => '1',
    
   
    
    );
    
  
  
}

 
class HelpLabEditProfile_Controller extends Page_Controller {

	public function init() {
		parent::init();
		if ($this->getLabID()){
			$temp = $this->getLabID();
			Session::set("LabID", $temp);
		}
	}	

	function HelpEditProfileForm(){
	   $fields = new FieldSet (
		  	new TextareaField('Description'),
		    new Textareafield('MetaKeywords', 'Tags'),
		    new TextField('Location'),
		    new TextField('Link'),
		    new TextField('PhoneNo', 'Phone Number'),
		    new TextField('Hours', 'Availability')
		       );
		        
		    
		    
		  
		     
		    $actions = new FieldSet(
	        new FormAction('HelpLabSaveProfile', 'Save Page')
	         );
	            
	        $form = new Form($this, 'HelpEditProfileForm', $fields, $actions);
	            
	        $HelpLabID = Session::get("LabID");
	            
	        $DisplayedHelpLab = DataObject::get_one("HelpLab", "HelpLab_Live.ID = $HelpLabID");
	            
	        $form->loadDataFrom($DisplayedHelpLab->data());

	        return $form;
   }
   
   function HelpLabSaveProfile($data, $form){
    
    	    	
	     $labID = Session::get("LabID");
	   
	     $MemberLab = DataObject::get_one('HelpLab', "HelpLab_Live.ID=$labID");
    	 
    	 //return Debug::show($MemberLab);
    	 
    	 $form->saveInto($MemberLab); 
    	 
    	 $MemberLab->writeToStage("Stage");
               
         $MemberLab->publish("Stage","Live");
                    
         return Director::redirect($this->Link('?saved=1'));  
   }

       
    function getLabID()
    {
        $temp = $this->request->getVar('ID');
        if ($temp){
        	return Convert::raw2sql($temp); //This sanitizes the database input
        }
    }
    
    function Saved()
    {
        return $this->request->getVar('saved');
    }

}


