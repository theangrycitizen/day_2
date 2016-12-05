<?php
	
	
	
	
	// Core files
	
	include("core.php");
	
	
	
	
	// Check if logged in
	
	session_start();
	
	if ($_SESSION['user_login'] != "true")
	{
		header('Location: index.php');
	}
	
	
	
	
	// Check permission
	
	if ($_SESSION['user_level'] != "3")
	{
		header('Location: index.php');
	}
	
	
	
	
	// Check for data
	
	if (isset($_POST['user_add_email']) && isset($_POST['user_add_password']))
	{
		if ($_POST['user_add_email'] != "" && $_POST['user_add_email'] != $text_settings[3] && $_POST['user_add_password'] != "" && $_POST['user_add_password'] != $text_settings[4])
		{
			register_user($_POST['user_add_email'],$_POST['user_add_password']);
		}
	
		header('Location: core_user_account.php?user_id=' . user_id($_POST['user_add_email']));
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
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<div class="headline_medium margin_small"><?php echo $text_admin_user_add[0]; ?></div>
							<div class="headline_small margin_medium"><?php echo $text_admin_user_add[1]; ?></div>
							<input class="input background_gray_light margin_small radius_small" type="text" id="user_add_email" name="user_add_email" value="<?php echo $text_admin_user_add[2]; ?>" onfocus="if(this.value == '<?php echo $text_admin_user_add[2]; ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo $text_admin_user_add[2]; ?>';}" onkeyup="check_user_add_email()" onchange="check_user_add_email()"/>
							<input class="input background_gray_light margin_medium radius_small" type="password" id="user_add_password" name="user_add_password" value="<?php echo $text_admin_user_add[3]; ?>" onfocus="if(this.value == '<?php echo $text_admin_user_add[3]; ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo $text_admin_user_add[3]; ?>';}"/>
							<input class="button background_app color_white radius_small" type="submit" value="<?php echo $text_admin_user_add[4]; ?>" onclick="return check_user_add()"/> 
						</form>	
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