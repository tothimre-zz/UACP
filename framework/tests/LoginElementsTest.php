<?php
require_once './UacpMockFactoryTestCase.php';

class LoginElementsTest extends UacpMockFactoryTestCase
{
		
    public function testGetUserString()
    {
		
		$mockLoginElements=$this->getLoginElementsMock();
             
		$this->assertEquals($mockLoginElements->getUserString(),null);
		 
		 
		$mockLoginElements->getAuth()->logIn('fooser','foopass');	
		$mockLoginElements->getUserString();
		$this->assertTrue($mockLoginElements->getUserString()!=null);
    	
    }
    
    public function testGetInputUser()
    {
		$mockLoginElements=$this->getLoginElementsMock();
    			 
		$mockLoginElements->getAuth()->logIn('fooser','foopass');	
		
		
		$this->assertTrue(strpos($mockLoginElements->getInputUser(),'input')!=false);
		$this->assertTrue(strpos($mockLoginElements->getInputUser(),'type="text"')!=false);
		$this->assertTrue(strpos($mockLoginElements->getInputUser(),'name="uacp_user"')!=false);
		$this->assertTrue(strpos($mockLoginElements->getInputUser(),'class="uacp_user"')!=false);
		$this->assertTrue(strpos($mockLoginElements->getInputUser(),'id="uacp_user_id"')!=false);
		
		
    }
    
    public function testGetInputPassword()
    {   
		$mockLoginElements=$this->getLoginElementsMock();
    			 
		$mockLoginElements->getAuth()->logIn('fooser','foopass');	
    	
		$this->assertTrue(strpos($mockLoginElements->getInputPassword(),'input')!=false);
		$this->assertTrue(strpos($mockLoginElements->getInputPassword(),'name="uacp_pass"')!=false);
		$this->assertTrue(strpos($mockLoginElements->getInputPassword(),'class="uacp_pass"')!=false);
		$this->assertTrue(strpos($mockLoginElements->getInputPassword(),'id="uacp_pass_id"')!=false);
    	
    }
        
	public function testGetSubmit()
	{
		$mockLoginElements=$this->getLoginElementsMock();
				 
		$mockLoginElements->getAuth()->logIn('fooser','foopass');	
		
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