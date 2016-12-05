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

	if (isset($_POST['login_email']) && isset($_POST['login_password']))
	{
		if (login_correct(trim($_POST['login_email']),trim($_POST['login_password'])))
		{
			$_SESSION['user_login'] = "true";
			$_SESSION['user_id'] = user_id(trim($_POST['login_email']));
			$_SESSION['user_level'] = user_level(trim($_SESSION['user_id']));
			
			header('Location: index.php');
		}
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
						<div class="headline_medium margin_small"><?php echo $text_login[0]; ?></div>
						<div class="headline_small margin_medium"><?php echo $text_login[1]; ?></div>
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<input class="input background_gray_light margin_small radius_small" type="text" id="login_email" name="login_email" value="<?php echo $text_loginregister[0]; ?>" onfocus="if(this.value == '<?php echo $text_loginregister[0]; ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo $text_loginregister[0]; ?>';}" onkeyup="check_login_email()" onchange="check_login_email()"/>
							<input class="input background_gray_light margin_medium radius_small" type="password" id="login_password" name="login_password" value="<?php echo $text_loginregister[1]; ?>" onfocus="if(this.value == '<?php echo $text_loginregister[1]; ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo $text_loginregister[1]; ?>';}"/>
							<input class="button background_app color_white margin_medium radius_small" type="submit" value="<?php echo $text_login[2]; ?>" onclick="return check_login()"/>
						</form>
						<a href="core_recover.php" target="_self" class="textbutton color_gray_medium"><?php echo $text_login[3]; ?></a>
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