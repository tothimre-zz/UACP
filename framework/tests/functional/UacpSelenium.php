<?php
/*Copyright 2010 Imre Toth <tothimre at gmail>

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
*/

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