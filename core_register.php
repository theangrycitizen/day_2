<?php
	
	
	
	
	// Core files
	
	include("core.php");
	
	
	
	
	// Check if logged in
	
	session_start();
	
	if ($_SESSION['user_login'] == "true")
	{
		header('Location: index.php');
	}
	
	
	
	
	// Check login

	if (isset($_POST['register_email']) && isset($_POST['register_password']))
	{
		register_user(trim($_POST['register_email']),trim($_POST['register_password']));
		send_register_mail(trim($_POST['register_email']));
		header('Location: core_login.php');
	}
	
	
	
	
	// Content files
	
	include("core_header.php");
 
?>

	<div class="content_background background_white"></div>
	
	<div class="content_holder">
		
		<div class="content">
			
			<div class="content_inner">
			
				<div class="content_inner_content">
		
					<div class="dialog_small background_white center_horizontal radius_small padding_medium">
						<div class="headline_medium margin_small"><?php echo $text_register[0]; ?></div>
						<div class="headline_small margin_medium"><?php echo $text_register[1]; ?></div>
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<input class="input background_gray_light margin_small radius_small" type="text" id="register_email" name="register_email" value="<?php echo $text_loginregister[0]; ?>" onfocus="if(this.value == '<?php echo $text_loginregister[0]; ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo $text_loginregister[0]; ?>';}" onkeyup="check_register_email()" onchange="check_register_email()"/>
							<input class="input background_gray_light margin_medium radius_small" type="password" id="register_password" name="register_password" value="<?php echo $text_loginregister[1]; ?>" onfocus="if(this.value == '<?php echo $text_loginregister[1]; ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo $text_loginregister[1]; ?>';}"/>
							<input class="button background_app margin_medium color_white radius_small" type="submit" value="<?php echo $text_register[2]; ?>" onclick="return check_register()"/>
						</form>
						<a href="core_login.php" target="_self" class="textbutton color_gray_medium"><?php echo $text_register[3]; ?></a>
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
<?php 
	
	
	
	
	// Content files
	
	include("core_content_header.php");
	include("core_content_footer.php");
	include("core_footer.php");
	
?>