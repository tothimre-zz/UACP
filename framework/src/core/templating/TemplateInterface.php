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
 *This interface contains a few constants
 */
interface TemplateInterface {
  
  const INPUT_HANDLER_URL_INDEX          ='HandlerUrl';
  const SUBMIT_INDEX_FOR_HTML_FORM_INPUT      ='InputSubmitString';
  const SUBMIT_INDEX_VALUE__FOR_HTML_FORM_INPUT   ='uacp_submit';
  const USER_NAME_INDEX_FOR_HTML_FORM_INPUT      ='UsernameInputString';
  const USER_NAME_VALUE_FOR_HTML_FORM_INPUT      ='uacp_user';
  const USER_PASS_INDEX_FOR_HTML_FORM_INPUT      ='PasswordInputString';
  const USER_PASS_VALUE_FOR_HTML_FORM_INPUT      ='uacp_pass';
  const USER_NAME_LABEL_INDEX            ='UsernameLabel';
  const CAPTCHA_IMAGE_INDEX            ='CaptchaImage';
  const CAPTCHA_INPUT_INDEX_FOR_HTML_FORM_INPUT   ='CaptchaInputString';
   const CAPTCHA_INPUT_VALUE_FOR_HTML_FORM_INPUT   ='captcha_code';
}
?>
