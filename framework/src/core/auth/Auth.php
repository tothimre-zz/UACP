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
 * This abstract class models the default user log in scenario. It is usable
 * in most possible cases. It implements the InterfaceAuthProcess interface
 * therefore if you want an Auth object you must implement the
 * InterfaceAuthDataSource interface;how to store, flush, and check
 * user information in your system.
 * It is a reference implementation of the InterfaceAuth that is usable in most
 * cases, it it does not fits for your need fell free to implement the whole
 * Interface Auth for yourself and us yours, the framework is capable for this.
 *
 */
abstract class Auth implements InterfaceAuth{

	/**
	 * (non-PHPdoc)
	 * @see core/auth/InterfaceAuthProcess#getLoginData()
	 */
	public function getLoginData()
	{
		$authData=$this->getAuthenticatedData();
		if($authData)
		{
			return $authData;
		}
		else
		{
			return null;
		}
	}

	/**
	 * (non-PHPdoc)
	 * @see core/auth/InterfaceAuthProcess#isLoggedIn()
	 */
	public function isLoggedIn()
	{
		if($this->getLoginData())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * (non-PHPdoc)
	 * @see core/auth/InterfaceAuthProcess#logIn($user, $pass)
	 */
	public function logIn($user,$pass)
	{
		$auth=$this->authenticate($user,$pass);
		if ($auth)
		{
			$this->storeAuthenticatedData($auth);
		}
		else
		{
			$this->logOut();
		}
	}

	/**
	 * (non-PHPdoc)
	 * @see core/auth/InterfaceAuthProcess#logOut()
	 */
	public function logOut()
	{
		$this->storeAuthenticatedData(null);
	}
}
?>