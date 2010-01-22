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
class TemplateLoginCaptcha extends TemplateLogin{
	
	
	/**
	 * Provides a html Image tag that idicates the captcha mechanism.
	 * 
	 * @return sring
	 */
	public function getCaptchaImage(){
		
		/* The URL_OF_UACP constant is needed to define the absolute url path 
		 * where the captcha support besides. It is not the best soloution if 
		 * because brokes the OOP paradigm, but it is the less painless for the 
		 * users you can define it at the env_config.php.  
		 */
		if(URL_OF_UACP==URL_OF_UACP_CHANGEME){
			throw new Exception('If You Would use the Chaptcha support provided by the UACP framework, please modify at the env_config.php file the value of the URL_OF_UACP constant. You will find explanation there.');
		}
		return'<img id="captcha" src="'.URL_OF_UACP.'lib/chapcha/securimage_show.php" alt="CAPTCHA Image" />';
	}
	
	/**
	 * Provides the input name of the captcha. 
	 * 
	 * @return sring
	 */
	public function getCaptchaInputString(){
		return 'captcha_code';
	}
		
	/**
	 * Redefines the original function, or extends it by giving more template 
	 * variables regarding the login process 
	 * @see core/templating/TemplateLogin#getTemplateVars()
	 */
	protected function getTemplateVars(){
		$tmplElements=parent::getTemplateVars();
		$tmplElements['CaptchaImage']=$this->getCaptchaImage();
		$tmplElements['CaptchaInputString']=$this->getCaptchaInputString();
		return $tmplElements;
	}
	
}

?>