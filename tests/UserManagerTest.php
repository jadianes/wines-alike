<?php

require_once('PHPUnit/Autoload.php');
require_once(dirname(__FILE__).'/../models/user_manager_class.php');

/**
 * Unit test for UserManager model class
 *
 * @package tests
 * @author Jose A Dianes
 **/
class UserManagerTest extends PHPUnit_Framework_TestCase 
{

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function setUp()
	{
		$this->user_manager = new UserManager();
	}
	
	/**
	 * test register valid user
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function test_register_valid_user()
	{
		$this->user_manager->register_valid_user('user@email.com');
		$this->assertEquals( 'user@email.com', $this->user_manager->get_current_user() );
	}
	
	/**
	 * test unregister valid user
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function test_unregister_valid_user()
	{
		$this->user_manager->unregister_valid_user();
		$this->assertFalse( $this->user_manager->get_current_user() );
	}
	
	/**
	 * test register
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function test_register()
	{	
		$this->user_manager->register('testuser','testuser@email.com','testuser123');
		$this->assertTrue( $this->user_manager->login_exists( 'testuser@email.com','testuser123' ) );
	}	
	
	/**
	 * test get username by email
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function test_get_username_by_email()
	{	
		$this->user_manager->register( 'testuser','testuser@email.com','testuser123' );
		$this->assertEquals( 'testuser', $this->user_manager->get_username_by_email( 'testuser@email.com' ) );
	}
	/**
	 * test change password
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function test_change_password()
	{	
		$this->user_manager->register('testuser','testuser@email.com','testuser123');
		$this->user_manager->change_password('testuser@email.com','testuser123','testuser321');
		$this->assertTrue( $this->user_manager->login_exists( 'testuser@email.com','testuser321' ) );
		$this->user_manager->change_password('testuser@email.com','testuser123','testuser123');
		$this->assertTrue( $this->user_manager->login_exists( 'testuser@email.com','testuser123' ) );
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function tearDown()
	{
		unset($this->user_manager);
	}
	
} // END class 

?>