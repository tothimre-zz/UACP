<?php

require_once 'UacpSelenium.php';

class Example extends UacpSelenium
{
  function testMyTestCase()
  {
  	//opens the page and checks the 
    $this->open("showcase/example_01/index.php");
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
    
    //checks id it keeps the loggen in state
    $this->open("showcase/example_01/index.php");
    
    //checks logout button
    $this->assertEquals("Log Out", $this->getValue("uacp_submit_id"));
    
    //checks for User Sring
    $this->assertTrue($this->isTextPresent("fooser"));
    $this->click("uacp_submit_id");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Log In", $this->getValue("uacp_submit_id"));
    
	//brings the Captcha
    $this->open("showcase/example_01/index.php");
    $this->open("showcase/example_01/index.php");
    $this->open("showcase/example_01/index.php");
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