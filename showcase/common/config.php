<?php
define('CHANGEME', 'changeme');
//define('BASE_URL', CHANGEME);
define('EXAMPLE_BASE_URL', 'http://localhost/UACP/showcase/examples/');

if(EXAMPLE_BASE_URL==CHANGEME)
	throw new Exception("Please Define the BaseUrl for the examples in this file!");

?>
