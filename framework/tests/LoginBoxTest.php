<?php
require_once './UacpMockFactoryTestCase.php';

class LoginBoxTest extends UacpMockFactoryTestCase
{
	public function testShow()
    {   
		$AuthMock=$this->getAuthMock();
		
		$params[]=$AuthMock;
		$mockLoginElements = $this->getMockForAbstractClass('LoginElements',$params);
		
		$mockLoginElements->expects($this->any())
        	->method('getUserStringFromAuth')
			->will($this->returnValue('fooser'));
             
		$this->assertEquals($mockLoginElements->getUserString(),null);
		 
		 
		$AuthMock->logIn('fooser','foopass');	
		$mockLoginElements->getUserString();
		$this->assertTrue($mockLoginElements->getUserString()!=null);
    	
    }
}
?>