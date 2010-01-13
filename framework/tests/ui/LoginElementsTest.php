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

require_once 'tests/UacpMockFactoryTestCase.php';

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
		
		/*
		 * If the user is logged in it gives back different value, contracting 
		 * to if it is not.
		 */
		$logOutSubmit=$mockLoginElements->getSubmit();
		$mockLoginElements->getAuth()->logOut();
		$logInSubmit=$mockLoginElements->getSubmit();

		$this->assertTrue($logOutSubmit!=$logInSubmit);
		
	}
	
}
?>