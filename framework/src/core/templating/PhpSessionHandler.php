<?php
/**
 * This is a reference implementation of the PhpSessionHandlerInterface it
 * works in the 99 percent of the cases so freely use it as the framework
 * uses it.
 * This class cannot be unittested, instead the PhpSessionHandlerInerface
 * is mocked for the tests
 *
 */
class PhpSessionHandler implements PhpSessionHandlerInerface{

	/**
	 * (non-PHPdoc)
	 * @see core/templating/PhpSessionHandlerInerface#session_id()
	 */
	public function session_id(){
		return session_id();
	}

	/**
	 * (non-PHPdoc)
	 * @see core/templating/PhpSessionHandlerInerface#session_start()
	 */
	public function session_start(){
		session_start();
	}

	/**
	 * (non-PHPdoc)
	 * @see core/templating/PhpSessionHandlerInerface#setValue($index, $value)
	 */
	public function setValue($index,$value){
		$_SESSION[$index]=$value;
	}

	/**
	 * (non-PHPdoc)
	 * @see core/templating/PhpSessionHandlerInerface#getValue($index)
	 */
	public function getValue($index){
		return $_SESSION[$index];
	}
}
?>