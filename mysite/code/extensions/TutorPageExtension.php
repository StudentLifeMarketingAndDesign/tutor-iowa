<?php
class TutorPageExtension extends DataExtension {

	public function onAfterUnpublish() {

		$adminEmail = Config::inst()->get('Email', 'admin_email');
		$subject = "Your Tutor Iowa page has been disabled";
		$body = "You can request your details be edited <a href='" . Director::absoluteBaseURL() . "edit-profile-page'>here</a/> ";

		$email = new Email();
		$email->setTo($this->owner->Bio);
		$email->setFrom($adminEmail);
		$email->setSubject($subject);
		$email->setBody($body);
		if (SS_ENVIRONMENT_TYPE == "live") {
			$email->send();
		}

	}

	public function onBeforeWrite() {
		if (!$this->owner->EligibleToTutor) {
			$tutorParent = TutorHolder::get()->filter(array('Title' => 'Ineligible Tutors'))->first();
		}
		if (isset($tutorParent->ID)) {
			$this->owner->setParent($tutorParent);
		}
	}

	public function onBeforeUnpublish() {
		$tutorParent = TutorHolder::get()->filter(array('Title' => 'Inactive Tutors'))->first();
		$this->owner->setParent($tutorParent);
		$this->owner->write();
	}

	public function onAfterPublish() {
		$adminEmail = Config::inst()->get('Email', 'admin_email');

		//$approved = $this->owner->Approved;

		$subject = "[Tutor Iowa] Approval confirmation";
		$body = "Congratulations, you have been approved as a tutor on Tutor Iowa. You now have full access to edit your profile. Please check out <a href='http://tutor.uiowa.edu/for-tutors'>For Tutors</a> to learn how to effectively utilize tags and efficiently use the website, or refer to the <a href='http://www.youtube.com/watch?v=oQyJIiGs7qU&feature=youtu.be'>Private Tutor Training video</a>.<br><br>
     	If you have any questions please email tutoriowa@uiowa.edu.<br><br>
     	Best,<br>
     	The Tutor Iowa Team";

		$emailHolder = EmailHolder::get()->first();
		$body = $emailHolder->RegistrationConfirm;

		$email = new Email();
		$email->setTo($this->owner->Email);
		$email->setFrom($adminEmail);
		$email->setSubject($subject);
		$email->setBody($body);

		if (SS_ENVIRONMENT_TYPE == "live") {
			//$email->send();
		}

	}

	public function onBeforePublish() {
		if ($this->owner->EligibleToTutor) {
			$tutorParent = TutorHolder::get()->filter(array('Title' => 'Private Tutors'))->first();
			$this->owner->setParent($tutorParent);
		}		
	}

}