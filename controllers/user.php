<?php

require_once(dirname(__FILE__).'/../models/config.php');
require_once(dirname(__FILE__).'/../models/user_manager_class.php'); 
require_once(dirname(__FILE__).'/../models/ratings_class.php');
require_once(dirname(__FILE__).'/../template_fns.php');
require_once(dirname(__FILE__).'/../data_valid_fns.php');

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
	 * undocumented function
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function account()
	{
		
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function reports()
	{
		
	}
	
} // END class 

?>