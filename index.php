<?php

require_once('controllers/front.php');

// Initialize the FrontController
$front = FrontController::getInstance();
$front->route();

?>