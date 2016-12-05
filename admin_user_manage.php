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
	
	
	
	
	// Content files
	
	include("core_header.php");
 
?>

	<div class="content_background background_white"></div>
	
	<div class="content_holder">
		
		<div class="content">
			
			<div class="content_inner">
			
				<div class="content_inner_content">
		
		<div class="content_center">
			<div class="content_menu background_white margin_medium radius_small">
				<input class="content_menu_search" type="text" id="users_manage_search" name="users_manage_search" value="<?php echo $text_admin_user_manage[0]; ?>" onfocus="if(this.value == '<?php echo $text_admin_user_manage[0]; ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo $text_admin_user_manage[0]; ?>';}" onkeyup="users_manage_search()"/>
				<div class="content_menu_sort" onclick="users_manage_username()"><?php echo $text_admin_user_manage[1]; ?></div>
				<div class="content_menu_sort" onclick="users_manage_joined()"><?php echo $text_admin_user_manage[2]; ?></div>
				<div class="content_menu_sort" onclick="users_manage_level()"><?php echo $text_admin_user_manage[4]; ?></div>
				<a href="admin_user_add.php" class="content_menu_button"><?php echo $text_admin_user_manage[5]; ?></a>
			</div>
			
			<div class="content_block" id="users_manage">
			 
				<?php
			
					$users = users();
				
					foreach ($users as $user)
					{
						$user_id = $user["user_id"];
						
						if ($user["user_username"] == "")
						{
							$user_username = $text_user_account[2];
						}
						else
						{
							$user_username = $user["user_username"];
						}
						
						$user_email = $user["user_email"];
						
						if ($user["user_level"] == "1")
						{
							$user_level = $text_levels[1];
							$user_level_key = "1";
						}
						if ($user["user_level"] == "2")
						{
							$user_level = $text_levels[2];
							$user_level_key = "2";
						}
						if ($user["user_level"] == "3")
						{
							$user_level = $text_levels[3];
							$user_level_key = "3";
						}
						
						if ($user["user_membership_level"] == "1")
						{
							$user_membership_level = $text_membership[1];
							$user_membership_key = "1";
						}
						if ($user["user_membership_level"] == "2")
						{
							$user_membership_level = $text_membership[2];
							$user_membership_key = "2";
						}
						if ($user["user_membership_level"] == "3")
						{
							$user_membership_level = $text_membership[3];
							$user_membership_key = "3";
						}
						
						$user_joined = str_replace(".","",str_replace(",","",str_replace(":","",$user["user_joined"])));
						 	
				?>
			
						<div class="content_block background_white padding_small margin_small radius_small users_manage_user">
							<div class="avatar_mini background_light radius_large" style="background-image:url('<?php echo user_avatar($user_id); ?>');"></div>
							<div class="user_username" style="width:auto;"><?php echo $user_username; ?></div>	
							<div class="users_manage_username hidden"><?php echo $user_username; ?></div>
							<div class="users_manage_email hidden"><?php echo $user_email; ?></div>
							<div class="users_manage_membership_name hidden"><?php echo $user_membership_level; ?></div>
							<div class="users_manage_membership_key hidden"><?php echo $user_membership_key; ?></div>
							<div class="users_manage_level_name hidden"><?php echo $user_level; ?></div>
							<div class="users_manage_level_key hidden"><?php echo $user_level_key; ?></div>
							<div class="users_manage_joined hidden"><?php echo $user_joined; ?></div>
							<a href="core_user_account.php?user_id=<?php echo $user_id; ?>" target="_self" class="user_button" style="margin-left:-80px; background-image:url('resource/img/edit_dark.png');"></a>
							<a href="core_user.php?delete=user&user_id=<?php echo $user_id; ?>" target="_self" class="user_button" style="margin-left:-40px; background-image:url('resource/img/delete_dark.png');"></a> 
						</div>
			
				<?php
			
					}
			
				?>
			
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