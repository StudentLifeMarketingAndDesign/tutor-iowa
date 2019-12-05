<?php
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\Form;
use SilverStripe\Security\Member;
use SilverStripe\Core\Config\Config;
use SilverStripe\Control\Email\Email;
use SilverStripe\Control\Director;
use SilverStripe\SiteConfig\SiteConfig;

class DisablePageController extends PageController {

	private static $allowed_actions = array(
		'DisableForm',
		'notPublished',

	);

	public function DisableForm() {

		$fields = new FieldList(

		);

		$actions = new FieldList(
			new FormAction('doDisablePage', 'Disable Page')
		);

		return new Form($this, 'DisableForm', $fields, $actions);

	}

	public function doDisablePage() {

		$CurrentMember = Member::CurrentUser();
		/*
		Versioned::set_reading_mode('stage');
		$ID = 92;
		$test = DataObject::get_by_id('TutorPage', $ID);
		return Debug::show($test);
		 */

		if ($CurrentMember) {

			$IDMember = $CurrentMember->ID;

			//$Tutor = DataObject::get_one("TutorPage", "MemberID = $IDMember");
			$Tutor = TutorPage::get()->filter(array('MemberID' => $IDMember))->First();

			$userEmail = $CurrentMember->Email;
			$adminEmail = Config::inst()->get(Email::class, 'admin_email');

			//Send the admin an email when a user requests their account to be disabled.
			if (isset($adminEmail)) {

				$subject = "User has requested their account be disabled";
				$body = "User email: " . $userEmail . "

	        	Disable their account by clicking 'Unpublish' <a href='" . Director::absoluteBaseURL() . "admin/pages/edit/show/" . $Tutor->ID . "'>while editing their page here</a/>";
				//$headers = "From: Tutor Iowa";
				//mail($recip->Email, $subject, $body);

				$email = new Email();
				$email->setTo($adminEmail);
				$email->setFrom($adminEmail);
				$email->setSubject($subject);
				$email->setBody($body);

				if (SS_ENVIRONMENT_TYPE == "live") {
					$email->send();
				}
			}

			//Send the user an email confirming that their account is going to be disabled.
			$subject = "The disabling of your Tutor Iowa page is pending";
			$body = SiteConfig::current_site_config()->DisableAccountEmail;

			$email = new Email();
			$email->setTo($CurrentMember->Email);
			$email->setFrom(Email::getAdminEmail());
			$email->setSubject($subject);
			$email->setBody($body);
			if (SS_ENVIRONMENT_TYPE == "live") {
				$email->send();
			}

			return $this->redirect($this->Link('?saved=1'));
		} else {
			$message = "You must be <a href='" . Director::baseURL() . "/Security/login'>logged</a> in to edit your profile!";
			return $message;

		}

	}

	//Displays message specified in template if disable page request successful
	public function Saved() {
		return $this->request->getVar('saved');
	}

	//Used to check on DisablePage if user has been published yet -- if user has not been published, the disable page form should not appear
	public function notPublished() {

		$member = Member::CurrentUser();
		$IDMember = $member->ID;
		//$TutorPage = DataObject::get_one("TutorPage", "MemberID = $IDMember");
		$TutorPage = TutorPage::get()->filter(array('MemberID' => $IDMember))->First();

		if ($TutorPage instanceof TutorPage) {
			return false;
		} else {
			return true;
		}

	}
}