<?php

function __autoload($className) 
{
	require_once $className.'.php';
}

?>