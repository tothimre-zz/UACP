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

require_once 'framework/tests/unit/UacpMockFactoryTestCase.php';

/**
 * This unittest is a tester for the Template, TemplateLogin, TemplateCaptcha, 
 * and Template Logout Classes.The class testes their show() functionality.
 */
class TemplateTest extends UacpMockFactoryTestCase
{
  public function testShow()
  {
    $tpl='{InputSubmitString}{UsernameInputString}{PasswordInputString}{HandlerUrl}';
    
    $TemplateLogin=new TemplateLogin($tpl,'testurl');
    
    $this->assertTrue($tpl!=$TemplateLogin->show());
    $this->assertTrue((strpos($TemplateLogin->show(),'{')==false));
    $this->assertTrue((strpos($TemplateLogin->show(),'}')==false));
    
  }  
}
?>
