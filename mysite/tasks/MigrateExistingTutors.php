<?php
class MigrateExistingTutors extends BuildTask {
 
    protected $title = 'Migrate tutor information';
 
    protected $description = 'Migrate tutor page information to associated member page and remove tutor page';
 
    protected $enabled = true;
 
    function run($request) {
        $tutors = TutorPage::get()->Sort('Title', 'ASC');
        foreach ($tutors as $tutor){
            $member = Member::get()->filter(array('Email' => $tutor->Email))->first();
            echo '<li>'.$tutor->Title.' '.$member->Email.'</li>';

            $member->Bio = $tutor->Bio;
            $member->PhoneNo = $tutor->PhoneNo;
            $member->Hours = $tutor->Hours;
            $member->FirstName = $tutor->FirstName;
            $member->Surname = $tutor->Surname;
            $member->StartDate = $tutor->StartDate;
            $member->EndDate = $tutor->EndDate;
            $member->Notes = $tutor->Notes;
            $member->HourlyRate = $tutor->HourlyRate;
            $member->MeetingPreference = $tutor->MeetingPreference;
            $member->AcademicStatus = $tutor->AcademicStatus;
            $member->UniversityID = $tutor->UniversityID;
            $member->Major = $tutor->Major;
            // echo '<li>'.$member->Major.'</li>';
            $member->GPA = $tutor->GPA;
            $member->EligibleToTutor = $tutor->EligibleToTutor;
            $member->ApprovalStatus = $tutor->ApprovalStatus;
            // // echo '<li>'.$member->ApprovalStatus.'</li>';
            $member->WhatToExpect = $tutor->WhatToExpect;
            $member->HowToPrepare = $tutor->HowToPrepare;

            //write information to database
            $member->write();
            //delete associated tutor page
            $tutor->delete();
        }

        
    }
}