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
 * This interface Is the most important thing to understand in the system
 * The core abstraction that makes it reusable is hidden below
 */
interface InterfaceAuthDataSource
{
	/**
	 * This function represents the authentication, it needs a user name and
	 * a password. You are free to stool this function to your needs.
	 *
	 * @param String $name
	 * @param String $pass
	 *
	 */
	public function authenticate($name, $pass);

	/**
	 * Flushes the authentication data. It depends on your implementation how
	 * implement it, or example for instance store in the Session a lot of
	 * things not only the user information, maybe you can flush the whole
	 * session.
	 *
	 */
	public function flushAuthenticatedData();

	/**
	 * Gives back any kind of data if the user is authenticated, else nothing.
	 * it depends on your implementation how and what you store here. It is
	 * recommended to store user related data here, or something that is
	 * related to that, but feel free to make it work the way that serves
	 * better your purposes.

	 * @return mixed
	 *
	 */
	public function getAuthenticatedData();

	/**
	 * Stores the authentication results if succeeded.
	 *
	 * @param String $data
	 *
	 */
	public function storeAuthenticatedData($data);


}
?>