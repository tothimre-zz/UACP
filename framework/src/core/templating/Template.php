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
 * Each template class ectends this class it contains the basic functionality 
 * for the templating that is implemented by the framework. 
 * 
 * @abstract 
 */
abstract class Template{

	/**
	 * In this variable is stored the template. 
	 * @var string
	 */
	private $template;
	
	/**
	 * The form action is stored here. 
	 * @var string
	 */
	private $handleUrl;
	
	/**
	 * 
	 * @param $template
	 * @param $handleUrl
	 * @return unknown_type
	 */
	function __construct($template=null,$handleUrl=null){
		
		$this->setTemplate($template);
		
		if ($handleUrl==null){
			$this->handleUrl=$_SERVER["PHP_SELF"];
		}
		else{
			$this->handleUrl=$handleUrl;
		}
	}
	
	/**
	 * This sets the template.
	 * 
	 * @param strinf $template
	 */
	public function setTemplate($template){
		$this->template=$template;
		
	}
	
	/**
	 * Gets the url that handles the form of the login.
	 * 
	 * @return string
	 */
	public function getHandlerUrl(){
		return $this->handleUrl;
	}
	
	/**
	 * Gives back the name of the html form input the represents the submit 
	 * button that sends the page.
	 * 
	 * @return sting
	 */
	public function getInputSubmitString(){
		return 'uacp_submit';
	}
		
	/**
	 * returns an array indexed, by the template strings and the values they 
	 * should replaced with. 
	 * 
	 * @return string
	 */
	protected function getTemplateVars(){
		$tmplElements['HandlerUrl']=$this->getHandlerUrl();
		$tmplElements['InputSubmitString']='uacp_submit';
		return $tmplElements;
	}
	
	/**
	 * Manages the value replcement of the template strings to the valid html
	 * values.
	 * 
	 * @return string
	 */
	public function show(){
		
		if($this->template==null){
			throw new Exception('Please define the template by using the setTemplate() function of this class or bassing it to it\'s constructor');
		}
		
		$tpl=$this->template;
		
        foreach($this->getTemplateVars() as $name=>$value) {

            $tpl = str_replace('{' . $name . '}', $value, $tpl);
        }
        
        return $tpl;
	}
	
	
}
?>