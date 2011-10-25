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
class IndexController implements IController 
{

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function index()
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


} // END class 

?>