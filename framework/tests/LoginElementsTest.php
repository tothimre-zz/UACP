<?php
require_once '../src/autoload.php';

class LoginElementsTest extends AuthMockTestCase
{
		
    public function testGetUserString()
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
    
    public function testGetInputUser()
    {
		$AuthMock=$this->getAuthMock();
		
		$params[]=$AuthMock;
		$mockLoginElements = $this->getMockForAbstractClass('LoginElements',$params);
		
		$mockLoginElements->expects($this->any())
        	->method('getUserStringFromAuth')
			->will($this->returnValue('fooser'));
		 
		$AuthMock->logIn('fooser','foopass');	
		
		
		$this->assertTrue(strpos($mockLoginElements->getInputUser(),'input')!=false);
		$this->assertTrue(strpos($mockLoginElements->getInputUser(),'type="text"')!=false);
		$this->assertTrue(strpos($mockLoginElements->getInputUser(),'name="uacp_user"')!=false);
		$this->assertTrue(strpos($mockLoginElements->getInputUser(),'class="uacp_user"')!=false);
		$this->assertTrue(strpos($mockLoginElements->getInputUser(),'id="uacp_user_id"')!=false);
		
		
    }
    
    public function testGetInputPassword()
    {   
		$AuthMock=$this->getAuthMock();
		
		$params[]=$AuthMock;
		$mockLoginElements = $this->getMockForAbstractClass('LoginElements',$params);
		
		$mockLoginElements->expects($this->any())
        	->method('getUserStringFromAuth')
			->will($this->returnValue('fooser'));
		 
		$AuthMock->logIn('fooser','foopass');	
    	
		$this->assertTrue(strpos($mockLoginElements->getInputPassword(),'input')!=false);
		$this->assertTrue(strpos($mockLoginElements->getInputPassword(),'name="uacp_pass"')!=false);
		$this->assertTrue(strpos($mockLoginElements->getInputPassword(),'class="uacp_pass"')!=false);
		$this->assertTrue(strpos($mockLoginElements->getInputPassword(),'id="uacp_pass_id"')!=false);
    	
    }
        
	public function testGetSubmit()
	{
		$AuthMock=$this->getAuthMock();
		
		$params[]=$AuthMock;
		$mockLoginElements = $this->getMockForAbstractClass('LoginElements',$params);
		
		$mockLoginElements->expects($this->any())
        	->method('getUserStringFromAuth')
			->will($this->returnValue('fooser'));
		 
		$AuthMock->logIn('fooser','foopass');	
		
		$this->assertTrue(strpos($mockLoginElements->getSubmit(),'input')!=false);
		$this->assertTrue(strpos($mockLoginElements->getSubmit(),'name="uacp_submit"')!=false);
		$this->assertTrue(strpos($mockLoginElements->getSubmit(),'class="uacp_submit"')!=false);
		$this->assertTrue(strpos($mockLoginElements->getSubmit(),'id="uacp_submit_id"')!=false);		    	
	}
	/* For later implementationn
	public function testGetMsg()
    {   
    	 
    }
    
    public function testGetMsgError()
    {   
    	 
    }*/
	
}
?>