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
	private $FormHandlerString;
	
	private $LoginElements;
	
	/**
	 * 
	 * @param InterfaceAuth $Auth
	 *
	 * @param Sting $FormHandlerString
	 * This represents an url that is the value of the html form that handles
	 * the login/logout process.
	 */
	function __construct(InterfaceLoginElements $LoginElements,$FormHandlerString) 
	{
		$this->LoginElements=$LoginElements;
		$this->FormHandlerString=$FormHandlerString;
	}
	
	/**
	 * This function is the reashon why this cass defined
	 * @return unknown_type
	 */
	public function show()
	{
		print_r($LoginElements);
		
		if (!$this->LoginElements->getAuth()->isLoggedIn())
		{
			
			$meHtml= '<div class="ucp_login" 
						   id="ucp_login_id">';
			
			$meHtml.='<div class="ucp_username_label" 
						   id="ucp_username_label_id">UserName:<div>';
			
			$meHtml.='<div class="ucp_user_input_conatiner" 
						   id="ucp_user_input_conatiner_id">'.$this->LoginElements->getInputUser().'</div>';
			
			$meHtml.='<div class="ucp_passwordlabel" 
						   id="ucp_passwordlabel_id">Password:<div>';
			
			$meHtml.='<div class="ucp_user_password_conatiner" 
						   id="ucp_user_password_conatiner_id">'.$this->LoginElements->getInputPassword().'</div>';
			
			$meHtml.='<div class="ucp_user_submit_conatiner" 
						   id="ucp_user_submit_conatiner_id">'.$this->LoginElements->getSubmit().'</div>';
			
			$meHtml.='</div>';
			
			return $meHtml;
			
		}
		else
		{
			$meHtml= '<div class="ucp_login" 
						   id="ucp_login_id">';
			
			$meHtml.='<div class="ucp_username_label" 
						   id="ucp_username_label_id">UserName:<div>';
			
			$meHtml.='<div class="ucp_user_sting_conatiner" 
						   id="ucp_user_stringt_conatiner_id">'.$this->LoginElements->getUserString().'</div>';
						
			$meHtml.='<div class="ucp_user_submit_conatiner" 
						   id="ucp_user_submit_conatiner_id">'.$this->LoginElements->getSubmit().'</div>';
			
			$meHtml.='</div>';
			
			return $meHtml;
						
		}
	}

}
?>