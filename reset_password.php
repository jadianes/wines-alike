<?php
  require_once('models/user_manager_class.php');
  require_once('models/config.php');
  $user_manager = new UserManager();
  $smarty = new Smarty_WinesAlike();

  // creating short variable name
  $email = $_POST['email'];

  try
  {
    $password = $user_manager->reset_password($email);
    $user_manager->notify_password($email, $password);
    $smarty->assign('sitename', WA_WEBSITE_NAME);
    $smarty->assign('slogan', 'Trust your taste');
	$smarty->assign('message', 'Your new password has been emailed to you.');
	$smarty->display('system_message.tpl');
  }
  catch (Exception $e)
  {
    $smarty->assign('sitename', WA_WEBSITE_NAME);
    $smarty->assign('slogan', 'Trust your taste');
	$smarty->assign('message', 'Your password could not be reset - please try again later.');
	$smarty->display('system_message.tpl');
  }
?>
