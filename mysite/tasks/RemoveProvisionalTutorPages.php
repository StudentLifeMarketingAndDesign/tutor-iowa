<?php
class RemoveProvisionalTutorPages extends BuildTask {
 
    protected $title = 'Delete Provisional Tutor Pages if created before June 2017';
 
    protected $description = '';
 
    protected $enabled = true;
 
    function run($request) {
        $tutorParent = TutorHolder::get()->filter(array('Title' => 'Provisional Tutors'))->first();
        $tutors = TutorPage::get()->filter(array('ParentID' => $tutorParent->ID, 'Created:LessThan' => '2017-06-01'));

        foreach($tutors as $tutor){
            echo '<li>'.$tutor->Title.' '.$tutor->Created.'</li>';
            $tutor->delete();            
        }
    }
}