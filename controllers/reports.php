<?php

require_once(dirname(__FILE__).'/../models/config.php');
require_once(dirname(__FILE__).'/../models/user_manager_class.php');
require_once(dirname(__FILE__).'/../models/user_stats_class.php');
require_once(dirname(__FILE__).'/../models/ratings_class.php');
require_once(dirname(__FILE__).'/../template_fns.php');
/**
 * Reports menu controller
 *
 * @package controllers
 * @author Jose A Dianes
 **/
class reports implements IController 
{

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function general()
	{
		$smarty = new Smarty_WinesAlike();

		$user_manager = new UserManager();

		// Get current user name
		$username = $user_manager->get_username_by_email($user_manager->get_current_user());

		// Instantiate User Stats
		$user_stats = new UserStats($username);

		// Get statistics
		$numratings = $user_stats->get_num_ratings();
		$avgrating = 2.5;

		// Assign some template variables
		$smarty->assign('sitename', WA_WEBSITE_NAME);
		$smarty->assign('slogan', 'Trust your taste');
		$smarty->assign('username', $username);
		$smarty->assign('numratings', $numratings);
		$smarty->assign('avgrating', $avgrating);

		// Display Smarty template
		$smarty->display('statistics.tpl');
	}

} // END class 

?>