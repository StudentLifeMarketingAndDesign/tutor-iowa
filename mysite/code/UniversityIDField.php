<?php

use SilverStripe\Control\Session;
use SilverStripe\Forms\TextField;

class UniversityIDField extends TextField 
{ 

   //adds 'text' class for display purposes on front-end -- not sure why SilverStripe is making me do this 
   protected $extraClasses = array('text');
   
   function validate($validator){ 
      parent::validate($validator);
      if(!empty ($this->value)){ 
      
        $testValue = $this->value;
        $LenTestValue = strlen($testValue);
        if ($LenTestValue != 8){
        	
        	Session::set('Saved', 0);
        	
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