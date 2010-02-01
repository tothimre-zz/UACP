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


/**
 * The purpose if this class is to give back a html login box.
 *
 */
class AuthTemplate
{
	private $logIn=null;
	private $logOut=null;
	private $logInCaptcha=null;
	private $beforeCaptcha=null;
	private $sessionHandler=null;
	private $userDataHandler=null;

	/**
	 *
	 * @param $logOut
	 * It is a TemplateLogout object.
	 *
	 * @param $logIn
	 * It is a TemplateLogin object.
	 *
	 * @param $logInCaptcha
	 * It is a TemplateLoginCaptcha object.
	 *
	 * @param $beforeCaptcha
	 * It is the count of unsuccessful tries, before Captcha template rise.
	 *
	 * @return none
	 */
	function __construct(TemplateLogout$logOut,TemplateLogin $logIn,TemplateLoginCaptcha $logInCaptcha=null,$beforeCaptcha=3)
	{
		$this->logIn=$logIn;
		$this->logOut=$logOut;
		$this->logInCaptcha=$logInCaptcha;
		$this->beforeCaptcha=$beforeCaptcha;
		$this->setSessionhandler(new PhpSessionHandler());
		$this->setUserDataHandler(new PhpPostHandler());
	}


	/**
	 * Handles values form the authentication form.
	 *
	 * @return String
	 */
	private function handleUserValues()
	{

		if($this->logOut->getAuth()->isLoggedIn()
			&&
			!$this->userDataHandler->getValue(TemplateInterface::USER_NAME_VALUE_FOR_HTML_FORM_INPUT)
			&&
			!$this->userDataHandler->getValue(TemplateInterface::USER_PASS_VALUE_FOR_HTML_FORM_INPUT)
			&&
			$this->userDataHandler->getValue(TemplateInterface::SUBMIT_INDEX_VALUE__FOR_HTML_FORM_INPUT)
			
			)
		{
			$this->sessionHandler->setValue(TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT,0);
			$this->logOut->getAuth()->logOut();
		}
		else
		{
			$user;$pass;
			if($this->userDataHandler->getValue(TemplateInterface::USER_NAME_VALUE_FOR_HTML_FORM_INPUT)){
				$user=$this->userDataHandler->getValue(TemplateInterface::USER_NAME_VALUE_FOR_HTML_FORM_INPUT);
			}

			if($this->userDataHandler->getValue(TemplateInterface::USER_PASS_VALUE_FOR_HTML_FORM_INPUT)){
				$pass=$this->userDataHandler->getValue(TemplateInterface::USER_PASS_VALUE_FOR_HTML_FORM_INPUT);
			}
			if(!empty($user)&&!empty($pass)){

				if($this->sessionHandler->getValue(TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT)<=$this->beforeCaptcha-1){
					$this->logOut->getAuth()->logIn($user,$pass);
				}else{
					//this little hacking is for the unittests.
					if(!isset($this->userDataHandler->test)){
						$image = new Securimage();
						if ($image->check($this->userDataHandler->getValue(TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT)) == true) {
						  $this->logOut->getAuth()->logIn($user,$pass);
						}						
					}
				}
			}
		}
	}

	/**
	 * Sets the session handler interface.
	 *
	 * @param PhpSessionHandlerInerface $sessionHandler
	 * @return none
	 */
	public function setSessionhandler(SessionHandlerInterface $sessionHandler){
		$this->sessionHandler=$sessionHandler;
	}
	
	public function setUserDataHandler(GlobalHandlerInterface $handler){
		$this->userDataHandler=$handler;	
	}

	/**
	 * This function is the reason why this class defined
	 *
	 * @return String
	 */
	public function show()
	{
		//This value stores the actual calculated value for the template.
		$meHtml='';
		$sid=$this->sessionHandler->session_id();
		$this->handleUserValues();

		if(empty($sid)&&(!empty($this->logInCaptcha))){
			throw new Exception('If you wish to use captcha support in UACP, please start the session, with session_start(), or simply enable the session auto start feature.');
		}


		if (!$this->logOut->getAuth()->isLoggedIn())
		{
			if(!empty($this->logInCaptcha)){
				
				if($this->userDataHandler->getValue(TemplateInterface::USER_NAME_VALUE_FOR_HTML_FORM_INPUT)){
					if(!$this->sessionHandler->getValue(TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT)){

					$this->sessionHandler->setValue(TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT,0);
					}
					$this->sessionHandler->setValue(TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT,$this->sessionHandler->getValue(TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT)+1);
					if($this->sessionHandler->getValue(TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT)>=$this->beforeCaptcha){
							$meHtml=$this->logInCaptcha->show();
						}
						else{
							$meHtml=$this->logIn->show();
						}
					
				}
				else{
					if($this->sessionHandler->getValue(TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT)>=$this->beforeCaptcha){
						$meHtml=$this->logInCaptcha->show();											
					}else{
						$meHtml=$this->logIn->show();
					}
				}
			}
			/*
			 * If there is no template object for captcha is initialized, and
			 * there is no session has started.
			 */
			else{
					$meHtml=$this->logIn->show();
			}

		}
		else
		{
			$meHtml=$this->logOut->show();
		}
		return $meHtml;
	}
}
?>