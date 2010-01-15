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

/**
 * This class implements the basic funtionality to represent the user related 
 * data in the system. The question may arise: "Why is not this class simply
 * extends the Auth Class or the InterfaceAuth?" the answer is in the question.
 * Because in this situation it is better to create an object composition, 
 * than inherit a class and hardcode everything into it. 
 *
 * If you use this implementation of the Interface Login Elements don't forget
 * to implement the  getUserStringFromAuth function.
 * That function gives back the string representation of the user from the 
 * Auth field of the object because it depends on your implemeted abstract methods
 * and you kow how you stored the user data the only peson who can mine it
 * out from there.

 */

abstract class LoginElements implements InterfaceLoginElements{
	
	private $auth=null;
	
	function __construct(InterfaceAuth $auth) 
	{
		$this->auth=$auth;
	}
	
	public function getAuth()
	{
		return $this->auth;
	}	
    
	public function getInputPassword()
	{   
		return '<input type="password" name="uacp_pass" class="uacp_pass" id="uacp_pass_id">';
	}
	
	public function getInputUser()
	{
		return '<input type="text" name="uacp_user" class="uacp_user" id="uacp_user_id">';
	}

	public function getSubmit()
	{
		$value;
		if($this->auth->isLoggedIn())
		{
			$value='Log Out';
		}
		else
		{
			$value='Log In';
		}
		
		return '<input type="submit" name="uacp_submit" value="'.$value.'" class="uacp_submit" id="uacp_submit_id">';
	}
	
	public function getUserString()
	{
		if ($this->auth->isLoggedIn())
		{
			return $this->getUserStringFromAuth();
		}
		else
		{
			return null;
		}
	}
	
}
?>