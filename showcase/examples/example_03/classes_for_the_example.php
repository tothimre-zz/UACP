<?php
/**
 * This file simply shows you how to implement 5 functions to get your full
 * featured authentication module.
 */
include '../../../framework/autoload.php';
include '../../common/config.php';
/**
 * Implementing of getting the "String" value  of the user.
 */

class MyGetUserNameInterface implements GetUserNameInterface
{
	public function getUserName()
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
	/**
	 *
	 * @var AuthBoxFromDirectory
	 */
	private $myAuthBox;

	function __construct()
	{
		$auth=new MyAuthClass();
		$aa=new MyGetUserNameInterface();
		$this->myAuthBox=new AuthBoxFromDirectory($auth,$aa,'templates');
		$this->myAuthBox->setAfterLoginUrl(EXAMPLE_BASE_URL.'example_03/logout.php');
		$this->myAuthBox->setLogoutUrl(EXAMPLE_BASE_URL.'example_03/index.php');
	}

	public function getMyAuthBox(){
		return $this->myAuthBox;
	}
	
	function show()
	{
		echo $this->myAuthBox->show();
	}

}
?>