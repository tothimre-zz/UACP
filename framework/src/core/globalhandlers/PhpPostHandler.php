<?php 
class PhpPostHandler implements GlobalHandlerInterface{
	
	public function setValue($index,$value){
		$_POST[$index]=$value;
	}

	public function getValue($index){
		if(isset($_POST[$index])){
			return $_POST[$index];
		}
		else{
			return null;
		}
	}
}
?>