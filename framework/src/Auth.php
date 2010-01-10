<?php 
require_once 'autoload.php';

/**
 * This abstract class models the default user log in scenario. It is useable  
 * in most possible cases. It implements the InterfaceAuthProcess interface 
 * therefore if you want an Auth object you must implement the 
 * InterfaceAuthDataSource interface;how to store, flush, and check 
 * user information in your system.
 * It is a referenceimplmentation of the InterfaceAuth that is useable in most
 * cases, it it does not fits for your need fell free to implement the whole
 * Interface Auth for yourself and us yours, the framework is capable for this.
 * 
 */
abstract class Auth implements InterfaceAuth{

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
 
	public function logIn($user,$pass)
	{
		$auth=$this->authenticate($user,$pass);
		if ($auth)
		{
			$this->storeAuthenticatedData($auth);
		}
		else
		{
			$this->flushAuthenticatedData();
		}
	}	
	
	public function logOut()
	{
		$this->flushAuthenticatedData();		
	}
}
?>