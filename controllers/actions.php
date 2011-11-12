<?php

require_once(dirname(__FILE__).'/../models/config.php');
require_once(dirname(__FILE__).'/../models/user_manager_class.php'); 
require_once(dirname(__FILE__).'/../models/ratings_class.php');
require_once('template_fns.php');
require_once('icontroller.php');

/**
 * Actions menu controller
 *
 * @package controllers
 * @author Jose A Dianes
 **/
class actions implements IController 
{

	/**
	 * Get latest ratings
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function latest_ratings()
	{
		$user_manager = new UserManager(); // this class start session in its constructor
		$smarty = new Smarty_WinesAlike();

		if (isset($_POST['email']) && isset($_POST['passwd']))
		// they have just tried logging in
		{
		  //create short variable names
		  $email = $_POST['email'];
		  $passwd = $_POST['passwd'];
		  try
		  {
		    if ($user_manager->login_exists($email, $passwd))
			{	
				// if they are in the database register the user id
			    $user_manager->register_valid_user($email);
			}  
		    
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

	}

	/**
	 * Get current user ratings
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function user_ratings()
	{
		$user_manager = new UserManager();
		$smarty = new Smarty_WinesAlike();

		if ($user_manager->check_valid_user()) 
		{
			display_user_ratings();
		} 
		else 
		{
		  $smarty->assign('sitename', WA_WEBSITE_NAME);
		  $smarty->assign('slogan', 'Trust your taste');
		  $smarty->assign('message', 'Sorry, you must be a member to see this page.');
		  $smarty->display('system_message.tpl');
		}		
	}
	
	/**
	 * Get suggestions for the current user
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function suggestions()
	{
		$user_manager = new UserManager();
		$smarty = new Smarty_WinesAlike();

		if ($user_manager->check_valid_user()) 
		{
			display_suggestions();
		} 
		else 
		{
		  $smarty->assign('sitename', WA_WEBSITE_NAME);
		  $smarty->assign('slogan', 'Trust your taste');
		  $smarty->assign('message', 'Sorry, you must be a member to see this page.');
		  $smarty->display('system_message.tpl');
		}
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function add_rating()
	{
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
				$smarty->caching = 0;
				$smarty->assign('sitename', WA_WEBSITE_NAME);
				$smarty->assign('username', $user_manager->get_username_by_email($user_manager->get_current_user()));
		  		$smarty->assign('slogan', 'Trust your taste');
		  		$smarty->assign('message', 'Ups! There is a problem with your request: '.$e->getMessage());
		  		$smarty->display('member_system_message.tpl');
			}
		} 
		else
		{
			$smarty->caching = 0;
			$smarty->assign('sitename', WA_WEBSITE_NAME);
		  	$smarty->assign('slogan', 'Trust your taste');
		  	$smarty->assign('message', 'Ups! You must be logged in to view this page...');
		  	$smarty->display('system_message.tpl');
		}		
	}

	/**
	 * Calls the add rating form
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function add_form()
	{
		$user_manager = new UserManager();
		$smarty = new Smarty_WinesAlike();

		if ($user_manager->check_valid_user()) 
		{
			$smarty->caching = 0;
		  	$smarty->assign('sitename', WA_WEBSITE_NAME);
		  	$smarty->assign('username', $user_manager->get_username_by_email($user_manager->get_current_user()));
		  	// display it
		  	$smarty->display('add_rating.tpl');
		} 
		else 
		{
		  	$smarty->assign('sitename', WA_WEBSITE_NAME);
		  	$smarty->assign('slogan', 'Trust your taste');
		  	$smarty->assign('message', 'Ups! You must be logged in to view this page...');
		  	$smarty->display('system_message.tpl');
		}
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function delete_rating()
	{
		
	}
	
} // END class 

?>