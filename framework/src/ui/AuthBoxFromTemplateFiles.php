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
 * This class is the most convinient enduser implementation of the framework,
 * howewer you are boundled to it's structure. You can customise it easily with
 * yout css definitions.
 * 
 */
class AuthBoxFromTemplateFiles extends AuthBoxProto
{

  /**
   * The constructor expects a TemplateLogout instance because from this
   * all the other templates could got the needed information for the 
   * initialistation.
   * 
   * @param TemplateLogout $templateLogout
   * @param GetUserNameInterface $getUserNameInterface
   */
  function __construct(InterfaceAuth $auth, $getUserNameInterface=null)
  {    
    parent::__construct($auth, $getUserNameInterface);
  }
  
  /**
   * This file excepts a filename where it can load the template of the 
   * login form.
   * 
   * @param string $file
   */
  public function setLoginTemplateFormFile($file){
      $this->getTemplateLogIn()->setTemplate($this->loadFile($file));

  }
  
  /**
   * This file excepts a filename where it can load the template of the 
   * logout form.
   * 
   * @param unknown_type $file
   */
  public function setLogoutTemplateFromFile($file){
      $this->getTemplateLogOut()->setTemplate($this->loadFile($file));
  }
  
  /**
   * This file excepts a filename where it can load the template of the 
   * login form with Capcha support.
   * 
   * @param string $file
   */
  public function setLoginCaptchaTemplateFromFile($file){
      $this->getTemplateLogInCaptcha()->setTemplate($this->loadFile($file));
  }
  
  /**  
   * This function takes care of the templatefile loading.
   * 
   * @return mixed
   * Returns null if there is no such a file, else the file content.
   */  
  private function loadFile($file){
    if($this->fileExist($file))
    {
      $fileData=file_get_contents ($file,true);
      
      if ($fileData){
        return $fileData;
      }
      else{
        return null;
      }

    }
  }

  protected function fileExist($file){
    return file_exists(dirname($_SERVER['SCRIPT_FILENAME']).'/'.$file);
  }

}
?>