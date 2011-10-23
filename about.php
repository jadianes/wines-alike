<?php
	require_once('models/config.php');
	require_once('Smarty.class.php');
	$smarty = new Smarty();
	
	$smarty->assign('sitename', WA_WEBSITE_NAME);
	$smarty->assign('slogan', 'Trust your taste');

	$smarty->display('about.tpl');
?>
