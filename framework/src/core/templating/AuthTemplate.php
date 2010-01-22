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
 * Te purpose if this class is to give back a html login box.
 *
 */
class AuthTemplate
{

	/** 
	 * @var String
	 * This variable
	 */
	private $formAction;
	
	private $logIn=null;
	private $logOut=null;
	private $logInCaptcha=null;
	private $beforeCaptcha=null;
	
	function __construct(TemplateLogout$logOut,TemplateLogin $logIn,TemplateLoginCaptcha $logInCaptcha=null,$beforeCaptcha=3) 
	{
		$this->logIn=$logIn;
		$this->logOut=$logOut;
		$this->logInCaptcha=$logInCaptcha;
		$this->beforeCaptcha=$beforeCaptcha;
	}
	
	
	/**
	 * This finction returns with te value of the $_POST eviroment variable if
	 * it is not null.
	 * 
	 * @return array or null;
	 */
	private function getParams()
	{
		$params=null;
		if(isset($_POST))
			if(!empty($_POST))
			{
				$params=$_POST;
			}
		return $params;
	}
	
	/**
	 * Handles the auth box sumbitted values 
	 */
	private function handleForm()
	{		
		$params=$this->getParams();
		if ($params)
		{
			if($this->logOut->getAuth()->isLoggedIn())
			{
					$this->logOut->getAuth()->logOut();
			}
			else
			{
				$user;$pass;
				if(isset($params['uacp_user'])){
					$user=$params['uacp_user'];
				}
				
				if(isset($params['uacp_user'])){
					$pass=$params['uacp_pass'];
				}
				if(!empty($user)&&!empty($pass)){
					if($_SESSION['uacp_login_cnt']<=$this->beforeCaptcha){
					$this->logOut->getAuth()->logIn($user,$pass);
					}else{
						
						if(isset($params['captcha_code']) &&
							$_SESSION['securimage_code_value']==$params['captcha_code']){
							$this->logOut->getAuth()->logIn($user,$pass);					
						}
					}
				}
			}
		}
	}
	
	/**
	 * This function is the reashon why this cass defined
	 * @return unknown_type
	 */
	public function show()
	{
		
		$meHtml='';
		
		$sid=session_id();
		
		$this->handleForm();
		
		if (!$this->logOut->getAuth()->isLoggedIn())
		{
			
			if(!empty($sid)&&(!empty($this->logInCaptcha))){
		
				if(!isset($_SESSION['uacp_login_cnt'])){
					$_SESSION['uacp_login_cnt']=0;					
				}
					$_SESSION['uacp_login_cnt']=++$_SESSION['uacp_login_cnt'];
										
					if($_SESSION['uacp_login_cnt']>$this->beforeCaptcha){
						$meHtml=$this->logInCaptcha->show();						
					}
					else{
						$meHtml=$this->logIn->show();			
					}
			/* If the session is not started you cannot use the captcha support 
			 * in the framework
			 */
			}else if(empty($sid)&&(!empty($this->logInCaptcha))){
				//temprorary disabled
				//throw new Exception('If you wish to use Capcha support in UACP, please start the session, with session_start(), or simply enable te session autostart feature.');
			}
			
			/* If there is no template object fot captcha is initialised, and 
			 * there is no session has started 
			 * */
			
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