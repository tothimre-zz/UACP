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
	 */
	public function session_start();
}
?>