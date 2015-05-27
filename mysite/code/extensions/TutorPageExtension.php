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

	function onBeforeUnpublish() {
		$this->changeParentUnpublish();
	}

	public function changeParentUnpublish() {

		$tutorParent = TutorHolder::get()->filter(array('Title' => 'Inactive Tutors'))->first();
		$this->owner->setParent($tutorParent);
		$this->owner->write();

	}

}