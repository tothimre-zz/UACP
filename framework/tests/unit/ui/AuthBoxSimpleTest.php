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

require_once 'tests/unit/UacpMockFactoryTestCase.php';

class AuthBoxSimpleTest extends UacpMockFactoryTestCase
{
  public function testShow()
  {

    $getUserNameInterface=$this->GetUserNameInterface($this->getAuthMock());

    $auth=$getUserNameInterface->getAuth();

    $authBox=new AuthBoxSimple($auth,$getUserNameInterface);

    $sessionMock=$this->getMockSessionHandler();
    /*
     * This is a must have line if you would test this function because
     * the captcha support relies on the session support of the php
     */
    $authBox->setSessionHandler($sessionMock);
    $sessionMock->session_start();

    $authBox->setUserDataHandler($this->getMockPostHandler('fooser','badpass'));
    $login=$authBox->show();
    $logout=$authBox->show();

  }

}
?>