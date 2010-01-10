<?php

require_once 'tests/UacpMockFactoryTestCase.php';

class AuthBoxTest extends UacpMockFactoryTestCase
{
	public function testShow()
	{   
		$LoginElementsMock=$this->getLoginElementsMock();
		
		$loginBox=new AuthBox($LoginElementsMock,'url/to/handler');
		$login=$loginBox->show();
		
		$LoginElementsMock->getAuth()->logIn('fooser','foopass');
		$logout=$loginBox->show();
				
		$this->assertTrue($login!=$logout);
		$this->assertTrue(strpos($logout,'fooser')!=false);
			
	}
}
?>