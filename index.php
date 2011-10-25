<?php

require_once('controllers/front.php');
require_once('controllers/icontroller.php');
require_once('controllers/index.php');

// Initialize the FrontController
$front = FrontController::getInstance();
$front->route();

?>