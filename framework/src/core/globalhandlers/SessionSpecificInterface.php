<?php
interface SessionSpecificInterface{

	/**
	 * (non-PHPdoc)
	 * @see core/templating/PhpSessionHandlerInerface#session_id()
	 */
	public function session_id();

	/**
	 * (non-PHPdoc)
	 * @see core/templating/PhpSessionHandlerInerface#session_start()
	 */
	public function session_start();
}
?>