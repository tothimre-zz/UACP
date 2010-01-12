<?php
/**
 * This class implements the basic funtionality to represent the user related 
 * data in the system. The question may arise: "Why is not this class simply
 * extends the Auth Class or the InterfaceAuth?" the answer is in the question.
 * Because in this situation it is better to create an object composition, 
 * than inherit a class and hardcode everything into it.
 *
 */

interface InterfaceLoginElements{

	/*
	 * The instance of the Auth class. It is needed for the authentication
	 * process, storing, flushing ang getting information about the user 
	 * authentication process at the current session.
	 * 
	 */
//	private $Auth;
	
	/**
	 * The descendants of this interface must have an Auth field that stores an 
	 * InerfaceAuth interface and ca reach it. A general purpose implemetation
	 * of this is the InterfaceAuth.
	 * The descendants should be an objecz composition, so an istance of the 
	 * InterfaceAuth  must be added to the constructor as a parameter.
	 * 
	 * @param Auth $Auth
	 * 
	 */
	function __construct(InterfaceAuth $Auth); 
	
	/**
	 * This function should give back the string representation of the user 
	 * from the Auth field of the descendants because it depends on your 
	 * implemetation kow how you store the user data.
	 * 
	 * @return Strig
	 * 
	 */
	public function getUserStringFromAuth();
    
 	/**
	 * This function should use uses the getUserStringFromAuth function
	 * to get the String representation of the user and checks wether the user
	 * is signed in or not. If not it gives back null value.
	 * 
	 * @return string, null
	 * 
	 */
	public function getUserString();

    
	/**
	 * Returns a html form input tag that could represent an input field for 
	 * the name of the user.
	 * There are predefinied fields as name, class, id for future developement
	 * and easier css formatting.
	 * 
	 */
	public function getInputUser();

    
	/**
	 * Returns a html form input tag that could represent an imput field for 
	 * the password of the user.
	 * 
	 * There are predefinied fields as name, class, id for future developement
	 * and easier css formatting.
	 * 
	 */
	public function getInputPassword();


	/**
	 * Returns a html form input tag that could represent an input field for 
	 * a submit button that can send the user data if it is encapsulated in 
	 * a html form. There are predefinied fields as name, class, id for future developement
	 * and easier css formatting.
	 * 
	 */
	public function getSubmit();
	
	/**
	 * Gives back the Auth field attached to the the descendants. 
	 * (examine the Login Elements Class)
	 * 
	 * @return Auth
	 */
	public function getAuth();
}
?>