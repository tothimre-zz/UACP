<?php
/**
 * This interface unifyes the nterfaceAuthDataSource and the 
 * InterfaceAuthProcess interfaces. It is one key for the system felxibility.
 * If the problem you want to solve dont'n fits to the Auth class 
 * implementation it is not a problem. You should implement his interface 
 * and make an instance of it. 
 *
 */
interface  InterfaceAuth extends InterfaceAuthDataSource,InterfaceAuthProcess
{
	
}

?>