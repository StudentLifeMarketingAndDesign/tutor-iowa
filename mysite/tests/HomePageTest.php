<?php

class HomePageTest extends FunctionalTest {

	protected static $fixture_file = 'HomePage.yml';
	

    /**
     * Test generation of the view
     */
    public function testViewHomePage() {
	    
               
        print_r($this->fixtures);
		print_r($this->objFromFixture("Page", "page1"));
		
		$page = $this->get('testyhome');
		
		
        // Home page should load..
        $this->assertEquals(200, $page->getStatusCode());

        // We should see a login form
        $login = $this->submitForm("#LoginForm", null, array(
            'Email' => 'test@test.com',
            'Password' => 'wrongpassword'
        ));

        // wrong details, should now see an error message
        $this->assertExactHTMLMatchBySelector("#LoginForm p.error", array(
            "That email address is invalid."
        ));

        // If we login as a user we should see a welcome message
        $me = Member::get()->first();

        $this->logInAs($me);
        $page = $this->get('home/');

        $this->assertExactHTMLMatchBySelector("#Welcome", array(
            'Welcome Back'
        ));
    }
}
