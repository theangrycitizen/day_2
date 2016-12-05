<?php
	
	
	
	
	// Core files
	
	include("core.php");
	include("core_compress.php");
	
	
	
	
	// Check if logged in
	
	session_start();
	
	if ($_SESSION['user_login'] != "true")
	{
		header('Location: login.php');
	}
	
	
	
	
	// Check if Admin
	
	if ($_SESSION['user_level'] != "3")
	{
		header('Location: index.php');
	}
	
	
	
	
	// Content files
	
	include("core_header.php");
 
?>

	<div class="content_background background_white"></div>
	
	<div class="content_holder">
		
		<div class="content">
			
			<div class="content_inner">
			
				<div class="content_inner_content">
								
					<a href="admin_user_manage.php" target="_self" class="content_block background_white padding_small margin_small radius_small admin_menu_box" style="background-image:url('resource/img/admin_manage_users.png');"><?php echo $text_admin[0]; ?></a>
					<a href="admin_setting_settings.php" target="_self" class="content_block background_white padding_small margin_small radius_small admin_menu_box" style="background-image:url('resource/img/admin_system_settings.png');"><?php echo $text_admin[3]; ?></a>
					
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