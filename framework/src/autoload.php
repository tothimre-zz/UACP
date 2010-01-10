<?php
/**
 * This is function should be replaced by 
 * many require_once functions.
 */

function __autoload($className) 
{
	require_once $className.'.php';
}
?>