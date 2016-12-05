<?php
	
	
	
	
	// System Functions
	
	function send_register_mail($email)
	{
		global $text_main,$text_mail_register;
	
		$user_id = user_id($email);
		$subject = $text_mail_register[0] . $text_main[0];
		$text = $text_mail_register[1];
		
		send_mail($user_id,$subject,$text);
	}
	
	function send_recover_mail($email,$password)
	{
		global $text_main,$text_mail_recover;
		
		$user_id = user_id($email);
		$subject = $text_mail_recover[0] . $text_main[0];
		$text = $text_mail_recover[1] . "<br><br>" .  $password . "<br><br>" . $text_mail_recover[2];
		
		send_mail($user_id,$subject,$text);
	}
	
	
	
	
	// Core Function
	
	function send_mail($user_id,$subject,$text)
	{
		global $text_mail,$text_main,$text_login;
		
		$email = user_email($user_id);
		$login_link = "http://" . $_SERVER['HTTP_HOST'] . "/core_login.php";

		$headers = "From: " . $text_main[0] . " <" . $text_main[1] . ">" . "\r\n";
		$headers .= "Reply-To: ". $text_main[1] . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		$message = '
					<html><body style="background:#f1f1f1;">
						<div style="position:fixed; left:0; top:0; width:100%; height:100%; background:#f1f1f1;"></div>
						<div style="position:relative; width:90%; max-width:400px; margin:0 auto; margin-top:50px; margin-bottom:50px; padding:50px; border-radius:5px; background:#fff; box-sizing:border-box; font-size:12px; line-height:20px; color:#374249;">';
		$message .= $text_mail[0] . '<br><br>';
		$message .= $text;
		$message .= "<br><br>" . $text_mail[1];
		$message .= '		<a href="' . $login_link . '" target="_blank" style="text-decoration:none;"><div style="position:relative; width:80%; max-width:160px; height:40px; background:#258cb5; font-size:12px; font-weight:bold; line-height:40px; text-align:center; text-decoration:none; color:#fff; border-radius:5px; margin:0 auto; margin-top:30px;">';
		$message .= $text_login[2];
		$message .= '		</div></a>';
		$message .= '	</div>
					</body></html>';
		
		mail($email,$subject,$message,$headers);
	}
	
	
?>