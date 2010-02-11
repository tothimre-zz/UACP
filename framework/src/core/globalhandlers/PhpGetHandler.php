<?php
class PhpGetHandler implements GlobalHandlerInterface{

	public function setValue($index,$value){
		$_GET[$index]=$value;
	}

	public function getValue($index){
		if(isset($_GET[$index])){
			return $_GET[$index];
		}
		else{
			return null;
		}
	}
}
?>