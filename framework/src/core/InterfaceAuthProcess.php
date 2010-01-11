<?php

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