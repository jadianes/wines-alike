<?php

require_once('PHPUnit/Framework.php');
require_once('models/user_manager_class.php');

/**
 * Unit test for UserManager model class
 *
 * @package tests
 * @author Jose A Dianes
 **/
class UserManagerTest extends PHPUnit_Framework_TestCase 
{
	/**
	 * test register valid user
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function test()
	{
		$user_manager = new UserManager();
		$user_manager->register_valid_user('user@email.com');
		$this->assertEquals( 'user@email.com', $user_manager->get_current_user() );
	}
	
} // END class 

?>