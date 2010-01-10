<?php
require '../../framework/autoload.php';

class myLoginElements extends LoginElements
{
	public function getUserStringFromAuth()
	{
		return $_SESSION['UACP_USER_DATA'];
	}
}

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
		return $_SESSION['UACP_USER_DATA'];
	}
	 
	public function storeAuthenticatedData($data)
	{
		$_SESSION['UACP_USER_DATA']=$data;
	}
	 
	public  function flushAuthenticatedData()
	{
		session_unset();
	}
}

class example_01 
{
	private $myAuthBox;
	private $loginElements;
	
	function __construct()
	{
		$auth=new MyAuthClass();
		$this->loginElements=new myLoginElements($auth);
		$this->myAuthBox=new AuthBox($this->loginElements,'index.php');
	}
	
	function show()
	{
		echo $this->myAuthBox->show();
	}
	
	function getMyAuthBox()
	{
		return $this->myAuthBox;
	}
}
?>