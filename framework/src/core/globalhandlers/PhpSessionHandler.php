<?php
/**
 * This is a reference implementation of the PhpSessionHandlerInterface it
 * works in the 99 percent of the cases so freely use it as the framework
 * uses it.
 * This class cannot be unittested, instead the PhpSessionHandlerInerface
 * is mocked for the tests
 *
 */
class PhpSessionHandler implements SessionHandlerInterface{

	/**
	 * This function is a must have here because without this the program cannot garantee
	 * the needed behaviour.
	 */
	private function sessionCheck(){
		$sid=session_id();
		if(!$sid){
			if(!headers_sent()){
				session_start();
			}
			else
			{
				throw new Exception("If you would use the PHpSessionHandler in your Instance of AuthTemplate please start the php session before you send the headers!!");
			}
		}
	}
	public function setValue($index,$value){
		$this->sessionCheck();
		$_SESSION[$index]=$value;
	}

	public function getValue($index){
		$this->sessionCheck();
		if(isset($_SESSION[$index])){
			return $_SESSION[$index];
		}
		else{
			return null;
		}
	}
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
}
?>