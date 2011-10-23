<?php
require_once('Smarty.class.php');
require_once('models/user_manager_class.php'); 
require_once('models/config.php');
require_once('models/ratings_class.php');
require_once('template_fns.php');

$user_manager = new UserManager(); // this class start session in its constructor
$smarty = new Smarty();

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

?>