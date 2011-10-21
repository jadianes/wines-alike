<?php 
require('models/user_manager_class.php');
require('Smarty.class.php');
$smarty = new Smarty();
$user_manager = new UserManager(); // this class start session in its constructor

if ($user_manager->check_valid_user()) {
  $smarty->assign('title', 'WinesAlike');
  $smarty->assign('username', $username);
  // display it
  $smarty->display('change_password.tpl');
} else {
  $smarty->assign('title', 'WinesAlike');
  $smarty->assign('slogan', 'Trust your taste');
  $smarty->assign('message', 'Ups! You must be logged in to view this page...');
  $smarty->display('system_message.tpl');
}
 
?>
