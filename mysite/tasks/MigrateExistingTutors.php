<?php
class MigrateExistingTutors extends BuildTask {
 
    protected $title = 'Migrate tutor information';
 
    protected $description = 'Migrate tutor page information to associated member page and remove tutor page';
 
    protected $enabled = true;
 
    function run($request) {
        $tutors = TutorPage::get();
        foreach ($tutors as $tutor){
            $memberPage = $tutor->Member();
            echo '<li>'.$tutor->Title.' '.$memberPage->Title.'</li>';

            $memberPage->Bio = $tutor->Bio;
            $memberPage->PhoneNo = $tutor->PhoneNo;
            $memberPage->Hours = $tutor->Hours;
            $memberPage->FirstName = $tutor->FirstName;
            $memberPage->Surname = $tutor->Surname;
            $memberPage->StartDate = $tutor->StartDate;
            $memberPage->EndDate = $tutor->EndDate;
            $memberPage->Notes = $tutor->Notes;
            $memberPage->HourlyRate = $tutor->HourlyRate;
            $memberPage->MeetingPreference = $tutor->MeetingPreference;
            $memberPage->AcademicStatus = $tutor->AcademicStatus;
            $memberPage->UniversityID = $tutor->UniversityID;
            $memberPage->Major = $tutor->Major;
            $memberPage->GPA = $tutor->GPA;
            $memberPage->EligibleToTutor = $tutor->EligibleToTutor;
            $memberPage->ApprovalStatus = $tutor->ApprovalStatus;
            // echo '<li>'.$memberPage->ApprovalStatus.'</li>';
            $memberPage->WhatToExpect = $tutor->WhatToExpect;
            $memberPage->HowToPrepare = $tutor->HowToPrepare;
            $memberPage->Status = $tutor->ApprovalStatus;

            $memberPage->Messages = $tutor->Messages;
            $memberPage->FeedbackItems = $tutor->FeedbackItems;
            
            $memberPage->AcademicHelp = $tutor->AcademicHelp;
            $memberPage->HomePage = $tutor->HomePage;
            // $tutor->delete();

        }

        
    }
}