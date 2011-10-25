<?php
  require_once('models/user_manager_class.php');
  require_once('models/config.php');
  require_once('data_valid_fns.php');
  $user_manager = new UserManager();
  $smarty = new Smarty_WinesAlike();

  //create short variable names
  $email=$_POST['email'];
  $username=$_POST['username'];
  $passwd=$_POST['passwd'];

  try
  {
    // check forms filled in
    if (!filled_out($_POST))
    {
      	$smarty->assign('sitename', WA_WEBSITE_NAME);
    	$smarty->assign('slogan', 'Trust your taste');
	    $smarty->assign('message', 'You have not filled the form out correctly - please go back and try again.');
	    $smarty->display('system_message.tpl');
		exit;
    }
   
    // email address not valid
    if (!valid_email($email))
    {
      	$smarty->assign('sitename', WA_WEBSITE_NAME);
    	$smarty->assign('slogan', 'Trust your taste');
	    $smarty->assign('message', 'That is not a valid email address.  Please go back and try again.');
	    $smarty->display('system_message.tpl');
		exit;
    } 

    // check password length is ok
    // ok if username truncates, but passwords will get
    // munged if they are too long.
    if (strlen($passwd)<6 || strlen($passwd) >16)
    {
      	$smarty->assign('sitename', WA_WEBSITE_NAME);
    	$smarty->assign('slogan', 'Trust your taste');
	    $smarty->assign('message', 'Your password must be between 6 and 16 characters. Please go back and try again.');
	    $smarty->display('system_message.tpl');
		exit;
    }
   
    // attempt to register
    // this function can also throw an exception
    $user_manager->register($username, $email, $passwd);
    // register session variable
	$user_manager->register_valid_user($email);    
	
    // provide link to members page
	$smarty->assign('sitename', WA_WEBSITE_NAME);
	$smarty->assign('slogan', 'Trust your taste');
	$smarty->assign('message', 'Your registration was successful.  Go to the <a href="latest_ratings_html.php">members</a> page to start rating wines!');
	$smarty->display('system_message.tpl');
}
catch (Exception $e)
{
    $smarty->assign('sitename', WA_WEBSITE_NAME);
    $smarty->assign('slogan', 'Trust your taste');
	$smarty->assign('message', 'Sorry, could not register. Please go back and try again.');
	$smarty->display('system_message.tpl');
    exit;
} 
?>
