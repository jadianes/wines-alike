<?php

require_once ( dirname(__FILE__).'/../models/config.php');
$smarty = new Smarty_WinesAlike();

/**
 * Index controller
 *
 * @package controllers
 * @author Jose A Dianes
 **/
class Index implements IController 
{

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function index()
	{
		$smarty->assign('sitename', WA_WEBSITE_NAME);
		$smarty->display('test.tpl');
	}

} // END class 

?>