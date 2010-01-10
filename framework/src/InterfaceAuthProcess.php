<?php

interface InterfaceAuthProcess
{

	/**
	 * Checks wether the current user is authenticated or not
	 * It gives back the authentication data if it is logged in
	 * if not it returns simple null.
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