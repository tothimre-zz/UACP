<?php 
require_once 'autoload.php';
/**
 * This class implements the basic funtionality to 
 * represent the userrelated data in the system.
 * This object contains an instance of the Auth class
 * therefore you must pass it as the only pararmeter in the
 * constructor.
 *
 */

abstract class LoginElements{

	private $Auth=null;
	
	/**
	 * This object is a composition, so an istance of the Auth class 
	 * must be added as a parameter.
	 * @param Auth $Auth
	 */
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
    
    /**
     * This function uses the getUserStringFromAuth function
     * to get the String representation of the user and thecks
     * wether the user is signed in or not.
     * If not it gives back null value
     * 
     * @return string, null
     * 
     */
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
    
    /*
     * Returns a html form input tag that could represent an imput field for 
     * the name of the user.
     * There are predefinied fields as name, class, id for future developement
     * and easier css formatting.
     */
    public function getInputUser()
    {
    	return '<input type="text" name="uacp_user" class="uacp_user" id="uacp_user_id">';
    }
    
    /*
     * Returns a html form input tag that could represent an imput field for 
     * the password of the user.
     * There are predefinied fields as name, class, id for future developement
     * and easier css formatting.
     */
    public function getInputPassword()
    {   
    	return '<input type="password" name="uacp_pass" class="uacp_pass" id="uacp_pass_id">';
    }
        
    /*
     * Returns a html form input tag that could represent an imput field for 
     * a submit button that can send the user data if it is encapsulated in a html form..
     * There are predefinied fields as name, class, id for future developement
     * and easier css formatting.
     */
    public function getSubmit()
	{
    	return '<input type="submit" name="uacp_submit" value="Submit" class="uacp_submit" id="uacp_submit_id">';
	}
}
?>