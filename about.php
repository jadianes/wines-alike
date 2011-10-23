<?php
	require('Smarty.class.php');
	$smarty = new Smarty();
	
	// assign some content. This would typically come from
	// a database or other source, but we'll use static
	// values for the purpose of this example.
	$smarty->assign('title', 'WinesAlike');
	$smarty->assign('slogan', 'Trust your taste');

	// display it
	$smarty->display('about.tpl');
?>
