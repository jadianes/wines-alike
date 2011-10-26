<?php

require_once(dirname(__FILE__).'/../models/config.php');
require_once(dirname(__FILE__).'/../data_valid_fns.php');
require_once('template_fns.php');

/**
 * Company menu controller (e.g. footer, etc)
 *
 * @package controllers
 * @author Jose A Dianes
 **/
class company implements IController 
{

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function about()
	{
		$smarty = new Smarty_WinesAlike();

		$smarty->assign('sitename', WA_WEBSITE_NAME);
		$smarty->assign('slogan', 'Trust your taste');

		$smarty->display('about.tpl');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function producers()
	{
		
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function help()
	{
		
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function privacy()
	{
		
	}
	
} // END class 

?>