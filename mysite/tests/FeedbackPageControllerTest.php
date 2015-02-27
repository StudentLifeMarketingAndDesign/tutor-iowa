<?php	
class FeedbackPageControllerTest extends FunctionalTest {
	
	/**
	 * This unit test should determine whether...
	 * Form was recieved 
	 * Form results were saved to database 
	 * If form has no id, but first and surname make sure database has tutorID
	 * Form redirects user to Thank you page
	 */
	 
	// please note that fixture is spelled with a 't' right in the middle 
	protected static $fixture_file = 'mysite/tests/FeedbackPageTest.yml';

	
	public function testSubmitFeedbackFrom() {
		
		$form = $this->setupFormFrontend();
		$controller = new FeedbackPage_Controller();
		
		$formdata = array(
			'Name' => 'Lazy Gogo',
			'Email' => 'okemail@good.com',
			'Feedback' => "You're pretty alright",
			'Firstname' => "Lazy",
			'Surname' => "Gogo",
			'TutorID' => 649
		);
		
		$page = $this->get($form->URLSegment);
		//print_r($page);
		//print_r($page->getStatusCode());
		$this->assertEquals(200, $page->getStatusCode());
		
		$response = $this->submitForm("Form_FeedbackForm", $button = null, $formdata);
		
		print_r($response);
		
		//$submitted = DataObject::get('SubmittedFormField');
		
		// test that feedback is saved to database
		
		
		// test that email is sent to correct person
		include 'mysite/code/EmailArray.php'; //this is where the current code grabs email info from...
		foreach ($emailArray as $recip){ //emailArray defined in EmailArray.php
			$this->assertEmailSend($recip->Email, NULL, NULL, NULL);        
        }
         
        // test that user is redirected to Thank You page
       	$this->assertEquals(302, $response->getStatusCode());

		
	}
	
	public function setupFormFrontend() {
		$form = $this->objFromFixture('FeedbackPage', 'feedback-form-page');
		$this->logInWithPermission('ADMIN');
		
		$form->doPublish();
		$member = Member::currentUser();
		$member->logOut();
		
		return $form;
	}
	
	
	
}
//class FeedbackPageTest_Controller extends Page_Controller {}
