<?php



//MemberDecorator is not used on the current site

class MemberDecorator extends DataExtension {
 	
 	
    //Add extra database fields
    public function extraStatics()
    {   
        return array(
            'belongs_many_many' => array(
             	'HelpLabs' => 'HelpLab',
             ),
        );
    }

}

class MemberDecorator_Controller extends Page_Controller { 
		
    
} 

