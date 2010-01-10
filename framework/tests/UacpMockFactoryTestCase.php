<?php
require_once '../src/autoload.php';

class UacpMockFactoryTestCase extends PHPUnit_Framework_TestCase
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
	
	public function getLoginElementsMock()
	{
		$mockLoginElements = $this->getMockForAbstractClass('LoginElements',$params);
		
		$mockLoginElements->expects($this->any())
        	->method('getUserStringFromAuth')
			->will($this->returnValue('fooser'));
			
			return $mockLoginElements;
	}
}

/**
 * This class is needed because you cannot simply use the 
 * getMockForAbstractClass to 
 *
 */
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