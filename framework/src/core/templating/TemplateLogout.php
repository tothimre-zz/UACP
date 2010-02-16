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
 * 
 * 
 */
class TemplateLogout extends Template{

	/**
	 * It is an instance of the InterfaceAuth it is 
	 *  
	 * @var InterfaceAuth
	 */
	private $auth=null;

	/**
	 *
	 * @var GetUserNameInterface
	 */
	private $getUserNameInterface=null;

	/**
	 *
	 * @param string $template
	 * @param InterfaceAuth $auth
	 * @param string $handleUrl
	 * @param GetUserNameInterface $getUserNameInterface
	 */
	function __construct($template=null, InterfaceAuth $auth=null, $handleUrl=null, $getUserNameInterface=null){
		parent::__construct($template,$handleUrl);
		$this->auth=$auth;
		if($getUserNameInterface!=null)
			$this->setGetUserNameInterface($getUserNameInterface);
	}
	
	/**
	 * Redefines the original function, or extends it by giving more template 
	 * variables regarding the logout process 
	 * @see core/templating/Template#getTemplateVars()
	 */
	protected function getTemplateVars(){
		$tmplElements=parent::getTemplateVars();
		if ($this->getUserNameInterface!=null)
			$tmplElements[TemplateInterface::USER_NAME_LABEL_INDEX]=$this->getUserNameInterface->getUserName();
		return $tmplElements;
	}

	public function getAuth(){
		return $this->auth;
	}

	public function setGetUserNameInterface(getUserNameInterface $getUserNameInterface){
		$this->getUserNameInterface=$getUserNameInterface;
	}
}

?>