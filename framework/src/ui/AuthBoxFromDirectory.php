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

namespace Uacp\Ui;

class AuthBoxFromDirectory extends AuthBoxFromTemplateFiles
{
  const LOGIN='login.tpl';
  const LOGOUT='logout.tpl';
  const LOGIN_CAPTCHA='login_captcha.tpl';

  /**
   * The constructor expects a TemplateLogout instance because from this
   * all the other templates could got the needed information for the
   * initialization.
   *
   * @param InterfaceAuth $auth
   * @param $directory
   *
   */
  function __construct($InterfaceAuth, $getUserNameInterface=null,$directory)
  {
    parent::__construct($InterfaceAuth, $getUserNameInterface);
    $this->setLoginTemplateFormFile($directory.'/'.self::LOGIN);
    $this->setLogoutTemplateFromFile($directory.'/'.self::LOGOUT);
    $this->setLoginCaptchaTemplateFromFile($directory.'/'.self::LOGIN_CAPTCHA);

  }
}

?>
