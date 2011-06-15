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

require_once 'framework/tests/unit/UacpMockFactoryTestCase.php';

class AuthTest extends UacpMockFactoryTestCase
{

  public function testGetLoginData()
  {
    $authMock=$this->getAuthMock();
    //Testing with wrong userdata.
    $authMock->logIn('foother','');
    $this->assertEquals($authMock->getLoginData(), null);

    //Testing with valid user.
    $authMock->logIn('fooser','foopass');
    $this->assertFalse($authMock->getLoginData()==null);

    //Once aggin with wrong userdata to check if the removal of the user
    //data works as it should.
    $authMock->logIn('foother','');
    $this->assertEquals($authMock->getLoginData(), null);

    $authMock->logOut();

    return $authMock;
  }

  /**
   *
   * @depends testGetLoginData
   */
  public function testIsLoggedIn($authMock)
  {
    //Testing with wrong userdata.
    $authMock->logIn('foother','');
    $this->assertEquals($authMock->isLoggedIn(), null);

    //Testing with valid user.
    $authMock->logIn('fooser','foopass');
    $this->assertFalse($authMock->isLoggedIn()==null);

    //Once aggin with wrong userdata to check if the flush works as it should.
    $authMock->logIn('foother','');
    $this->assertEquals($authMock->isLoggedIn(), null);

    return $authMock;

  }

  /**
   * @depends testIsLoggedIn
   *
   */
  public function testLogIn($authMock)
  {
    $this->assertTrue($authMock->isLoggedIn()==null);
    return $authMock;
  }

  /**
   * @depends testLogIn
   *
   */
  public function testLogout($authMock)
  {
    $authMock->logOut();
    $this->assertTrue($authMock->isLoggedIn()==null);
  }
}

?>
