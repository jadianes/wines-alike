<?php

require_once('Smarty.class.php');
require_once('models/user_manager_class.php');
require_once('models/ratings_class.php');
require_once('template_fns.php');
$user_manager = new UserManager();
$smarty = new Smarty();

if ($user_manager->check_valid_user()) 
{
	display_user_ratings();
} 
else 
{
  $smarty->assign('title', 'WinesAlike');
  $smarty->assign('slogan', 'Trust your taste');
  $smarty->assign('message', 'Sorry, you must be a member to see this page.');
  $smarty->display('system_message.tpl');
}

?>
