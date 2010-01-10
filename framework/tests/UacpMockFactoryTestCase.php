<?php
require_once 'autoload.php';

/**
 * This class simple gives mock objects for testing purposes.
 *
 */
class UacpMockFactoryTestCase extends PHPUnit_Framework_TestCase
{
	/**
	 * This function gives back an instance of the MockAuthClass
	 *
	 * @return MockAuthClass
	 * 
	 */
	public function getAuthMock()
	{
		return new MockAuthClass();
	}
	
	public function getLoginElementsMock()
	{
		$AuthMock=$this->getAuthMock();
		
		$params[]=$AuthMock;
		
		$mockLoginElements = $this->getMockForAbstractClass('LoginElements',$params);
		
		$mockLoginElements->expects($this->any())
        	->method('getUserStringFromAuth')
			->will($this->returnValue('fooser'));
			
			return $mockLoginElements;
	}
}

/**
 * This class is needed because you cannot simply use the 
 * getMockForAbstractClass to the initialisation, because the "enviroment"
 * is modelled in this particular class, it is easy to test.
 *
 */
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