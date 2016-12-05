<?php




	// Destroy session
	
	session_start();
	session_destroy();
	
	
	
	
	// Redirect
	
	header("Location: core_login.php");

?>