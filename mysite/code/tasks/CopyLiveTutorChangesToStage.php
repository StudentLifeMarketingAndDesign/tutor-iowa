<?php
class CopyLiveTutorChangesToStage extends BuildTask {
 
    protected $title = 'Copy Live Tutor Changes To Stage/Draft';
 
    protected $description = 'Prevents reversion of tutor changes when they are unpublished';
 
    protected $enabled = false;
 
    function run($request) {
        $tutors = Versioned::get_by_stage('TutorPage', 'Live');
        echo '<h2>Looping through all live tutors</h2>';
        echo '<ul>';
        foreach($tutors as $tutor){
        	echo '<li>Working on tutor <strong>'.$tutor->Title.'</strong> and reverse publishing from live to stage</li>';
        	$tutor->publish("Live", "Stage");
        	$tutor->write();
        }
        echo '</ul>';
    }
}