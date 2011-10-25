<?php
require_once('models/config.php');
require_once('models/user_manager_class.php');
require_once('models/ratings_class.php');
require_once('data_valid_fns.php');
require_once('template_fns.php');

$user_manager = new UserManager();
$smarty = new Smarty_WinesAlike();

if ($user_manager->check_valid_user()) 
{
	try 
	{
	    if (!filled_out($_POST)) // We must change this for something more apropriate
    	{
      		throw new Exception('Form not completely filled out.');    
    	}
		$wine_name = $_POST['wine_name'];
		$producer = $_POST['producer'];
		$region = $_POST['region'];
		$vintage_year = $_POST['vintage_year'];
		$rating = $_POST['rating'];
 		// try to add rating
 		$ratings = new Ratings();
    	$ratings->add_rating($user_manager->get_current_user(), $wine_name, $producer, $region, $vintage_year, $rating);
		display_user_ratings();
	}
	catch (Exception $e)
	{
		$smarty->assign('title', 'WinesAlike');
  		$smarty->assign('slogan', 'Trust your taste');
  		$smarty->assign('message', 'Ups! There is a problem with your request: '.$e->getMessage());
  		$smarty->display('member_system_message.tpl');
	}
} 
else
{
	$smarty->assign('title', 'WinesAlike');
  	$smarty->assign('slogan', 'Trust your taste');
  	$smarty->assign('message', 'Ups! You must be logged in to view this page...');
  	$smarty->display('system_message.tpl');
}

?>
