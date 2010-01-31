<?php

require_once 'UacpSelenium.php';

class Example extends UacpSelenium
{
  function testMyTestCase()
  {
  	$path="showcase/examples/example_01/";
  	//opens the page and checks the
    $this->open($path."index.php");
  	    $this->type("uacp_user_id", "");
    $this->assertEquals("Log In", $this->getValue("uacp_submit_id"));

    //bad login
    $this->type("uacp_user_id", "fooser");
    $this->type("uacp_pass_id", "foo");
    $this->click("uacp_submit_id");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Log In", $this->getValue("uacp_submit_id"));

    //login
    $this->type("uacp_user_id", "fooser");
    $this->type("uacp_pass_id", "foopass");
    $this->click("uacp_submit_id");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Log Out", $this->getValue("uacp_submit_id"));

    //checks id it keeps the logged in state
    $this->open($path."index.php");

    //checks logout button
    $this->assertEquals("Log Out", $this->getValue("uacp_submit_id"));

    //checks for User String
    $this->assertTrue($this->isTextPresent("fooser"));
    $this->click("uacp_submit_id");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Log In", $this->getValue("uacp_submit_id"));
	
	$this->open($path."index.php");
    $this->open($path."index.php");
    $this->open($path."index.php");
	
	
	//brings the Captcha
	$this->type("uacp_user_id", "fooser");
    $this->type("uacp_pass_id", "badpass");
    $this->click("uacp_submit_id");
    $this->waitForPageToLoad("30000");

	$this->type("uacp_user_id", "fooser");
    $this->type("uacp_pass_id", "badpass");
    $this->click("uacp_submit_id");
    $this->waitForPageToLoad("30000");

	$this->type("uacp_user_id", "fooser");
    $this->type("uacp_pass_id", "badpass");
    $this->click("uacp_submit_id");
    $this->waitForPageToLoad("30000");

	$this->assertEquals("", $this->getText("captcha"));

	//tests the captcha with a bad password
    $this->type("uacp_user_id", "fooser");
    $this->type("uacp_pass_id", "foopass");
	$this->type("uacp_captcha_input_id", "aaa");
    $this->click("uacp_submit_id");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("", $this->getText("captcha"));

  }
}
?>