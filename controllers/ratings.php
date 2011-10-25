<?php

require_once(dirname(__FILE__).'/../models/config.php');
require_once(dirname(__FILE__).'/../models/user_manager_class.php'); 
require_once(dirname(__FILE__).'/../models/ratings_class.php');
require_once(dirname(__FILE__).'/../template_fns.php');
/**
 * Index controller
 *
 * @package controllers
 * @author Jose A Dianes
 **/
class ratings implements IController 
{

	/**
	 * Get latest ratings
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function latest_ratings()
	{
		$user_manager = new UserManager(); // this class start session in its constructor
		$smarty = new Smarty_WinesAlike();

		//create short variable names
		$email = $_POST['email'];
		$passwd = $_POST['passwd'];

		if ($email && $passwd)
		// they have just tried logging in
		{
		  try
		  {
		    $user_manager->login_exists($email, $passwd);  
		    // if they are in the database register the user id
		    $user_manager->register_valid_user($email);
		  }
		  catch(Exception $e) {
			$smarty->assign('sitename', WA_WEBSITE_NAME);
			$smarty->assign('slogan', 'Trust your taste');
			$smarty->assign('message', 'Sorry, it was impossible to log you in. '+$e->getMessage());
			$smarty->display('system_message.tpl');
		    exit;
		  }      
		}

		if ($user_manager->check_valid_user()) {
			display_latest_ratings_member();
		} else {
			display_latest_ratings();
		}

	}

	/**
	 * Get current user ratings
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function user_ratings()
	{
		$user_manager = new UserManager();
		$smarty = new Smarty_WinesAlike();

		if ($user_manager->check_valid_user()) 
		{
			display_user_ratings();
		} 
		else 
		{
		  $smarty->assign('sitename', WA_WEBSITE_NAME);
		  $smarty->assign('slogan', 'Trust your taste');
		  $smarty->assign('message', 'Sorry, you must be a member to see this page.');
		  $smarty->display('system_message.tpl');
		}		
	}
	
	/**
	 * Get suggestions for the current user
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function suggestions()
	{
		$user_manager = new UserManager();
		$smarty = new Smarty_WinesAlike();

		if ($user_manager->check_valid_user()) 
		{
			display_suggestions();
		} 
		else 
		{
		  $smarty->assign('sitename', WA_WEBSITE_NAME);
		  $smarty->assign('slogan', 'Trust your taste');
		  $smarty->assign('message', 'Sorry, you must be a member to see this page.');
		  $smarty->display('system_message.tpl');
		}
	}

} // END class 

?>