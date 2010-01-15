<?php
/**
 * This file simly shows you how to implement 5 functions to get your full 
 * featured authentication module.
 */
require '../../framework/autoload.php';

/**
 * Implementing of getting the "String" value  of the user.
 */
class myLoginElements extends LoginElements
{
	public function getUserStringFromAuth()
	{
		return $_SESSION['UACP_USER_DATA'];
	}
}

/**
 * Extending the auth class means defining your remaining functions
 *
 */
class MyAuthClass extends Auth
{
	
	public function authenticate($user, $pass)
	
	{
		if($user=='fooser' && $pass=='foopass')
		{
			return'fooser';
		}
		else
		{
			return null;
		}
	}
	 
	public  function flushAuthenticatedData()
	{
		session_unset();
	}	
	
	public function getAuthenticatedData()
	{
                if(isset($_SESSION['UACP_USER_DATA']))
                {
		   return $_SESSION['UACP_USER_DATA'];
                }
                else
                {
                  return null;
                }
	}
	 
	public function storeAuthenticatedData($data)
	{
		$_SESSION['UACP_USER_DATA']=$data;
	}
	 
}

/**
 * A reference class how to implement the Authbox class in an object 
 * complsition
 *
 */
class example_01 
{
	private $myAuthBox;
	private $loginElements;
	
	/*
	 * 
	 */
	function __construct()
	{
		$auth=new MyAuthClass();
		$this->loginElements=new myLoginElements($auth);
		$this->myAuthBox=new AuthBox($this->loginElements,'index.php');
	}
	
	/*
	 * A simple wrapper for the $this->myAuthBox->show() function
	 */
	function show()
	{
		echo $this->myAuthBox->show();
	}
	
}
?>