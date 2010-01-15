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

interface InterfaceAuthProcess
{

	/**
	 * Checks wether the current user is authenticated or not, if it is logged
	 * in the system gives back the date what you store form the user in your
	 * system, it can be object, array, strin or wathever you want.
	 * @return mixed
	 */
	public function getLoginData();


	/**
	 * Checks wether the current user is authenticated or not.
	 * if the returning value is true the user is authenticated.
	 * @return boolean
	 */
	public function isLoggedIn();

	/**
	 * You can authenticate the user, in many cases passing a username and
	 * a password to a system. This function Should implement this.
	 *
	 * @param $user
	 * User authentication string
	 * @param $pass
	 * User passpword
	 */
	public function logIn($user,$pass);

	/**
	 * This function is for logging out a user.
	 *
	 */
	public function logOut();

}
?>