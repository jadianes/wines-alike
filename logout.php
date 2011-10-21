<?php
require_once('Smarty.class.php');
require_once('template_fns.php');
$smarty = new Smarty();

session_start();
$old_user = $_SESSION['valid_user'];  

// store  to test if they *were* logged in
unset($_SESSION['valid_user']);
$result_dest = session_destroy();

display_latest_ratings();

?>
