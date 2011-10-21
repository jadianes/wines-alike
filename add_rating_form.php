<?php
include_once("Smarty.class.php");
include_once("models/user_manager_class.php");
$user_manager = new UserManager();
$smarty = new Smarty();

if ($user_manager->check_valid_user()) {
  $smarty->assign('title', 'WinesAlike');
  $smarty->assign('username', $username);
  // display it
  $smarty->display('add_rating.tpl');
} else {
  $smarty->assign('title', 'WinesAlike');
  $smarty->assign('slogan', 'Trust your taste');
  $smarty->assign('message', 'Ups! You must be logged in to view this page...');
  $smarty->display('system_message.tpl');
}
 
?>
