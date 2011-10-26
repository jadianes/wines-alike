<?php

require_once(dirname(__FILE__).'/../models/config.php');
require_once(dirname(__FILE__).'/../models/user_manager_class.php'); 
require_once(dirname(__FILE__).'/../models/ratings_class.php');
require_once(dirname(__FILE__).'/../data_valid_fns.php');
require_once('template_fns.php');

/**
 * User menu controller
 *
 * @package controllers
 * @author Jose A Dianes
 **/
class useractions implements IController 
{

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function logout()
	{
		$user_manager = new UserManager();
		$old_user = $user_manager->get_current_user();
		$result_dest = $user_manager->unregister_valid_user();

		display_latest_ratings();
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function change_password_form()
	{
		$smarty = new Smarty_WinesAlike();
		$user_manager = new UserManager(); // this class start session in its constructor

		if ($user_manager->check_valid_user()) {
		  $smarty->assign('sitename', WA_WEBSITE_NAME);
		  $smarty->assign('username', $user_manager->get_username_by_email($user_manager->get_current_user()));
		  // display it
		  $smarty->display('change_password.tpl');
		} else {
		  $smarty->assign('sitename', WA_WEBSITE_NAME);
		  $smarty->assign('slogan', 'Trust your taste');
		  $smarty->assign('message', 'Ups! You must be logged in to view this page...');
		  $smarty->display('system_message.tpl');
		}
	}
	
	/**
	 * Changes the password
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function change_password()
	{
		$user_manager = new UserManager();

		$smarty = new Smarty_WinesAlike();

		// create short variable names
		$old_passwd = $_POST['old_passwd'];
		$new_passwd = $_POST['new_passwd'];
		$new_passwd2 = $_POST['new_passwd2'];

		if ($user_manager->check_valid_user()) {
			try
		  	{  
		    	if (!filled_out($_POST))
		      		throw new Exception('You have not filled out the form completely. Please try again.');
		    	if ($new_passwd!=$new_passwd2)
		       		throw new Exception('Passwords entered were not the same.  Not changed.');
		    	if (strlen($new_passwd)>30 || strlen($new_passwd)<8)
		       		throw new Exception('New password must be between 8 and 30 characters. Try again.');
		  		$email = $user_manager->get_current_user();
		     	$user_manager->change_password($email,$old_passwd,$new_passwd);
		    	$user_manager->notify_password($email, $new_passwd);
		    	$smarty->assign('sitename', WA_WEBSITE_NAME);
		    	$smarty->assign('slogan', 'Trust your taste');
				$smarty->assign('message', 'Your new password has been emailed to you.');
				$smarty->display('member_system_message.tpl');
		  	}
		  	catch (Exception $e)
		  	{
		    	$smarty->assign('sitename', WA_WEBSITE_NAME);
		    	$smarty->assign('slogan', 'Trust your taste');
				$smarty->assign('message', 'Your password could not be changed. '.$e->getMessage());
				$smarty->display('member_system_message.tpl');
		  	}
		} else {
		  $smarty->assign('sitename', WA_WEBSITE_NAME);
		  $smarty->assign('slogan', 'Trust your taste');
		  $smarty->assign('message', 'Ups! You must be logged in to view this page...');
		  $smarty->display('system_message.tpl');
		}
		
	}
	
	/**
	 * Shows the sign up form
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function signup_form()
	{
		$smarty = new Smarty_WinesAlike();

		$smarty->assign('sitename', WA_WEBSITE_NAME);
		$smarty->assign('slogan', 'Trust your taste');
		// display it
		$smarty->display('sign_up_form.tpl');
	}
	
	/**
	 * Executes the sign up process
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function signup()
	{
		  $user_manager = new UserManager();
		  $smarty = new Smarty_WinesAlike();

		  //create short variable names
		  $email=$_POST['email'];
		  $username=$_POST['username'];
		  $passwd=$_POST['passwd'];

		  try
		  {
		    // check forms filled in
		    if (!filled_out($_POST))
		    {
		      	$smarty->assign('sitename', WA_WEBSITE_NAME);
		    	$smarty->assign('slogan', 'Trust your taste');
			    $smarty->assign('message', 'You have not filled the form out correctly - please go back and try again.');
			    $smarty->display('system_message.tpl');
				exit;
		    }

		    // email address not valid
		    if (!valid_email($email))
		    {
		      	$smarty->assign('sitename', WA_WEBSITE_NAME);
		    	$smarty->assign('slogan', 'Trust your taste');
			    $smarty->assign('message', 'That is not a valid email address.  Please go back and try again.');
			    $smarty->display('system_message.tpl');
				exit;
		    } 

		    // check password length is ok
		    // ok if username truncates, but passwords will get
		    // munged if they are too long.
		    if (strlen($passwd)<6 || strlen($passwd) >16)
		    {
		      	$smarty->assign('sitename', WA_WEBSITE_NAME);
		    	$smarty->assign('slogan', 'Trust your taste');
			    $smarty->assign('message', 'Your password must be between 6 and 16 characters. Please go back and try again.');
			    $smarty->display('system_message.tpl');
				exit;
		    }

		    // attempt to register
		    // this function can also throw an exception
		    $user_manager->register($username, $email, $passwd);
		    // register session variable
			$user_manager->register_valid_user($email);    

		    // provide link to members page
			$smarty->assign('sitename', WA_WEBSITE_NAME);
			$smarty->assign('slogan', 'Trust your taste');
			$smarty->assign('message', 'Your registration was successful.  Go to the <a href="/">members</a> page to start rating wines!');
			$smarty->display('system_message.tpl');
		}
		catch (Exception $e)
		{
		    $smarty->assign('sitename', WA_WEBSITE_NAME);
		    $smarty->assign('slogan', 'Trust your taste');
			$smarty->assign('message', 'Sorry, could not register. Please go back and try again.');
			$smarty->display('system_message.tpl');
		    exit;
		}
	}
	
	/**
	 * Shows forgot password form
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function forgot_password_form()
	{
		$smarty = new Smarty_WinesAlike();

		$smarty->assign('sitename', WA_WEBSITE_NAME);
		$smarty->assign('slogan', 'Trust your taste');
		// display it
		$smarty->display('forgot_password.tpl');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function reset_password()
	{
	  $user_manager = new UserManager();
	  $smarty = new Smarty_WinesAlike();

	  // creating short variable name
	  $email = $_POST['email'];

	  try
	  {
	    $password = $user_manager->reset_password($email);
	    $user_manager->notify_password($email, $password);
	    $smarty->assign('sitename', WA_WEBSITE_NAME);
	    $smarty->assign('slogan', 'Trust your taste');
		$smarty->assign('message', 'Your new password has been emailed to you.');
		$smarty->display('system_message.tpl');
	  }
	  catch (Exception $e)
	  {
	    $smarty->assign('sitename', WA_WEBSITE_NAME);
	    $smarty->assign('slogan', 'Trust your taste');
		$smarty->assign('message', 'Your password could not be reset - please try again later.');
		$smarty->display('system_message.tpl');
	  }		
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function account()
	{
		
	}
	
	
} // END class 

?>