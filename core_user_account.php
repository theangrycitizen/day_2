<?php
	
	
	
	
	// Core files
	
	include("core.php");
	
	
	
	
	// Check if logged in
	
	session_start();
	
	if ($_SESSION['user_login'] != "true")
	{
		header('Location: core_login.php');
	}
	
	
	
	
	// Check if User
	
	if (!isset($_GET['user_id']))
	{
		header('Location: index.php');
	}
	
	
	
	
	// Check if Admin
	
	if ($_SESSION['user_level'] != "3" && $_GET['user_id'] != $_SESSION['user_id'])
	{
		header('Location: index.php');
	}
	
	
	
	
	// Check if User Exists
	
	if (!user_id_exists($_GET['user_id']))
	{
		header('Location: admin_user_manage.php');
	}
	
	
	
	
	// User Avatar

	if (isset($_FILES["user_account_avatar"]["type"]))
	{	
		$validextensions = array("jpg", "jpeg", "png");
		$temporary = explode(".", $_FILES["user_account_avatar"]["name"]);
		$file_extension = end($temporary);
		
		if ($_FILES["user_account_avatar"]["size"] < 100000000 && $_FILES["user_account_avatar"]["size"] > 1) 
		{
			if ($_FILES["user_account_avatar"]["error"] > 0)
			{
				exit;
			}
			else
			{
				if (strpos($_FILES['user_account_avatar']['name'],".jpg") != false || strpos($_FILES['user_account_avatar']['name'],".jpeg") != false)
				{
					if (file_exists($avatars . "/" . $_GET['user_id'] . ".jpg")) {unlink($avatars . "/" . $_GET['user_id'] . ".jpg");}
					if (file_exists($avatars . "/" . $_GET['user_id'] . ".png")) {unlink($avatars . "/" . $_GET['user_id'] . ".png");}
					move_uploaded_file($_FILES['user_account_avatar']['tmp_name'],$avatars . "/" . $_GET['user_id'] . ".jpg");
				}
			
				if (strpos($_FILES['user_account_avatar']['name'],".png") != false)
				{
					if (file_exists($avatars . "/" . $_GET['user_id'] . ".jpg")) {unlink($avatars . "/" . $_GET['user_id'] . ".jpg");}
					if (file_exists($avatars . "/" . $_GET['user_id'] . ".png")) {unlink($avatars . "/" . $_GET['user_id'] . ".png");}
					move_uploaded_file($_FILES['user_account_avatar']['tmp_name'],$avatars . "/" . $_GET['user_id'] . ".png");
				}
			} 
		}
	}
	
	
	
	
	// User Username
	
	if (isset($_POST['user_account_username']))
	{
		if ($_POST['user_account_username'] != "" && $_POST['user_account_username'] != $text_user_account[2])
		{
			edit_username($_GET['user_id'],$_POST['user_account_username']);
		}
	}
	
	
	
	
	// User Email
	
	if (isset($_POST['user_account_email']))
	{
		if ($_POST['user_account_email'] != "" && $_POST['user_account_email'] != $text_user_account[3])
		{
			edit_email($_GET['user_id'],$_POST['user_account_email']);
		}
	}
	
	
	
	
	// User Password
	
	if (isset($_POST['user_account_password']))
	{
		if ($_POST['user_account_password'] != "" && $_POST['user_account_password'] != $text_user_account[4])
		{
			edit_password($_GET['user_id'],$_POST['user_account_password']);
		}
	}
	
	
	
	
	// User Level
	
	if (isset($_POST['user_account_level']))
	{
		edit_level($_GET['user_id'],$_POST['user_account_level']);
	}
	
	
	
	
	// Redirect
	
	if (!empty($_POST))
	{
		header('Location:' . $_SERVER['PHP_SELF'] . '?user_id=' . $_GET['user_id']);
	}
	
	
	
	
	// Content files
	
	include("core_header.php");
 
?>

	<div class="content_background background_white"></div>
	
	<div class="content_holder">
		
		<div class="content">
			
			<div class="content_inner">
			
				<div class="content_inner_content">
		
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>?user_id=<?php echo $_GET['user_id']; ?>" method="post" enctype="multipart/form-data">
							
						<div class="content_block width_medium background_white center_horizontal radius_small padding_medium <?php if ($_SESSION['user_level'] == "3") {echo "margin_medium";} ?>">
							
							<div class="headline_medium margin_small"><?php echo $text_user_account[0]; ?></div>
							<div class="headline_small margin_medium"><?php echo $text_user_account[1]; ?></div>
							<input type="hidden" id="user_account_user" name="user_account_user" value="<?php echo $_GET['user_id']; ?>"/> 
							<div class="avatar_large center_horizontal background_light margin_medium radius_large" style="background-image:url('<?php echo user_avatar($_GET['user_id']); ?>');"><input class="masked" type="file" id="user_account_avatar" name="user_account_avatar"/></div>
							<input class="input background_gray_light margin_small radius_small" type="text" id="user_account_username" name="user_account_username" value="<?php if (user_username($_GET['user_id']) == "") {echo $text_user_account[2];} else {echo user_username($_GET['user_id']);} ?>" onfocus="if(this.value == '<?php echo $text_user_account[2]; ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo $text_user_account[2]; ?>';}"/>
							<input class="input background_gray_light margin_small radius_small" type="text" id="user_account_email" name="user_account_email" value="<?php echo user_email($_GET['user_id']); ?>" onfocus="if(this.value == '<?php echo $text_user_account[3]; ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo $text_user_account[3]; ?>';}" onkeyup="check_user_account_email()"/>
							<input class="input background_gray_light margin_medium radius_small" type="password" id="user_account_password" name="user_account_password" value="<?php echo $text_user_account[4]; ?>" onfocus="if(this.value == '<?php echo $text_user_account[4]; ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo $text_user_account[4]; ?>';}"/>
							<input class="button background_app color_white radius_small" type="submit" value="<?php echo $text_core[0]; ?>" onclick="return check_settings()"/> 
					
						</div>
						
						<div class="content_block width_medium background_white center_horizontal radius_small padding_medium" <?php if ($_SESSION['user_level'] != "3") {echo "style=\"display:none;\"";} ?>>
					
							<div class="headline_medium margin_small"><?php echo $text_user_account[5]; ?></div>
							<div class="headline_small margin_medium"><?php echo $text_user_account[6]; ?></div>
							<select class="input background_gray_light margin_medium radius_small" id="user_account_level" name="user_account_level">
								<option <?php if (user_level($_GET['user_id']) == "1") {echo "selected"; } ?> value="1"><?php echo $text_levels[1]; ?></option>
								<option <?php if (user_level($_GET['user_id']) == "2") {echo "selected"; } ?> value="2"><?php echo $text_levels[2]; ?></option> 
								<option <?php if (user_level($_GET['user_id']) == "3") {echo "selected"; } ?> value="3"><?php echo $text_levels[3]; ?></option>
							</select> 
							<input class="button background_app color_white radius_small" type="submit" value="<?php echo $text_core[0]; ?>" onclick="return check_settings()"/> 
					
						</div>
						
					</form>	
			
				</div>
			
			</div>
			
		</div>
		
	</div>
	
	<style>
	
		.popup_dialog
		{
			display:none !important;
		}
	
	</style>
	
<?php 
	
	
	
	
	// Content files
	
	include("core_content_header.php");
	include("core_content_footer.php");
	include("core_footer.php");
	
?>