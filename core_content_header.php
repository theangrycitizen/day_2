	<div class="header background_white">

<?php
	
	
	
	
	// Check if logged in
	
	if ($_SESSION['user_login'] == "true")
	{

?>

	<div class="header_menu_button" onclick="toggle_menu()"></div>
	<a href="index.php" class="header_logo logged_in_logo center_horizontal"><div class="header_logo_icon"><div class="header_logo_icon_inner"></div></div></a>
	
<?php

 		if ($_SESSION['user_level'] == "3")
 		{

?>
	
	<a href="admin.php" class="header_button" style="margin-left:-240px; border-left:none; border-right:1px solid #f1f1f1;"><?php echo $text_menu[4]; ?></a>

<?php

		}
	
?>
	
	<a href="core_user_account.php?user_id=<?php echo $_SESSION['user_id']; ?>" class="header_button" style="margin-left:-160px; border-left:none;"><?php echo $text_menu[3]; ?></a>
	<a href="core_logout.php" class="header_button" style="margin-left:-80px;"><?php echo $text_menu[2]; ?></a>
	
<?php

	}
	else
	{

?>

	<a href="index.php" class="header_logo center_horizontal"><div class="header_logo_icon"><div class="header_logo_icon_inner"></div></div></a>
	<a href="core_login.php" class="header_button" style="margin-left:-160px; border-left:none;" target="_self"><?php echo $text_menu[1]; ?></a>
	<a href="core_register.php" class="header_button" style="margin-left:-80px;" target="_self"><?php echo $text_menu[0]; ?></a>

<?php

	}

?>

	</div>