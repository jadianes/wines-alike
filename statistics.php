<?php
/*
 * Show user statistics
 * 
 */

require_once('models/user_manager_class.php');
require_once('models/user_stats_class.php');
 
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
  
?>