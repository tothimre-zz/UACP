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

use Uacp\Core\Templating\AuthTemplate;
use Uacp\Core\Templating\TemplateLogout;
use Uacp\Core\Templating\TemplateLogin;
use Uacp\Core\Templating\TemplateLoginCaptcha;
/**
 *
 * The implemetations of this class take care for the user iterface.
 *
 * @abstract
 *
 */
abstract class AuthBoxProto extends AuthTemplate
{
  /**
   *
   * @var InterfaceAuth
   */
  protected $auth=null;

  /**
   * The constructor expects a TemplateLogout instance because from this
   * all the other templates could got the needed information for the
   * initialistation.
   *
   * @param InterfaceAuth $auth
   * @param GetUserNameInterface $getUserNameInterface
   *
   */
  function __construct($InterfaceAuth, $getUserNameInterface=null)
  {
    /*
     * This initializes the templates without exact template strings.
     */
    $this->auth=$InterfaceAuth;
    $templateLogout=new TemplateLogout(null,$InterfaceAuth,null,$getUserNameInterface);
    $templateLogin=new TemplateLogin();
    $templateLoginCaptcha=new TemplateLoginCaptcha();
    parent::__construct($templateLogout, $templateLogin, $templateLoginCaptcha, 3);
  }

}
