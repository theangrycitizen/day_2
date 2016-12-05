<?php
	
	
	
	
	// Core files
	
	include("core.php");
	
	
	
	
	// Check if logged in
	
	session_start();
	
	if ($_SESSION['user_login'] != "true")
	{
		header('Location: core_login.php');
	}
	
	
	
	
	// Check permission
	
	if ($_SESSION['user_level'] != "3")
	{
		header('Location: index.php');
	}
	
	
	
	
	// Application Title
	
	if (isset($_POST['core_application_title']))
	{
		if ($_POST['core_application_title'] != "" && $_POST['core_application_title'] != $text_admin_setting[2])
		{
			edit_core_application_title($_POST['core_application_title']);
		}
	}
	
	
	
	
	// Contact Mail
	
	if (isset($_POST['core_contact_mail']))
	{
		if ($_POST['core_contact_mail'] != "" && $_POST['core_contact_mail'] != $text_admin_setting[3])
		{
			edit_core_contact_mail($_POST['core_contact_mail']);
		}
	}
	
	
	
	
	// Redirect
	
	if (!empty($_POST))
	{
		header('Location:' . $_SERVER['PHP_SELF']);
	}
	
	
	
	
	// Content files
	
	include("core_header.php");
 
?>

	<div class="content_background background_white"></div>
	
	<div class="content_holder">
		
		<div class="content">
			
			<div class="content_inner">
			
				<div class="content_inner_content">
		
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
						
						<div class="content_block width_medium background_white center_horizontal radius_small padding_medium margin_medium">
							
							<div class="headline_medium margin_small"><?php echo $text_admin_setting[0]; ?></div>
							<div class="headline_small margin_medium"><?php echo $text_admin_setting[1]; ?></div>
							<input class="input background_gray_light margin_small radius_small" type="text" id="core_application_title" name="core_application_title" value="<?php echo core_application_title(); ?>" onfocus="if(this.value == '<?php echo $text_admin_setting[2]; ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo $text_admin_setting[2]; ?>';}"/>
							<input class="input background_gray_light margin_medium radius_small" type="text" id="core_contact_mail" name="core_contact_mail" value="<?php echo core_contact_mail(); ?>" onfocus="if(this.value == '<?php echo $text_admin_setting[3]; ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo $text_admin_setting[3]; ?>';}"/>
							<input class="button background_app color_white radius_small" type="submit" value="<?php echo $text_core[0]; ?>" onclick="return check_settings()"/> 
					
						</div>
							
					</form>	
			
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