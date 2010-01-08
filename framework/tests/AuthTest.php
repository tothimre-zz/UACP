<?php
require_once '../src/autoload.php';

class AuthTest extends PHPUnit_Framework_TestCase
{
	public function getAuthMock(){
		return new MockAuthClass();
	}
	

    public function testIsLoggedIn()
    {
    	$authMock=$this->getAuthMock();
    	//Testing with wrong userdata.
    	$authMock->logIn('foother','');
    	$this->assertEquals($authMock->isLoggedIn('foother',''), null);
    	
    	//Testing with valid user.
    	$authMock->logIn('fooser','foopass');
      	$this->assertFalse($authMock->isLoggedIn()==null);
      	
      	//Once aggin with wrong userdata to check if the flush works as it should.
    	$authMock->logIn('foother','');
    	$this->assertEquals($authMock->isLoggedIn('foother',''), null);
      	
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


class MockAuthClass extends Auth{
	
   private $userInfo=null;

  			
   public function authenticate($user, $pass)
   {
	if($user=='fooser' && $pass=='foopass')
   	 {
   	 	return'fooser';
   	 }
   	 else
   	 {
   	 	return null;	
   	 }
   }
   
	public function getAuthenticatedData()
	{
		return $this->userInfo;
	}
       
	public function storeAuthenticatedData($data)
	{
			$this->userInfo=$data;
	}
       
	public  function flushAuthenticatedData()
	{
		$this->storeAuthenticatedData(null);
	}
                      
}

?>