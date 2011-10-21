<?php
require('Smarty.class.php');
$smarty = new Smarty();

$smarty->assign('title', 'WinesAlike');
$smarty->assign('slogan', 'Trust your taste');
// display it
$smarty->display('forgot_password.tpl');

?>