<?php

require_once(dirname(__FILE__).'/../models/config.php');
require_once(dirname(__FILE__).'/../models/user_manager_class.php'); 
require_once(dirname(__FILE__).'/../models/ratings_class.php');
require_once('template_fns.php');
require_once('icontroller.php');

/**
 * JSON api controller
 *
 * @package controllers
 * @author Jose A Dianes
 **/
class api implements IController 
{

	/**
	 * Get latest ratings
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function latest_ratings()
	{
		$user_manager = new UserManager();
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
		  	catch(Exception $e) 
			{
				//echo (json_encode(new array());
				exit;
		  	}      
		}

		// get the ratings this user has entered, or all of them if not user specified
		$ratings = new Ratings();
		if ($user_manager->check_valid_user()) {
			$rating_array = $ratings->get_latest_ratings($user_manager->get_current_user(),16);
		} else {
			$rating_array = $ratings->get_latest_ratings('',4);
		}
		echo (json_encode($rating_array));
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
		  	catch(Exception $e) 
			{
				//echo (json_encode(new array());
				exit;
		  	}      
		}

		// get the ratings this user has entered, or all of them if not user specified
		$ratings = new Ratings();
		if ($user_manager->check_valid_user()) {
			$rating_array = $ratings->get_user_ratings($user_manager->get_current_user());
		} else {
			$rating_array = array();
		}
		echo (json_encode($rating_array));
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
			  	catch(Exception $e) 
				{
					//echo (json_encode(new array());
					exit;
			  	}      
			}

			// get the ratings this user has entered, or all of them if not user specified
			$ratings = new Ratings();
			if ($user_manager->check_valid_user()) {
				$rating_array = $ratings->find_suggestions($user_manager->get_current_user());
				if (count($rating_array) == 0) 
				{
					$rating_array = $ratings->get_latest_ratings($user_manager->get_current_user(),16);
				}
			} else {
				$rating_array = array();
			}
			echo (json_encode($rating_array));
	}
	
	
} // END class 

?>