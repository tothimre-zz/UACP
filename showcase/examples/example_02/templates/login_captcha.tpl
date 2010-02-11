<STYLE TYPE="text/css" MEDIA="screen, projection">
<!--
  @import url(templates/css/style.css);
-->
</STYLE>

<form action="{HandlerUrl}" method="post">
	<div class="uacp_login" id="uacp_login_id">	
		<div class="uacp_username_label" id="uacp_username_label_id">UserName:<div>
		
		<div class="uacp_user_input_conatiner" id="uacp_user_input_conatiner_id">
			<input type="text" name="{UsernameInputString}" class="uacp_user" id="uacp_user_id">
		</div>
		
		<div class="uacp_passwordlabel" id="uacp_passwordlabel_id">Password:<div>
		
		<div class="uacp_user_password_conatiner" id="uacp_user_password_conatiner_id">
			<input type="password" name="{PasswordInputString}" class="uacp_pass" id="uacp_pass_id">
		</div>
		<div class="uacp_user_submit_conatiner" id="uacp_user_submit_conatiner_id">
			<input type="submit" name="{InputSubmitString}" value="Log In" class="uacp_submit" id="uacp_submit_id">
		</div>
		
		<div class="uacp_capthca_image_container" id="uacp_capthca_container_id">
			{CaptchaImage}
		</div>
		<div class="uacp_captcha_input_container" id="uacp_captcha_input_container_id">
			<input type="text" name="{CaptchaInputString}" class="uacp_captcha_input" id="uacp_captcha_input_id">
		</div>
	</div>
</form>