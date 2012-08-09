<?php

class UniversityIDField extends TextField 
{ 
   function validate($validator){ 
      parent::validate($validator);
      if(!empty ($this->value)){ 
      
        $testValue = $this->value;
        $LenTestValue = strlen($testValue);
        if ($LenTestValue != 8){
        	
        	Session::set('Saved', false);
        	
	        $validator->validationError( 
               $this->name, 
               "University ID must be eight digits", 
               "validation", 
               false 
               ); 
            
	        
        }
        else {
	        return true;
        }
      }
      else {
	       return true;    
	  }  
   } 
}