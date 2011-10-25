<?php

require_once ( dirname(__FILE__).'/../models/config.php');


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
		echo('calling index action in index controller');
		$smarty = new Smarty_WinesAlike();
		$smarty->assign( 'sitename', WA_WEBSITE_NAME );
		$smarty->display( 'test.tpl' );
	}

} // END class 

?>