<?php
	/**
	 * This is just a little example how to implement the framework the most easily and get
	 * a full featured authentication module.
	 */

	session_start(); 
	require 'classes_for_the_example.php';
	$example = new example_01();
	$example->show();		
?>