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

require_once 'tests/unit/UacpMockFactoryTestCase.php';

class AuthTemplateTest extends UacpMockFactoryTestCase
{
	public function testShow()
	{   
		$TemplateLogout=$this->getTemplateLogoutMock();
		$auth=$TemplateLogout->getAuth();
		
		$TemplateLogin=new TemplateLogin('{UsernameInputString}{PasswordInputString}{HandlerUrl}','testurl');
		$TemplateLoginCaptcha=new TemplateLoginCaptcha('{UsernameInputString}{PasswordInputString}{HandlerUrl}{CaptchaImage}{CaptchaImputString}','testurl');
		
		$loginBox=new AuthTemplate($TemplateLogout,$TemplateLogin,$TemplateLoginCaptcha);
		
		$login=$loginBox->show();
		$auth->logIn('fooser','foopass');
		$logout=$loginBox->show();
		
		$this->assertTrue($login!=$logout);
		$this->assertTrue((strpos($logout,'fooser')!=false)||strpos($logout,'fooser')===0);
	}
}
?>