<?php
require_once '../src/autoload.php';

class AuthMockTestCase extends PHPUnit_Framework_TestCase
{
	/**
	 * This function gives bsck an instence of the MockAuthClass
	 *
	 * @return MockAuthClass
	 */
	public function getAuthMock()
	{
		return new MockAuthClass();
	}
}


class MockAuthClass extends Auth{

	private $userInfo=null;
	private $msg=null;
	private $msgError;
		
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