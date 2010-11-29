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
    $getUserNameInterface=$this->GetUserNameInterface($this->getAuthMock());
    
    $TemplateLogout= new TemplateLogout('{'.TemplateInterface::USER_NAME_LABEL_INDEX.'}'.'{'.TemplateInterface::SUBMIT_INDEX_VALUE__FOR_HTML_FORM_INPUT.'}', $getUserNameInterface->getAuth(), 'http://testurl', $getUserNameInterface);
    $TemplateLogin=new TemplateLogin('{'.TemplateInterface::USER_NAME_VALUE_FOR_HTML_FORM_INPUT.'}'.'{'.TemplateInterface::USER_PASS_VALUE_FOR_HTML_FORM_INPUT.'}'.'{'.TemplateInterface::SUBMIT_INDEX_VALUE__FOR_HTML_FORM_INPUT.'}'.'{'.TemplateInterface::INPUT_HANDLER_URL_INDEX.'}'.'{'.TemplateInterface::SUBMIT_INDEX_VALUE__FOR_HTML_FORM_INPUT.'}','testurl');
    $TemplateLoginCaptcha=new TemplateLoginCaptcha('{'.TemplateInterface::USER_NAME_VALUE_FOR_HTML_FORM_INPUT.'}'.'{'.TemplateInterface::USER_PASS_VALUE_FOR_HTML_FORM_INPUT.'}'.'{'.TemplateInterface::SUBMIT_INDEX_VALUE__FOR_HTML_FORM_INPUT.'}'.'{'.TemplateInterface::INPUT_HANDLER_URL_INDEX.'}'.'{'.TemplateInterface::SUBMIT_INDEX_VALUE__FOR_HTML_FORM_INPUT.'}'.'{'.TemplateInterface::CAPTCHA_IMAGE_INDEX.'}'.'{'.TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT.'}','testurl');

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

    $getUserNameInterface=$this->GetUserNameInterface($this->getAuthMock());


    $auth=$getUserNameInterface->getAuth();

    $TemplateLogout= new TemplateLogout('{'.TemplateInterface::USER_NAME_LABEL_INDEX.'}'.'{'.TemplateInterface::SUBMIT_INDEX_VALUE__FOR_HTML_FORM_INPUT.'}', $getUserNameInterface->getAuth(), 'http://testurl', $getUserNameInterface);
    $TemplateLogin=new TemplateLogin('{'.TemplateInterface::USER_NAME_VALUE_FOR_HTML_FORM_INPUT.'}'.'{'.TemplateInterface::USER_PASS_VALUE_FOR_HTML_FORM_INPUT.'}'.'{'.TemplateInterface::SUBMIT_INDEX_VALUE__FOR_HTML_FORM_INPUT.'}'.'{'.TemplateInterface::INPUT_HANDLER_URL_INDEX.'}'.'{'.TemplateInterface::SUBMIT_INDEX_VALUE__FOR_HTML_FORM_INPUT.'}','testurl');
    $TemplateLoginCaptcha=new TemplateLoginCaptcha('{'.TemplateInterface::USER_NAME_VALUE_FOR_HTML_FORM_INPUT.'}'.'{'.TemplateInterface::USER_PASS_VALUE_FOR_HTML_FORM_INPUT.'}'.'{'.TemplateInterface::SUBMIT_INDEX_VALUE__FOR_HTML_FORM_INPUT.'}'.'{'.TemplateInterface::INPUT_HANDLER_URL_INDEX.'}'.'{'.TemplateInterface::SUBMIT_INDEX_VALUE__FOR_HTML_FORM_INPUT.'}'.'{'.TemplateInterface::CAPTCHA_IMAGE_INDEX.'}'.'{'.TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT.'}','testurl');

    $loginBox=new AuthTemplate($TemplateLogout,$TemplateLogin,$TemplateLoginCaptcha);
    $sessionMock=$this->getMockSessionHandler();
    $loginBox->setSessionhandler($sessionMock);

    $login=$loginBox->show();

  }

}
?>