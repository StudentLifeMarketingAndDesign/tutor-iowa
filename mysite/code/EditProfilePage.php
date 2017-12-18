<?php
/**
 * Defines the EditProfilePage page type
 */

class EditProfilePage extends Page {
	private static $db = array(
		'Test' => 'Text',
	);
	private static $has_one = array(

	);

	private static $defaults = array('ProvideComments' => '1',

	);

	function getSavedSession() {
		$returning = '' . Session::get('Saved');
		return $returning;
	}

}

class EditProfilePage_Controller extends Page_Controller {
	public static $allowed_actions = array(
		'EditProfileForm',
		'getSavedSession',
	);

	public function init(){
		$Member = Member::CurrentUser();
		if($Member){

			if($Member->ApprovalStatus = "Active"){
			 parent::init();
			 $this->redirect('private-tutors/'.$Member->URLSegment.'/edit');
			}
			else{
				parent::init();
			}
		}
		else{
			parent::init();
			$this->redirect('');
		}
		

	}

	function EditProfileForm() {
		$Member = Member::CurrentUser();

		//chromephp::log('EditProfileForm start' . Session::get('saved'));

		if ($Member) {
			//User shouldn't be able to access EditProfileForm unless they're logged in.  If they're not logged in, provide links so that they can login (or register if need be).

			// $IDMember = $Member->ID;

			// $Tutor = TutorPage::get()->filter(array('MemberID' => $IDMember))->first();

			$tagField = new TutorTagField('Tags', 'Tags (separate each tag with a comma and a space, example: Chemistry, Biochemistry)');
			$tagField->setTagTopicClass("SiteTree");

			$tagsLabel = '<p>Read the <a href="for-tutors/">For Tutors page</a> to learn more about tags and promoting yourself on Tutor Iowa!</p>';
			$changePassLabel = '<p><a href="Security/ChangePassword" class="button small radius">Reset your password</a></p>';
			$fields = new FieldList(
				new TextField('FirstName', '<span>*</span> First Name'),
				new TextField('Surname', '<span>*</span> Last Name'),
				//new UploadField("Image", "Choose a photo of yourself"),
				//new UploadField("BackgroundImage", "Choose a background image (the wider, the better.)"),
				new EmailField('Email', '<span>*</span> Email Address'),
				new LiteralField('ChangePassword', $changePassLabel),
				new TextareaField('Content', 'Biography'),
				new TextareaField('Hours', 'Availability'),
				new DateField('StartDate', 'Date you would like to start tutoring'),
				new DateField('EndDate', 'Date you expect to stop tutoring'),
				new TextField('PhoneNo', 'Phone number'),
				new TextField('MeetingPreference', 'Meeting preference (on and/or off-campus)'),
				new TextField('HourlyRate', 'Hourly rate'),
				new TextField('AcademicStatus', 'Status (undergrad, grad, faculty, staff)'),
				new TextField('GPA'),
				new UniversityIDField('UniversityID', 'University ID'),
				new TextField('Major'),
				new LiteralField('TagsHelpLabel', $tagsLabel),
				$tagField
				,

				//This does not sync with database (database field is 'Disabled')
				new CheckboxField('Disable', 'Request to disable your page (will no longer be returned as a search result on TutorIowa)')

			);
			$saveAction = new FormAction('SaveProfile', 'Save');
			$saveAction->addExtraClass('radius');
			// Create action
			$actions = new FieldList(
				$saveAction
			);

			// Create action
			$validator = new RequiredFields('FirstName', 'Surname', 'Email');

			//Create form
			$Form = new FoundationForm($this, 'EditProfileForm', $fields, $actions, $validator);

			//Get current member
			$Member = Member::CurrentUser();

			//Get tutor dataobject to populate form with tutor info (stuff like bio that's stored in tutor table)

			//Information must be loaded from both tutor and member because member stores a member/tutor's password
			$Form->loadDataFrom($Member->data());

			///$Check if user is published yet,
			if ($Member->ApprovalStatus == 'Active') { //($Tutor instanceof TutorPage)
				//Member is a published tutor
				$Form->loadDataFrom($Member->data());
			} else {
				//Not published (disabled and unapproved users).  The enable function is at at the bottom and handles sending the emails

				return 'You must be confirmed as a user by our administrator to edit your profile.  If you have disabled your account, please click <a href="' . Director::baseURL() . $this->URLSegment . '?enable=1' . '">here</a> to have your account re-enabled.';
			}

			//Return the form
			return $Form;
		} else {
			//Shouldn't happen with current design unless user tries to navigate there directly (there is no link to edit profile when you're not logged in)
			$message = "<a href='Security/login'>You must be logged in to edit your profile. </a>  If you do not have an account,  <a href='registration-page'>register here.</a>";
			return $message;
		}
	}

	//Save profile
	function SaveProfile($data, $form) {
		Session::clear('Saved');
		//chromephp::log('Enters save profile');

		//Check for a logged in member
		if ($CurrentMember = Member::CurrentUser()) {

			//chromephp::log('Current member entered');

			//Check for another member with the same email address

			$email = Convert::raw2sql($data['Email']);

			if ($member = DataObject::get_one("Member", "Email = '" . Convert::raw2sql($data['Email']) . "' AND ID != " . $CurrentMember->ID)) {

				Session::set('Saved', 0); //Display error message
				//chromephp::log('After Email error ' . Session::get('saved'));

				$form->addErrorMessage("Email", 'Sorry, an account with that Email address already exists', "bad");

				Session::set("FormInfo.Form_EditProfileForm.data", $data);

				return $this->redirect($this->Link());

			}
			//Otherwise check that user IDs match and save
			else {

				Session::set('Saved', 1); //Changes saved
				//chromephp::log('After successful validation ');
				//chromephp::log(Session::get('Saved'));
				//chromephp::log(Session::get_all());

				// $IDMember = $CurrentMember->ID;

				// $Tutor = TutorPage::get()->filter(array('MemberID' => $IDMember))->first();

				$form->saveInto($Member);

				/*Preserve this code, for it works the magic of SilverStripe 3 publishing*/
				Versioned::reading_stage('stage');
				$Member->writeToStage('Stage');
				$Member->publish("Stage", "Live");
				Versioned::reading_stage('Live');
				$Member->write();

				// Save into the member dataobject.
				$memberFieldList = array(
					"FirstName",
					"Surname",
					"Email",
				);
				$form->saveInto($CurrentMember, $memberFieldList);

				$CurrentMember->write();

				$formData = $form->getData();
				$formDisabled = $formData['Disable'];

				if ($formDisabled) {
					//If user checked disable page box

					if ($DisablePage = DisablePage::get()->First()) //$DisablePage = DataObject::get_one('DisablePage'))
					{

						$parameter = '?ID=' . $Tutor->ID;

						return $this->redirect($DisablePage->Link($parameter));
					}

				}
				$ID = 92;
				//$test = DataObject::get_by_id('TutorPage', $ID);
				// $test = TutorPage::get()->byID($ID);
				/*
				$notSaved = Session::get('ValidationError');
				Debug::show($notSaved);

				if ($notSaved){
				$form->addErrorMessage("Name", 'An error occurred with one or more fields.', "bad");
				Session::set('ValidationError', false);
				Session::set("FormInfo.Form_EditProfileForm.data", $data);
				return Director::redirect($this->Link());
				}
				 */

				//$savedValue = Session::get('Saved');
				//print_r('Saved ' . $savedValue);
				//user_error("breakpoint", E_USER_ERROR);

				return $this->redirect($this->Link());
			}
		}
		//If not logged in then return a permission error
		else {
			return Security::PermissionFailure($this->controller, 'You must <a href="register">registered</a> and logged in to edit your profile:');
		}

	}

	//Check for just saved

	function Saved() {
		$saved = Session::get('Saved');
		//chromephp::log('When Saved gets called ');
		//chromephp::log($saved);
		if ($saved == 1) {
			return true;
		} else {
			return false;
		}

	}

	//Check if there was error while saving
	function notSaved() {
		$saved = Session::get('Saved');
		//chromephp::log('When notSaved gets called ');
		//chromephp::log($saved);
		if ($saved === 0) {
			return true;
		} else {
			return false;
		}
	}

	public function ClearSession() {
		Session::clear('Saved');
	}

	//Check if user succesfully registered (they are redirected to this page from RegistrationPage.php if registration was successful)
	function Success() {
		return $this->request->getVar('success');
	}

	function Enable() {
		$adminEmail = Config::inst()->get('Email', 'admin_email');

		if ($this->request->getVar('enable') == 1) {

			$CurrentMember = Member::CurrentUser();
			// $IDMember = $CurrentMember->ID;

			$userEmail = $CurrentMember->Email;

			// $Tutor = TutorPage::get()->filter(array('MemberID' => '$IDMember'))->First();
			//return Debug::show($IDMember);

			if (!$CurrentMember) {
				Versioned::reading_stage('Stage');
			}

			foreach ($emailArray as $recip) {
				//$emailArray defined in EmailArray.php

				$subject = $CurrentMember->FirstName . " " . $CurrentMember->Surname . " has requested their account be enabled";

				$body = $CurrentMember->FirstName . " " . $CurrentMember->Surname . " has requested their account be enabled. " . "Enable account  <a href='" . Director::absoluteBaseURL() . "admin/pages/'>in the content management system here.</a/><br><br>


		    Best, <br>
		    The Tutor Iowa Team<br>";

				$email = new Email();
				$email->setTo($recip->Email);
				$email->setFrom($adminEmail);
				$email->setSubject($subject);
				$email->setBody($body);
				if (SS_ENVIRONMENT_TYPE == "live") {
					$email->send();
				}

			}

			$subject = "The enabling of your Tutor Iowa account is pending";

			$body = SiteConfig::current_site_config()->PendingAccountEmail;
			
			$email = new Email();
			$email->setTo($CurrentMember->Email);
			$email->setFrom($adminEmail);
			$email->setSubject($subject);
			$email->setBody($body);
			if (SS_ENVIRONMENT_TYPE == "live") {
				$email->send();
			}

			Versioned::reading_stage('Live');
		}
		return $this->request->getVar('enable');
	}
}