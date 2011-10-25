<?php 
require_once('models/user_manager_class.php');
require_once('models/config.php');

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
 
?>
