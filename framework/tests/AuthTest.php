<?php
require_once './UacpMockFactoryTestCase.php';

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
		 
		//Once aggin with wrong userdata to check if the flush works as it should.
		$authMock->logIn('foother','');
		$this->assertEquals($authMock->getLoginData(), null);
	}

	/**
	 *
	 * @depends testGetLoginData
	 */
	public function testIsLoggedIn()
	{
		$authMock=$this->getAuthMock();
		//Testing with wrong userdata.
		$authMock->logIn('foother','');
		$this->assertEquals($authMock->isLoggedIn(), null);
		 
		//Testing with valid user.
		$authMock->logIn('fooser','foopass');
		$this->assertFalse($authMock->isLoggedIn()==null);
		 
		//Once aggin with wrong userdata to check if the flush works as it should.
		$authMock->logIn('foother','');
		$this->assertEquals($authMock->isLoggedIn(), null);
		 
	}

	/**
	 * @depends testIsLoggedIn
	 *
	 */
	public function testLogIn()
	{
		$authMock=$this->getAuthMock();
		$authMock->logIn('fooser','foopass');
		$this->assertFalse($authMock->isLoggedIn()==null);
	}
}

?>