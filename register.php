<?php
require_once('Smarty.class.php');
require_once('models/config.php');
$smarty = new Smarty();

$smarty->assign('sitename', WA_WEBSITE_NAME);
$smarty->assign('slogan', 'Trust your taste');
// display it
$smarty->display('register.tpl');

?>