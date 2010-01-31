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

		$TemplateLogin=new TemplateLogin('{UsernameInputString}{PasswordInputString}{HandlerUrl}..login..','testurl');
		$TemplateLoginCaptcha=new TemplateLoginCaptcha('{UsernameInputString}{PasswordInputString}{HandlerUrl}{CaptchaImage}{CaptchaImputString}..loginCaptcha..','testurl');

		$loginBox=new AuthTemplate($TemplateLogout,$TemplateLogin,$TemplateLoginCaptcha);
		
		$sessionMock=($this->getMockSessionHandler());
		$loginBox->setSessionhandler($sessionMock);
		$sessionMock->session_start();
		
		//should catach the login screen
		$login=$loginBox->show();
		$loginBox->show();
		$loginBox->show();
		$loginBox->show();
		//should catach the login screen again
		$login2=$loginBox->show();
		$this->assertTrue($login==$login2);
		
		$loginBox->setUserDataHandler($this->getMockPostHandler('fooser','foopass'));
		//should ctach the logout screen
		$logout=$loginBox->show();
		
		//using bad password causes to bring the captcha in.
		$loginBox->setUserDataHandler($this->getMockPostHandler('fooser','badpass'));
		$sessionMock=($this->getMockSessionHandler());
		$loginBox->setSessionhandler($sessionMock);
		$sessionMock->session_start();
		
		$loginBox->show();
		$loginBox->show();
		$loginBox->show();
		$loginBox->show();
		$loginBox->show();
		$logincaptcha=$loginBox->show();
		
		echo $logincaptcha;
		
		$this->assertTrue($login!=$logout);
		$this->assertTrue($login!=$logincaptcha);
		$this->assertTrue((strpos($logout,'fooser')!=false)||strpos($logout,'fooser')===0);
	}

	/**
     * @expectedException Exception
     */
	public function testShowButNotSessionStarted(){

		$TemplateLogout=$this->getTemplateLogoutMock();
		$auth=$TemplateLogout->getAuth();

		$TemplateLogin=new TemplateLogin('{UsernameInputString}{PasswordInputString}{HandlerUrl}','testurl');
		$TemplateLoginCaptcha=new TemplateLoginCaptcha('{UsernameInputString}{PasswordInputString}{HandlerUrl}{CaptchaImage}{CaptchaImputString}','testurl');

		$loginBox=new AuthTemplate($TemplateLogout,$TemplateLogin,$TemplateLoginCaptcha);
		$sessionMock=$this->getMockSessionHandler();
		$loginBox->setSessionhandler($sessionMock);

		$login=$loginBox->show();

	}

}
?>