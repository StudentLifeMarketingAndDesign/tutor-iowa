<?php
class TutorPageExtension extends DataExtension {


	public function onBeforeWrite() {
		if (!$this->owner->EligibleToTutor) {
			$tutorParent = TutorHolder::get()->filter(array('Title' => 'Ineligible Tutors'))->first();
		}
		if (isset($tutorParent->ID)) {
			$this->owner->setParent($tutorParent);
		}

		if($this->owner->URLSegment != $this->owner->ID){
			$this->owner->URLSegment = $this->owner->ID;
		}
	}

	public function onBeforeUnpublish() {
		$tutorParent = TutorHolder::get()->filter(array('Title' => 'Inactive Tutors'))->first();
		$this->owner->setParent($tutorParent);
		$this->owner->write();
	}

	public function onBeforePublish() {
		if ($this->owner->EligibleToTutor) {
			$tutorParent = TutorHolder::get()->filter(array('Title' => 'Private Tutors'))->first();
			$this->owner->setParent($tutorParent);
		}		
	}

}