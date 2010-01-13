<?php
 /*Copyright 2010 Imre Toth <tothimre at gmail>

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
   */

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