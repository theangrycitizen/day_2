<?php




	// Error reporting

	error_reporting(1);
	ini_set("display_errors", 1);
	
	
	
	
	// Database implementation
	
	$database = new PDO("sqlite:database.sqlite");
	
	
	
	
	// Core files
	
	include("core_user.php");
	include("core_membership.php");
	include("core_setting.php");
	include("core_payment.php");
	include("core_mail.php");
	
	
	
	
	// Language files
	
	include("language/english.php");

?>