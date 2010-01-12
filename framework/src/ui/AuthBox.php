<?php 
/**
 * Te purpose if this class is to give back a html login box.
 * 
 * @author tothi
 *
 */
class AuthBox 
{

	/** 
	 * @var String
	 * This variable
	 */
	private $formAction;
	
	private $loginElements;
	
	/**
	 * 
	 * @param InterfaceAuth $Auth
	 *
	 * @param Sting $FormHandlerString
	 * This represents an url that is the value of the html form that handles
	 * the login/logout process. It is the action of the form.
	 */
	function __construct(InterfaceLoginElements $loginElements,$formHandlerString) 
	{
		$this->loginElements=$loginElements;
		$this->formAction=$formHandlerString;
	}
	
	/**
	 * This finction returns with te value of the $_POST eviroment variable if
	 * it is not null.
	 * 
	 * @return array or null;
	 */
	private function getParams()
	{
		$params=null;
		if(isset($_POST))
			if(!empty($_POST))
			{
				$params=$_POST;
			}
		return $params;
	}
	
	/**
	 * Handles the auth box sumbitted values 
	 */
	private function handleForm()
	{		
		$params=$this->getParams();
		if ($params)
		{
			if($this->loginElements->getAuth()->isLoggedIn())
			{
					$this->loginElements->getAuth()->logOut();
			}
			else
			{
				$this->loginElements->getAuth()->
						logIn($params['uacp_user'],$params['uacp_pass']);
			}
		}
	}
	
	/**
	 * This function is the reashon why this cass defined
	 * @return unknown_type
	 */
	public function show()
	{
		$this->handleForm();
		
		if (!$this->loginElements->getAuth()->isLoggedIn())
		{
			$meHtml='<form action="'.$this->formAction.'" method="post">';
			
			$meHtml.= '<div class="ucp_login" 
						   id="ucp_login_id">';
			
			$meHtml.='<div class="ucp_username_label" 
						   id="ucp_username_label_id">UserName:<div>';
			
			$meHtml.='<div class="ucp_user_input_conatiner" 
						   id="ucp_user_input_conatiner_id">'.$this->loginElements->getInputUser().'</div>';
			
			$meHtml.='<div class="ucp_passwordlabel" 
						   id="ucp_passwordlabel_id">Password:<div>';
			
			$meHtml.='<div class="ucp_user_password_conatiner" 
						   id="ucp_user_password_conatiner_id">'.$this->loginElements->getInputPassword().'</div>';
			
			$meHtml.='<div class="ucp_user_submit_conatiner" 
						   id="ucp_user_submit_conatiner_id">'.$this->loginElements->getSubmit().'</div>';
			
			$meHtml.='</div>';
			$meHtml.='</form>';
			
			return $meHtml;
			
		}
		else
		{
			$meHtml='<form action="'.$this->formAction.'" method="post">';
			$meHtml.= '<div class="ucp_login" 
						   id="ucp_login_id">';
			
			$meHtml.='<div class="ucp_username_label" 
						   id="ucp_username_label_id">UserName:<div>';
			
			$meHtml.='<div class="ucp_user_sting_conatiner" 
						   id="ucp_user_stringt_conatiner_id">'.$this->loginElements->getUserString().'</div>';
						
			$meHtml.='<div class="ucp_user_submit_conatiner" 
						   id="ucp_user_submit_conatiner_id">'.$this->loginElements->getSubmit().'</div>';
			
			$meHtml.='</div>';
			$meHtml.='</form>';
			
			return $meHtml;
						
		}
	}
}
?>