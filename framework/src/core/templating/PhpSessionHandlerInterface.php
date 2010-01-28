<?php
/**
 * This interface is for the generalization and make the AuthTemplate Testable.
 *
 */

interface PhpSessionHandlerInerface{
	/**
	 * This is a wrapper in most cases to the original built in
	 * session_id() function. It should be implemented partially,
	 * so it don't needs any parameter to set up the session id,
	 * it only gives it back.
	 *
	 * @return String
	 */
	public function session_id();


	/**
	 * This is a wrapper in most cases to the original built in
	 * session_start() function.
	 *
	 * @return none
	 */
	public function session_start();

	/**
	 * This function stores values to the session
	 *
	 * @param $index
	 * The index of an array where you would store the value.
	 *
	 * @param $value
	 * The value you would to store to the given index.
	 *
	 * @return none
	 */
	public function setValue($index,$value);

	/**
	 * This function provides values stored in the session. If there is not
	 * such an index it gives back null;
	 *
	 * @param unknown_type $index
	 * @param unknown_type $value
	 * @return unknown_type
	 */
	public function getValue($index);


}
?>