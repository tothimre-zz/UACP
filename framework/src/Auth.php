<?php 
require_once 'autoload.php';
abstract class Auth implements InterfaceDataSource{
	
/**
 * Checks wether the current user is authenticated or not
 * It gives back the autentication data if it is logged in
 * if not than it is simple null.
 * @return mixed
 */
	public function isLoggedIn()
    {
    	if($this->getAuthenticatedData()){
    		return $this->getAuthenticatedData();
    	}
    	else{
    		return null;
    	}
    }
 
/**
 * With this you can authenticate the user, if it is a valid user 
 * stores its information, else flushes the authentication informations. 
 * 
 * @param $user
 * User authentication string
 * @param $pass
 * User passpword
 */
    public function logIn($user,$pass)
    {
    	$auth=$this->authenticate($user,$pass);
    	if ($auth)
    	{
    		$this->storeAuthenticatedData($auth);
    	}
    	else{
    		$this->flushAuthenticatedData();
    	}
    }
    	
}
?>