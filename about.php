<?php
	require_once('models/config.php');
	require_once('Smarty.class.php');
	$smarty = new Smarty();
	
	// assign some content. This would typically come from
	// a database or other source, but we'll use static
	// values for the purpose of this example.
	$smarty->assign('sitename', WA_WEBSITE_NAME);
	$smarty->assign('slogan', 'Trust your taste');

	// display it
	$smarty->display('about.tpl');
?>
