<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

/**
 * This class is extended by the UACP functional tests.
 */
class UacpSelenium extends PHPUnit_Extensions_SeleniumTestCase
{
	/**
	 * This is the location where the framework can be reached. for functioal testing,
	 * if you wish to place it another location, please replace it!
	 * 
	 * @var String
	 */
  protected $baseUrl="http://localhost/tothimre-UACP-af7632c/";

  function setUp()
  {
    $this->setBrowser("*chrome");
    $this->setBrowserUrl($this->baseUrl);
  }

}

?>