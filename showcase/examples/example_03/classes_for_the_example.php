<?php
/**
 * This file simply shows you how to implement 5 functions to get your full
 * featured authentication module.
 */
require '../../../framework/autoload.php';

/**
 * Implementing of getting the "String" value  of the user.
 */

class MyTemplateLogout extends TemplateLogout
{
	public function getUsernameLabel()
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
 * composition
 *
 */
class example_03
{
	private $myAuthBox;

	private $auth;
	function __construct()
	{
		$this->auth=new MyAuthClass();
		$myLogout=new MyTemplateLogout($this->auth);
		$this->myAuthBox=new AuthBoxFromDirectory($myLogout,"templates");
	}

	function getAuth(){
		return $this->auth;
	}
	/*
	 * A simple wrapper for the $this->myAuthBox->show() function. The only
	 * difference is that this function not gives back it's contents but prints
	 * that.
	 */
	function show()
	{
		echo $this->myAuthBox->show();
	}

}
?>