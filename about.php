<?php
	require_once('models/config.php');
	$smarty = new Smarty_WinesAlike();
	
	$smarty->assign('sitename', WA_WEBSITE_NAME);
	$smarty->assign('slogan', 'Trust your taste');

	$smarty->display('about.tpl');
?>
