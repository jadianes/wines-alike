<?php
// include function files for this application
require_once('models/ratings_class.php');
require_once('models/user_manager_class.php'); 
$user_manager = new UserManager();

//create short variable names
$username = $_POST['username'];
$passwd = $_POST['passwd'];

if ($username && $passwd)
// they have just tried logging in
{
  try
  {
    $user_manager->login_exists($username, $passwd);
    $user_manager->register_valid_user($username);
  }
  catch(Exception $e) {
	//echo (json_encode(new array());
    exit;
  }      
}

if ( $user_manager->check_valid_user() ) {
  $ratings =& new Ratings();
  $rating_array = $ratings->find_suggestions( $user_manager->get_current_username() );
  // get the ratings this user has entered, or all of them if not user specified
}
  
if ( $rating_array ) {
	echo (json_encode($rating_array));
} else {
	echo (json_encode( array() ));
}

?>