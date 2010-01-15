<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class Example extends PHPUnit_Extensions_SeleniumTestCase
{
  function setUp()
  {
    $this->setBrowser("*chrome");
    $this->setBrowserUrl("http://localhost/UACP/showcase/example_01/");
  }

  function testMyTestCase()
  {
    $this->open("index.php");
    $this->type("uacp_user_id", "");
    $this->assertEquals("Log In", $this->getValue("uacp_submit_id"));
    $this->type("uacp_user_id", "fooser");
    $this->type("uacp_pass_id", "foo");
    $this->click("uacp_submit_id");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Log In", $this->getValue("uacp_submit_id"));
    $this->type("uacp_user_id", "fooser");
    $this->type("uacp_pass_id", "foopass");
    $this->click("uacp_submit_id");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Log Out", $this->getValue("uacp_submit_id"));
    $this->assertTrue($this->isTextPresent("fooser"));
    $this->click("uacp_submit_id");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("Log In", $this->getValue("uacp_submit_id"));
  }
}

?>