<?php
	
	
	
	
	// Frontend Functions
	
	// Login User Check 
	
	if ($_GET['check'] == "user" && isset($_GET['email']))
	{
		error_reporting(1);
		ini_set("display_errors", 1);
		
		$database = new PDO("sqlite:database.sqlite");
		
		echo user_exists(trim($_GET['email'])) ? "true" : "false";
	}
	
	
	
	
	// Delete User
	
	if ($_GET['delete'] == "user" && isset($_GET['user_id']))
	{
		session_start();
	
		if ($_SESSION['user_login'] != "true")
		{
			exit();
		}
	
		if ($_SESSION['user_login'] == "true" && $_SESSION['user_level'] == "3")
		{
			error_reporting(1);
			ini_set("display_errors", 1);
		
			$database = new PDO("sqlite:database.sqlite");
		
			delete_user(trim($_GET['user_id']));
		
			header('Location: admin_user_manage.php');
		}
		else
		{
			header('Location: index.php');
		}
	}








	// Backend Functions

	// Database implementation 
	
	function is_initial_users_setup()
	{
		global $database; 
		
		$query = $database->prepare('SELECT * FROM users');
		$query -> execute();
		$results = $query -> fetchAll();
		
		if (count($results) > 0) 
		{
  			return false;	
		}
		
		return true;
	}
	
	$database->exec("CREATE TABLE IF NOT EXISTS users 
	(
		user_number INTEGER PRIMARY KEY AUTOINCREMENT,
		user_id TEXT,
		user_email TEXT,
		user_password TEXT,
		user_username TEXT,
		user_level TEXT,
		user_joined TEXT
	)");
		
	if (is_initial_users_setup()) 
    {
		$query = $database->prepare('INSERT INTO users (user_id,user_email,user_password,user_username,user_level,user_joined) VALUES (?,?,?,?,?,?)');
		$query -> execute(array(sha1("admin@admin.com" . date("YmdHis")),"admin@admin.com",sha1("admin"),"Administrator","3",date("d.m.Y, H:i:s")));
	}	



 
	// Avatar implementation
	
	$avatars = "avatars";
	
	if (!file_exists($avatars))
	{
		mkdir($avatars);
	}
	
	if (!file_exists($avatars . "/index.html"))
	{
		file_put_contents($avatars . "/index.html","");
	}
	
	
	
	
	// Login and Register
	
	function register_user($email,$password)
	{
		global $database; 
		
		$user_id = sha1(trim($email) . date("YmdHis"));
		$email = trim($email);
		$password = sha1(trim($password));
		$username = "";
		$level = "1";
		$joined = date("d.m.Y, H:i:s");
		
		if (user_exists($email) == false)
		{
			$query = $database->prepare('INSERT INTO users (user_id,user_email,user_password,user_username,user_level,user_joined) VALUES (?,?,?,?,?,?)');
			$query -> execute(array($user_id,$email,$password,$username,$level,$joined));
		}
	}
	
	function login_correct($email,$password)
	{
		$email = trim($email);
		$password = sha1(trim($password));
		
		if (user_password(user_id($email)) == $password)
		{
			return true;
		}
		
		return false; 
	}
	
	
	
	
	// Check functions
	
	function user_exists($email)
	{
		global $database; 
		
		$query = $database->prepare('SELECT user_id FROM users WHERE user_email=?');
		$query -> execute(array(trim($email)));
		$results = $query -> fetchAll();
		
		if (count($results) > 0) 
		{
  			return true;	
		}
		
		return false;
	}
	
	function user_id_exists($user_id)
	{
		global $database; 
		
		$query = $database->prepare('SELECT user_email FROM users WHERE user_id=?');
		$query -> execute(array(trim($user_id)));
		$results = $query -> fetchAll();
		
		if (count($results) > 0) 
		{
  			return true;	
		}
		
		return false;
	}
	
	
	
	
	// Data functions
	
	function user_id($email)
	{
		global $database; 
		
		$query = $database->prepare('SELECT user_id FROM users WHERE user_email=?');
		$query -> execute(array(trim($email)));
		$results = $query -> fetch();
		
		if (count($results) > 0)
		{
  			return $results["user_id"];	
		}
		
		return "";
	}
	
	function user_email($user_id)
	{
		global $database; 
		
		$query = $database->prepare('SELECT user_email FROM users WHERE user_id=?');
		$query -> execute(array(trim($user_id)));
		$results = $query -> fetch();
		
		if (count($results) > 0) 
		{
  			return $results["user_email"];	
		}
		
		return "";
	}
	
	function user_username($user_id)
	{
		global $database; 
		
		$query = $database->prepare('SELECT user_username FROM users WHERE user_id=?');
		$query -> execute(array(trim($user_id)));
		$results = $query -> fetch();
		
		if (count($results) > 0) 
		{
			return ($results["user_username"] != "" ? $results["user_username"] : $text_user_account[2]);
		}
		
		return "";
	}
	
	function user_password($user_id)
	{
		global $database; 
		
		$query = $database->prepare('SELECT user_password FROM users WHERE user_id=?');
		$query -> execute(array(trim($user_id)));
		$results = $query -> fetch();
		
		if (count($results) > 0) 
		{
  			return $results["user_password"];
		}
		
		return "";
	}
	
	function user_level($user_id)
	{
		global $database; 
		
		$query = $database->prepare('SELECT user_level FROM users WHERE user_id=?');
		$query -> execute(array(trim($user_id)));
		$results = $query -> fetch();
		
		if (count($results) > 0) 
		{
  			return $results["user_level"];	
		}
		
		return "";
	}
	
	function user_avatar($user_id)
	{
		global $avatars;
		
		$user_id = trim($user_id);
		
		if (file_exists($avatars . "/" . $user_id . ".jpg"))
		{
			return $avatars . "/" . $user_id . ".jpg";
		}
		
		if (file_exists($avatars . "/" . $user_id . ".png"))
		{
			return $avatars . "/" . $user_id . ".png";
		}
		
		return "resource/img/avatar.png";
	}
	
	function user_count()
	{
		global $database; 
		
		$query = $database->prepare('SELECT * FROM users');
		$query -> execute();
		$results = $query -> fetchAll();
		
		return count($results);
	}
	
	function users()
	{
		global $database;
		
		$users = array();
		
		$query = $database->prepare('SELECT * FROM users');
		$query -> execute();
		$results = $query -> fetchAll();
		
		if (count($results) > 0) 
		{	
			foreach ($results as $user)
			{
				$user_info = array
				(
					"user_id" => $user["user_id"],
					"user_username" => $user["user_username"],
					"user_email" => $user["user_email"],
					"user_level" => $user["user_level"],
					"user_joined" => $user["user_joined"]
				);
				array_push($users,$user_info);
			}
		
			return $users;
		}
		
		return null;
	}
	
	
	
	
	// Edit functions
	
	function edit_username($user_id,$username)
	{
		global $database; 
		
		$user_id = trim($user_id);
		$username = trim($username);
		
		if (user_id_exists($user_id)) 
		{
			$sql = $database->query("UPDATE users SET user_username='$username' WHERE user_id='$user_id'");
		}
	}
	
	function edit_email($user_id,$email)
	{
		global $database; 
		
		$user_id = trim($user_id);
		$email = trim($email);
		
		if (user_id_exists($user_id))
		{
			$sql = $database->query("UPDATE users SET user_email='$email' WHERE user_id='$user_id'");
		}
	}
	
	function edit_password($user_id,$password)
	{
		global $database; 
		
		$user_id = trim($user_id);
		$password = sha1(trim($password));
		
		if (user_id_exists($user_id))
		{
			$sql = $database->query("UPDATE users SET user_password='$password' WHERE user_id='$user_id'");
		}
	}
	
	function reset_password($email)
	{
		global $database; 
		
		$user_id = user_id(trim($email));
		$new_password = crc32(date("YmdHis"));
		$password = sha1($new_password);
		
		if (user_id_exists($user_id))
		{
			$sql = $database->query("UPDATE users SET user_password='$password' WHERE user_id='$user_id'");
		}
		
		return $new_password;
	}
	
	function edit_level($user_id,$level)
	{
		global $database; 
		
		$user_id = trim($user_id);
		$level = trim($level);
		
		if (user_id_exists($user_id))
		{
			$sql = $database->query("UPDATE users SET user_level='$level' WHERE user_id='$user_id'");
		}
	}
	
	function delete_user($user_id)
	{
		global $database,$avatars; 
		
		if (user_id_exists(trim($user_id)))
		{
			$query = $database->prepare('DELETE FROM users WHERE user_id=?');
			$query -> execute(array(trim($user_id)));
			
			if (file_exists($avatars . "/" . $user_id . ".jpg"))
			{
				unlink($avatars . "/" . $user_id . ".jpg");
			}
		
			if (file_exists($avatars . "/" . $user_id . ".png"))
			{
				unlink($avatars . "/" . $user_id . ".png");
			}
		}
	}
	
	
	
	
	// Core functions
	
	function unlink_dir($path)
	{
    	if (is_dir($path) === true)
    	{
        	$files = array_diff(scandir($path), array('.', '..'));

        	foreach ($files as $file)
        	{
           		unlink_dir(realpath($path) . '/' . $file);
        	}

        	rmdir($path);
    	}
    	else 
    	{
    		if (is_file($path) === true)
    		{
        		unlink($path);
    		}
    	}
	}

?>