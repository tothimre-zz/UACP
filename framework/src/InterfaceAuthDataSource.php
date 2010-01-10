<?php 
/**
 * This interface Is the most important thing to understand in the system
 * The core abstraction that makes it reuseable is hidden below
 */
interface InterfaceAuthDataSource
{
	/**
	 * This function represents the authetnication, it needs a username and 
	 * a password. You are free to stool this funtion to your needs.
	 * 
	 * @param String $name
	 * @param String $pass
	 * 
	 */
	public function authenticate($name, $pass);
    
	/**
	 * Gives back any kind of data if the user is authenticated, else nothing.
	 * it depends on your implemetation how and what you store here. It is 
	 * recommended to store user releated data here, or something that is 
	 * releated to that, but feel free to make it wokt the way that serves 
	 * better your purposes.
     
	 * @return mixed
	 * 
	 */	
	public function getAuthenticatedData();
    
	/**
	 * Stores the authentication results if succeeded. 
	 * 
	 * @param String $data
	 *
	 */
	public function storeAuthenticatedData($data);   
	 
	/**
	 * Flushes the authentication data. It depends on your implementation how 
	 * implement it, or example if you store in the Session a lot of things not
	 * only the user information, maybe yo cen flush the whole session.
	 * 
	 */
    public function flushAuthenticatedData();
    
    
}
?>