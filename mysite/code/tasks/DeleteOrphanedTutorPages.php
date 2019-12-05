<?php

use SilverStripe\Security\Member;
use SilverStripe\Dev\BuildTask;
class DeleteOrphanedTutorPages extends BuildTask {
 
    protected $title = 'Delete Tutor Pages if their member no longer exists';
 
    protected $description = '';
 
    protected $enabled = false;
 
    function run($request) {
        $tutors = TutorPage::get();
        echo '<ul>';
        foreach($tutors as $tutor){

            $memberID = $tutor->MemberID;
            if((isset($memberID)) && ($memberID > 0)){
                $memberTest = Member::get()->filter(array('ID' => $memberID))->First();
                if(!$memberTest){
                    echo '<li> Tutor '.$tutor->FirstName.' '.$tutor->Surname.' - '.$tutor->ID.' is orphaned</li>';
                }
            }
            
        }
        echo '</ul>';
    }
}