<?php 
require_once 'autoload.php';
/**
 * This class implements the basic funtionality to 
 * represent the userrelated data in the system.
 * I is an object composition, so you must setup 
 * the an object and use the setUp ,method before using
 * the object.
 *
 */

abstract class LoginElements{

	private $Auth=null;
	
	function __construct(Auth $Auth) 
	{
		$this->Auth=$Auth;
   	}
   /**
    * This function gives back the string representation uf the user
    * From the $this->Auth because it depends on your imőlemetedd abstract methods
    * and you kow how you stored the user are the only peson who can mine it
    * out from there.
    * @return Strig
    */
    abstract protected function getUserStringFromAuth();
    
    public function getUserString()
    {
    	if ($this->Auth->isLoggedIn())
    	{
    		return $this->getUserStringFromAuth();
    	}
    	else
    	{
    		return null;
    	}
    }
    
    public function getInputUser()
    {
    	return '<input type="text" name="uacp_user" class="uacp_user" id="uacp_user_id">';
    }
    
    public function getInputPassword()
    {   
    	return '<input type="password" name="uacp_pass" class="uacp_pass" id="uacp_pass_id">';
    }
        
	public function getSubmit()
	{
    	return '<input type="submit" name="uacp_submit" value="Submit" class="uacp_submit" id="uacp_submit_id">';
	}
}
?>