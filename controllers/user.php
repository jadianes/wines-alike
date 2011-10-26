<?php

require_once(dirname(__FILE__).'/../models/config.php');
require_once(dirname(__FILE__).'/../models/user_manager_class.php'); 
require_once(dirname(__FILE__).'/../models/ratings_class.php');
require_once(dirname(__FILE__).'/../template_fns.php');
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

} // END class 

?>