<?php 
/**
 * This interface 
 */
interface InterfaceDataSource
{
	/**
	 * This function represents the authetnication, 
	 * it needs a username and and a password.
	 * 
	 * @param String $name
	 * @param String $pass
	 * 
	 */
	
    public function authenticate($name, $pass);
    /**
     * Gives back any kind of data if the user is authenticated,
     * else nothing. 
     * @return array
     * 
     */
    public function getAuthenticatedData();
    
    /**
     * Stores the authentication results if succeeded. 
     * 
     */
    public function storeAuthenticatedData($data);
    
    /**
     * Flushes the authentication data.
     * 
     */
    public function flushAuthenticatedData();
    
    
}
?>