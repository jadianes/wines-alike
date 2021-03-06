<?php

/*
 * Model User Management
 */

require_once('config.php');

function send_welcome_email($username, $email) 
{
    $from = "From: ".WA_SUPPORT_EMAIL." \r\n";
    $mesg = "Dear $username,\r\n\r\n Welcome to WinesAlike. We are really happy to have you in our community.\r\n"
              ."Please, start telling us what you like. Go and login with your username ('$username') and password here: \r\n"
			  ."http://www.winesalike.com \r\n\r\n"
			  ."If you forgot your password you can go here:\r\n"
			  ."http://www.winesalike.com/forgot_password.php\r\n\r\n"
			  ."The WinesAlike team.";
      if (mail($email, 'Welcome to Winesalike', $mesg, $from))
        return true;      
      else
        throw new Exception('Could not send email.');
}
  
function send_admin_email($username, $email) 
{
    $from = "From: ".WA_SUPPORT_EMAIL." \r\n";
    $mesg = "Dear ".WA_ADMIN_NAME.",\r\n\r\n The user $username <$email> just registered in the system.\r\n"
			  ."The WinesAlike team.";
      if (mail(WA_ADMIN_EMAIL, 'New WinesAlike user', $mesg, $from))
        return true;      
      else
        throw new Exception('Could not send email.');
}


class UserManager 
{

  var $database;

  function __construct() 
  {
    if ( session_id() == "" ) session_start();
    $this->database = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  }

  function __destruct() 
  {
  	$this->database->close();
  }
  
	/**
	 * register a new user in the database
	 *
	 * @return true if success, false if the user exists.
	 * @author Jose A Dianes
	 **/
  	function register($username, $email, $password)
  	// register new user with db
  	// return true or error message
  	{
    	// check if email is unique
    	$stmt = $this->database->stmt_init();
    	if ($stmt->prepare("SELECT * FROM users WHERE email=?")) 
		{
			$stmt->bind_param( 's', $email ); 
			$stmt->execute();
			$stmt->store_result();
    		if ( $stmt->num_rows > 0 ) 
			{
    			$stmt->close();
      			return false;
      		}
		} 
		else 
		{
      		throw new Exception('Could not execute query');    	
		}

    	// We should also check if its a valid email, maybe requesting user account confirmation.
    	// if ok, put in db
    	$stmt = $this->database->stmt_init();
    	if ($stmt->prepare("
    		INSERT INTO users (user_name, passwd, email) 
    		VALUES (?, ?, ?)"))
    	{
			$spassword = sha1($password);
    		$stmt->bind_param('sss', $username, $spassword, $email);
    		$stmt->execute();
			// Now send welcome email
    		send_welcome_email($username, $email);
			send_admin_email($username, $email);
			$stmt->close();
    	} 
		else 
		{
    		$stmt->close();
    		throw new Exception('Could not execute query');
    	}
    	return true;
  	}
 
	/**
	 * Check if login email exists in DB
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
  	function login_exists($email, $password)
  	{
		// check if login info exists
    	$stmt = $this->database->stmt_init();
    	if ($stmt->prepare("SELECT * FROM users 
                        	WHERE email=?
                        	AND passwd = sha1(?)"))
    	{                 
    		$stmt->bind_param('ss', $email, $password);
    		$stmt->execute();
    		$stmt->store_result();
  			if ($stmt->num_rows()>0)
      			return true;
    		else 
      			return false;
    	} 
		else 
		{
        	throw new Exception('DB query error');
    	}
  	}


  	function check_valid_user() 
  	// see who is logged in
  	{
    	return isset($_SESSION['valid_user']);
  	}
  	
	function register_valid_user($email) 
	// stores in the session the user currently logged in
	{
    	$_SESSION['valid_user'] = $email;
  	}

	/**
	 * unregisters current user and destroys session
	 *
	 * @return session_destroy result
	 * @author Jose A Dianes
	 **/
	public function unregister_valid_user()
	{
		$_SESSION = array();
		return session_destroy();
	}
  
  	function get_current_user()
  	{
    	if (isset($_SESSION['valid_user'])) {
	  		return $_SESSION['valid_user'];
		}
		else
		{
	  		return false;
		}
  	}
  
  function change_password($email, $old_password, $new_password)
  // change password for username/old_password to new_password
  {    
    $stmt = $this->database->stmt_init();
    if ($stmt->prepare( "UPDATE users
                         SET passwd = sha1(?)
                         WHERE email = ?"))
    {                  
    	$stmt->bind_param('ss', $new_password, $email);
    	$stmt->execute();
    } else {
        throw new Exception('Password could not be changed.');
    }
  }

	function get_username_by_email($email)
	{
		$stmt = $this->database->stmt_init();
    	if ($stmt->prepare( "SELECT user_name
                         	 FROM users
                       	  	 WHERE email = ?"))
    	{
    		$stmt->bind_param('s', $email);
    		$stmt->execute();
    		$stmt->bind_result($username);
    		$stmt->fetch();
    		$stmt->close();
    		return $username;  // changed successfully 
    	} else {
        	return "winesalike";
    	}
	}

  function reset_password($email)
  // set password for username to a random value
  // return the new password or false on failure
  { 
  	$new_password = $this->get_username_by_email($email);
    // add a number
    // to make it a slightly better password
    srand ((double) microtime() * 1000000);
    $rand_number = rand(0, 999999); 
    $new_password .= $rand_number;
    $new_password_enc = sha1($new_password);
    // set user's password to this in database or return false
    $stmt = $this->database->stmt_init();
    if ($stmt->prepare( "UPDATE users
                         SET passwd = ?
                         WHERE email = ?"))
    {
    	$stmt->bind_param('ss', $new_password_enc, $email);
    	$stmt->execute();
    	$stmt->store_result();
    	return $new_password;  // changed successfully 
    } else {
        throw new Exception('Could not change password.');  // not changed
    }
       
  }

  function notify_password($email, $password)
  // notify the user that their password has been changed
  {
    $stmt = $this->database->stmt_init();
    if ($stmt->prepare("SELECT user_name 
    					FROM users
                        WHERE email=?"))
    {              
    	$stmt->bind_param('s', $email);
    	$stmt->execute();
    	$stmt->bind_result($username);
    	$stmt->store_result(); 

    	$stmt->fetch();
    	if ($stmt->num_rows()<1)
  	    {
      		throw new Exception('Could not find email address.');  
    	} else {
      		$from = "From: support@winesalike.com \r\n";
      		$mesg = "Dear $username,\r\n\r\n Your WinesAlike password has been changed to $password \r\n"
              ."Please change it next time you log in. \r\n\r\n"
			  ."The WinesAlike team.";
      		if (mail($email, 'WinesAlike login information', $mesg, $from)) {
        		return true;      
      		} else {
        		throw new Exception('Could not send email.');
        	}
        }
    } else {
        throw new Exception('Could not query databse.');      
    }
}

}
?>