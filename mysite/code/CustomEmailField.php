<?php 
class CustomEmailField extends EmailField 
{ 
   function validate($validator){ 
      parent::validate($validator); //I have verified this still takes care of the standard valid email checking
              
      if(!empty ($this->value)){ 
      
        $testValue = $this->value;
        $testArray = explode('@', $testValue);
        if (isset($testArray[1])){
	        $afterAt = $testArray[1];
	        $afterAt = substr($afterAt, 0, 9);
	        
	           Session::set('Saved', false);
	        
	        if ($afterAt != "uiowa.edu"){
	         $validator->validationError( 
               $this->name, 
               "You must enter your UIowa email address (it should end @uiowa.edu)", 
               "validation", 
               false 
               ); 
	        }
        }
        else {
        	Session::set('Saved', false);
        	   
	        $validator->validationError( 
               $this->name, 
               "Email must have an @ symbol present to be valid.", 
               "validation", 
               false 
            ); 
        }
        /*
         if(!preg_match("/$val\-\d{4}/", $this->value)){ 
            $validator->validationError( 
               $this->name, 
               "This is not a valid license key", 
               "validation", 
               false 
            ); 
            return false; 
         } */
      } 
      return true; 
   } 
}