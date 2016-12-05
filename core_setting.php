<?php




	// Backend Functions

	// Database implementation
	
	function is_initial_settings_setup()
	{
		global $database; 
		
		$query = $database->prepare('SELECT * FROM settings');
		$query -> execute();
		$results = $query -> fetchAll();
		
		if (count($results) > 0) 
		{
  			return false;	
		}
		
		return true;
	}
    
    $database->exec("CREATE TABLE IF NOT EXISTS settings 
	(
		setting_setting_id INTEGER PRIMARY KEY AUTOINCREMENT,
		setting_setting TEXT,
		setting_setting_value TEXT
	)");
		
	if (is_initial_settings_setup()) 
    {
        $query = $database->prepare('INSERT INTO settings (setting_setting,setting_setting_value) VALUES (?,?)');
		$query -> execute(array("core_application_title",""));
		
        $query = $database->prepare('INSERT INTO settings (setting_setting,setting_setting_value) VALUES (?,?)');
		$query -> execute(array("core_contact_mail",""));
		
        $query = $database->prepare('INSERT INTO settings (setting_setting,setting_setting_value) VALUES (?,?)');
		$query -> execute(array("core_paypal_mail",""));
		
        $query = $database->prepare('INSERT INTO settings (setting_setting,setting_setting_value) VALUES (?,?)');
		$query -> execute(array("core_stripe_public",""));
		
        $query = $database->prepare('INSERT INTO settings (setting_setting,setting_setting_value) VALUES (?,?)');
		$query -> execute(array("core_stripe_secret",""));
    }
    
    
    
    
    // Application Title Functions
	
	function core_application_title()
	{
		global $database, $text_admin_setting; 
		
		$query = $database->prepare('SELECT setting_setting_value FROM settings WHERE setting_setting=?');
		$query -> execute(array("core_application_title"));
		$results = $query -> fetch();
		
		if (count($results) > 0)
		{
  			return ($results["setting_setting_value"] != "" ? $results["setting_setting_value"] : $text_admin_setting[2]);	
		}
		
		return "";
	}
	
	function edit_core_application_title($value)
	{
		global $database; 
		
		$value = trim($value);
		if(0 <= $value)
		{
			$query = $database->prepare('UPDATE settings SET setting_setting_value=? WHERE setting_setting=?');
			$query -> execute(array($value,"core_application_title"));
		}
	}
    
    
    
    
    // Contact Email Functions
	
	function core_contact_mail()
	{
		global $database, $text_admin_setting; 
		
		$query = $database->prepare('SELECT setting_setting_value FROM settings WHERE setting_setting=?');
		$query -> execute(array("core_contact_mail"));
		$results = $query -> fetch();
		
		if (count($results) > 0)
		{
  			return ($results["setting_setting_value"] != "" ? $results["setting_setting_value"] : $text_admin_setting[3]);	
		}
		
		return "";
	}
	
	function edit_core_contact_mail($value)
	{
		global $database; 
		
		$value = trim($value);
		if(0 <= $value)
		{
			$query = $database->prepare('UPDATE settings SET setting_setting_value=? WHERE setting_setting=?');
			$query -> execute(array($value,"core_contact_mail"));
		}
	}
    
    
    
    
    // Paypal Email Functions
	
	function core_paypal_mail()
	{
		global $database, $text_admin_setting; 
		
		$query = $database->prepare('SELECT setting_setting_value FROM settings WHERE setting_setting=?');
		$query -> execute(array("core_paypal_mail"));
		$results = $query -> fetch();
		
		if (count($results) > 0)
		{
  			return ($results["setting_setting_value"] != "" ? $results["setting_setting_value"] : $text_admin_setting[6]);
		}
		
		return "";
	}
	
	function edit_core_paypal_mail($value)
	{
		global $database; 
		
		$value = trim($value);
		if(0 <= $value)
		{
			$query = $database->prepare('UPDATE settings SET setting_setting_value=? WHERE setting_setting=?');
			$query -> execute(array($value,"core_paypal_mail"));
		}
	}
    
    
    
    
    // Stripe Key Functions
	
	function core_stripe_public()
	{
		global $database, $text_admin_setting; 
		
		$query = $database->prepare('SELECT setting_setting_value FROM settings WHERE setting_setting=?');
		$query -> execute(array("core_stripe_public"));
		$results = $query -> fetch();
		
		if (count($results) > 0)
		{
  			return ($results["setting_setting_value"] != "" ? $results["setting_setting_value"] : $text_admin_setting[9]);	
		}
		
		return "";
	}
	
	function edit_core_stripe_public($value)
	{
		global $database; 
		
		$value = trim($value);
		if(0 <= $value)
		{
			$query = $database->prepare('UPDATE settings SET setting_setting_value=? WHERE setting_setting=?');
			$query -> execute(array($value,"core_stripe_public"));
		}
	}

	function core_stripe_secret()
	{
		global $database, $text_admin_setting; 
		
		$query = $database->prepare('SELECT setting_setting_value FROM settings WHERE setting_setting=?');
		$query -> execute(array("core_stripe_secret"));
		$results = $query -> fetch();
		
		if (count($results) > 0)
		{
  			return ($results["setting_setting_value"] != "" ? $results["setting_setting_value"] : $text_admin_setting[10]);
		}
		
		return "";
	}
	
	function edit_core_stripe_secret($value)
	{
		global $database; 
		
		$value = trim($value);
		if(0 <= $value)
		{
			$query = $database->prepare('UPDATE settings SET setting_setting_value=? WHERE setting_setting=?');
			$query -> execute(array($value,"core_stripe_secret"));
		}
	}

?>