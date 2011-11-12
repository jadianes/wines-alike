<?php

require_once(dirname(__FILE__).'/../models/config.php');
require_once(dirname(__FILE__).'/../models/user_manager_class.php');
require_once(dirname(__FILE__).'/../models/ratings_class.php');

function display_user_ratings() {
	$user_manager = new UserManager();
	$smarty = new Smarty_WinesAlike();
	$ratings = new Ratings();

	$smarty->caching = 0;
	$smarty->assign('sitename', WA_WEBSITE_NAME);
  	$smarty->assign('slogan', 'Trust your taste');  
  	$smarty->assign('username', $user_manager->get_username_by_email($user_manager->get_current_user()));
  	// show user ratings
  	$rating_array = $ratings->get_user_ratings( $user_manager->get_current_user() );
  	$smarty->assign( 'ratings', $rating_array );
  	$smarty->assign( 'ratings_title', 'Your Ratings');
  	$smarty->assign('rating_options', 
  		array( 
  		0 => "Not rated",
  		1 => "Don't Like it", 
  		2 => "Enjoyable", 
  		3 => "Nice one", 
  		4 => "Love it!", 
  		5 => "Religious Experience..."
  		) 
  	);  
  	$smarty->display('user_ratings.tpl');
}

function display_latest_ratings_member() 
{
	$user_manager = new UserManager();
	$smarty = new Smarty_WinesAlike();
	$ratings = new Ratings();
	
	$smarty->caching = 0;
  	$smarty->assign('sitename', WA_WEBSITE_NAME);
  	$smarty->assign('slogan', 'Trust your taste');  
  	$smarty->assign('username', $user_manager->get_username_by_email($user_manager->get_current_user()));
  	// show latest ratings
  	$ratings = new Ratings();
  	$rating_array = $ratings->get_latest_ratings( $user_manager->get_current_user(), 16 );
  	$smarty->assign( 'ratings', $rating_array );
  	$smarty->assign( 'ratings_title', 'Latest Ratings');
  	$smarty->assign('rating_options', 
  		array( 
  		0 => "Not rated",
  		1 => "Don't Like it", 
  		2 => "Enjoyable", 
  		3 => "Nice one", 
  		4 => "Love it!", 
  		5 => "Religious Experience..."
  		) 
  	);
  	$smarty->display('latest_ratings_member.tpl');
}

function display_latest_ratings()
{
	$smarty = new Smarty_WinesAlike();
	$ratings = new Ratings();
	
	$smarty->caching = 0;
  	$smarty->assign('sitename', WA_WEBSITE_NAME);
  	$smarty->assign('slogan', 'Trust your taste');
  
  	// show latest ratings
  	$ratings = new Ratings();
  	$rating_array = $ratings->get_latest_ratings('',4);
  	$smarty->assign( 'ratings', $rating_array );
  	$smarty->assign( 'ratings_title', 'Latest Ratings');
    $smarty->display('latest_ratings.tpl');

}

function display_suggestions() {
	$user_manager = new UserManager();
	$smarty = new Smarty_WinesAlike();
	$ratings = new Ratings();
	
	$smarty->caching = 0;
	$smarty->assign('sitename', WA_WEBSITE_NAME);
  	$smarty->assign('slogan', 'Trust your taste');  
  	$smarty->assign('username', $user_manager->get_username_by_email($user_manager->get_current_user()));
  	// show user ratings
  	$rating_array = $ratings->find_suggestions( $user_manager->get_current_user() );
  	if ( count($rating_array) == 0 ) $rating_array = $ratings->get_latest_ratings( $user_manager->get_current_user() );
  	$smarty->assign( 'ratings', $rating_array );
  	$smarty->assign( 'ratings_title', 'Suggestions...');
  	$smarty->assign('rating_options', 
  		array( 
  		0 => "Not rated",
  		1 => "Don't Like it", 
  		2 => "Enjoyable", 
  		3 => "Nice one", 
  		4 => "Love it!", 
  		5 => "Religious Experience..."
  		) 
  	);  
  	$smarty->display('latest_ratings_member.tpl');
}


?>