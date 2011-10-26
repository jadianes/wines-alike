<?php
// include function files for this application
require_once('models/ratings_class.php');
require_once('models/user_manager_class.php'); 
$user_manager = new UserManager();

//create short variable names
$email = $_POST['email'];
$passwd = $_POST['passwd'];

if ($email && $passwd) 
// they have just tried logging in
{ 
  try 
  {
	$user_manager->login_exists($email, $passwd);
    $user_manager->register_valid_user($email);
  } 
  catch(Exception $e) { // unsuccessful login
	//echo (json_encode(new array());
	exit;
  }      
}

$ratings =& new Ratings();
$rating_array = $ratings->get_latest_ratings($user_manager->get_current_user());
// get the ratings this user has entered, or all of them if not user specified
if ( $rating_array ) {
	echo (json_encode($rating_array));
} else {
	echo (json_encode( array() ));
}

?>
