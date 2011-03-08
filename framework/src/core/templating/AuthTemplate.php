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
class AuthTemplate{
  private $afterLoginUrl=null;
  private $logoutUrl=null;

  /**
   *
   * @var TemplateLogin
   */
  private $templateLogIn=null;

  /**
   *
   * @var TemplateLogout
   */
  private $templateLogOut=null;

  /**
   * @var TemplateLoginCaptcha
   */
  private $templateLogInCaptcha=null;
  
  private $beforeCaptcha=null;

  /**
   *
   * @var SessionHandlerInterface
   */
  private $sessionHandler=null;
  /**
   *
   * @var GlobalHandlerInterface
   */
  private $userDataHandler=null;

  /**
   *
   * @var PhpGetHandler
   */
  private $phpGetDataHandler=null;


  const LOGOUT_STRING='logout';

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
  function __construct(TemplateLogout $logOut,TemplateLogin $logIn,
                      TemplateLoginCaptcha $logInCaptcha=null,$beforeCaptcha=3){
    $this->templateLogIn=$logIn;
    $this->templateLogOut=$logOut;
    $this->templateLogInCaptcha=$logInCaptcha;
    $this->beforeCaptcha=$beforeCaptcha;
    $this->setSessionhandler(new PhpSessionHandler());
    $this->setUserDataHandler(new PhpPostHandler());
    $this->setGetHandler(new PhpGetHandler());

    if($this->phpGetDataHandler->getValue(self::LOGOUT_STRING)){
      if($this->templateLogOut->getAuth()->isLoggedIn()){
        $this->logout();
      }
    }
  }

  public function getAfterLoginUrl(){
    return $this->afterLoginUrl;
  }
  
  public function getLogoutUrl(){
    return $this->logoutUrl.'?logout=1';
  }


  /**
   *
   * @return TemplateLogin
   */
  public function getTemplateLogIn(){
    return   $this->templateLogIn;
  }

  /**
   *
   * @return TemplateLoginCaptcha
   */
  public function getTemplateLogInCaptcha(){
    return $this->templateLogInCaptcha;
  }

  /**
   *
   * @return TemplateLogout
   */
  public function getTemplateLogOut(){
    return $this->templateLogOut;
  }

  private function isRedirect(){
    if($this->afterLoginUrl && $this->logoutUrl){
      return true;
    }
    else{
      return false;
    }
  }

  private function handleRedirection(Template $template){
    if($this->isRedirect()){
      $redirect=false;
      if($this->sessionHandler->getValue('change_url')){
        $redirect=true;
        $this->sessionHandler->setValue('change_url',null);
      }
      if($redirect){
        if(get_class($template)==get_class($this->templateLogOut)){
          if($this->getTemplateLogOut()->getAuth()->isLoggedIn()){
            $this->redirectToAfterLogin();
          }
        }
        if(get_class($template)==get_class($this->templateLogIn) ||
          get_class($template)==get_class($this->templateLogInCaptcha)){
            if(!$this->getTemplateLogOut()->getAuth()->isLoggedIn()){
              $this->redirectToLogoutUrl();
            }
          }
        }else{
          if(!$this->getTemplateLogOut()->getAuth()->isLoggedIn()){
              $this->redirectToLogoutUrl();
            }
          else if($this->getTemplateLogOut()->getAuth()->isLoggedIn()) {
          $this->redirectToAfterLogin();
        }
      }
    }
  }
  /**
   * Handles values form the authentication form.
   *
   * @return String
   */
  private function handleUserValues(){

    if($this->templateLogOut->getAuth()->isLoggedIn()
      &&
      !$this->userDataHandler->getValue(TemplateInterface::USER_NAME_VALUE_FOR_HTML_FORM_INPUT)
      &&
      !$this->userDataHandler->getValue(TemplateInterface::USER_PASS_VALUE_FOR_HTML_FORM_INPUT)
      &&
      $this->userDataHandler->getValue(TemplateInterface::SUBMIT_INDEX_VALUE__FOR_HTML_FORM_INPUT)
      ){
      $this->logout();
    }else{
      if($this->userDataHandler->getValue(TemplateInterface::USER_NAME_VALUE_FOR_HTML_FORM_INPUT)){
        $user=$this->userDataHandler->getValue(TemplateInterface::USER_NAME_VALUE_FOR_HTML_FORM_INPUT);
      }

      if($this->userDataHandler->getValue(TemplateInterface::USER_PASS_VALUE_FOR_HTML_FORM_INPUT)){
        $pass=$this->userDataHandler->getValue(TemplateInterface::USER_PASS_VALUE_FOR_HTML_FORM_INPUT);
      }
      if(!empty($user)&&!empty($pass)){
        if($this->sessionHandler->getValue(TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT)<=$this->beforeCaptcha-1){
          $this->templateLogOut->getAuth()->logIn($user,$pass);
              if($this->templateLogOut->getAuth()->isLoggedIn()
                  &&
                  $this->isRedirect()){
              $this->sessionHandler->setValue('change_url','1');
              }

        }else{
          //this little hacking is for the unittests.
          if(!isset($this->userDataHandler->test)){
            $image = new Securimage();
            if ($image->check($this->userDataHandler->getValue(TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT)) == true) {
              $this->templateLogOut->getAuth()->logIn($user,$pass);
              if($this->templateLogOut->getAuth()->isLoggedIn()
                &&
                $this->isRedirect()){
                $this->sessionHandler->setValue('change_url','1');
              }
            }            
          }
        }
      }
    }
  }

  private function logout(){
      $this->sessionHandler->setValue(TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT,0);
      $this->templateLogOut->getAuth()->logOut();
      if($this->isRedirect())
        $this->sessionHandler->setValue('change_url','1');
  }

  /**
   *
   * @param string $url
   */
  public function setAfterLoginUrl($url){
    $this->afterLoginUrl=$url;
  }

  /**
   *
   * @param string $url
   */
  public function setLogoutUrl($url){
    $this->logoutUrl=$url;
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


  public function setTemplateLogIn(TemplateLogin $template){
    $this->templateLogIn=$template;
  }

  public function setTemplateLogInCaptcha(TemplateLoginCaptcha $template){
    $this->templateLogInCaptcha=$template;
  }

  public function setTemplateLogOut(TemplateLogout $template){
    $this->templateLogOut=$template;
  }
  
  public function setUserDataHandler(GlobalHandlerInterface $handler){
    $this->userDataHandler=$handler;
  }

  /**
   * This function sets the handler for the php $_GET array it is generalized
   * for testing reasons.
   */
  public function setGetHandler(GlobalHandlerInterface $handler){
    $this->phpGetDataHandler=$handler;
  }

  /**
   * This function is the reason why this class defined
   *
   * @return String
   */
  public function show()
  {
    $template=$this->checker();
    $this->handleRedirection($template);
    return   $this->checker()->show();
  }

  /**
   * This function is the reason why this class defined
   *
   * @return Template
   */
  private function checker()
  {

    $phpSessionId=$this->sessionHandler->session_id();
    $sessionHandlerSessionId=$this->sessionHandler->session_id();

    if(empty($phpSessionId)&&(!empty($this->templateLogInCaptcha))){
      throw new Exception('If you wish to use captcha support in UACP, please start the session, with session_start(), or simply enable the session auto start feature.');
    }
    if(empty($sessionHandlerSessionId)&&(!empty($this->afterLoginUrl)||!empty($this->logoutUrl))){
      throw new Exception('Use the Redirecting support, please start the session, with session_start(), or simply enable the session auto start feature.');
    }

        $this->handleUserValues();

    if (!$this->templateLogOut->getAuth()->isLoggedIn())
    {
      if(!empty($this->templateLogInCaptcha)){

        if($this->userDataHandler->getValue(TemplateInterface::USER_NAME_VALUE_FOR_HTML_FORM_INPUT)){
          if(!$this->sessionHandler->getValue(TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT)){

          $this->sessionHandler->setValue(TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT,0);
          }
          $this->sessionHandler->setValue(TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT,$this->sessionHandler->getValue(TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT)+1);
          if($this->sessionHandler->getValue(TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT)>=$this->beforeCaptcha){
              $actTemplate=$this->templateLogInCaptcha;
            }
            else{
              $actTemplate=$this->templateLogIn;
            }

        }
        else{
          if($this->sessionHandler->getValue(TemplateInterface::CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT)>=$this->beforeCaptcha){
            $actTemplate=$this->templateLogInCaptcha;
          }else{
            $actTemplate=$this->templateLogIn;
          }
        }
      }
      /*
       * If there is no template object for captcha is initialized, and
       * there is no session has started.
       */
      else{
          $actTemplate=$this->templateLogIn;
      }

    }
    else
    {
      $actTemplate=$this->templateLogOut;
    }


    return $actTemplate;
  }

  /**
   *
   * @param string $variableName
   */
  private function setRedirectedFrom(){
    $this->sessionHandler->setValue('rd_from', $_SERVER['PHP_SELF']);
  }
  private function getRedirectedFrom(){
    //die($this->sessionHandler->getValue('rd_from').'---'.$_SERVER['PHP_SELF']);
    return $this->sessionHandler->getValue('rd_from');
  }

  private function redirectToLogoutUrl(){
    $rd=$this->getRedirectedFrom();
    if($this->logoutUrl){
      if($rd!=$_SERVER['PHP_SELF']){
        $this->setRedirectedFrom();
        if(!headers_sent()){
          header('Location: '.$this->getLogoutUrl());
          }
        else{
          //TODO: Make the herfs!
          print'
          <SCRIPT language="JavaScript">
          <!--
            window.location="'.$this->getLogoutUrl().'";
          //-->
          </SCRIPT>

          <a>LOGGEDOUT</a>

          ';
        }
      }
    }
  }

  private function redirectToAfterLogin(){
    $rd=$this->getRedirectedFrom();
    //$this->setRedirectedFrom();
    if($this->afterLoginUrl){
      if($rd==$_SERVER['PHP_SELF']){
        if(!headers_sent()){
          header('Location: '.$this->afterLoginUrl);
        }
        else
          {
          //TODO: Make the herfs!
          print'
          <SCRIPT language="JavaScript">
          <!--
            window.location="'.$this->afterLoginUrl.'";
          //-->
          </SCRIPT>

          <a>LOGGEDIN</a>

          ';
        }
      }
    }
  }

}
?>