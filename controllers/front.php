<?php
/**
 * A singleton front controller.
 * It scans the requested url and creates an action passing the appropriate keys and values
 * The url will follow the expression 'domain/controller/action/key1/value1/key2/value2/...'
 *
 * @package controllers
 * @author Jose A Dianes
 **/ 
class FrontController
{

	protected $_controller, $_action, $_params, $_body;
	
	static $_instance;
	
	/**
	 * The method returning the single instance
	 *
	 * @return the instance
	 * @author Jose A Dianes
	 **/
	public static function getInstance()
	{
		if ( ! (self::$_instance instanceof self ) )
		{
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * The private constructor parses the uri and obtains the action and arguments (keys and values)
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	private function __construct()
	{
		$request = $_SERVER['REQUEST_URI'];
		
		$splits = explode('/', trim($request,'/'));
		$this->_controller = !empty($splits[0])?$splits[0]:'ratingsc';
		$this->_action = !empty($splits[1])?$splits[1]:'latest_ratings';
		if ( !empty($splits[2]) ) 
		{
			$keys = $values = array();
			for ( $idx = 2 , $cnt = count($splits) ; $idx < $cnt ; $idx++ ) 
			{ 
				if ( $idx % 2 == 0 )
				// Is even, is key 
				{
					$keys[] = $splits[$idx];
				}
				else
				// Is odd, is value 
				{
					$values[] = $splits[$idx];
				}
			}
			$this->_params = array_combine($keys, $values);
		}
	}
	
	/**
	 * Using the elements obtained in the constructor, this function invokes 
	 * (using reflection) the action in the controller
	 *
	 * @return void
	 * @author Jose A Dianes
	 **/
	public function route()
	{
		if ( class_exists( $this->getController() ) ) 
		{
			$rc = new ReflectionClass( $this->getController() );
			if ( $rc->implementsInterface( 'IController' ))  
			{
				if ( $rc->hasMethod( $this->getAction() ) ) {
					$controller = $rc->newInstance();
					$method = $rc->getMethod( $this->getAction() );
					$method->invoke( $controller );
				}
				else 
				{
					throw new Exception("Action");
				}
			} 
			else 
			{
				throw new Exception( "Interface" );
			}
		}
		else 
		{
			throw new Exception( "Controller" );
		}
	}
	
	public function getParams()
	{
		return $this->_params;
	}
	
	public function getController()
	{
		return $this->_controller;
	}
	
	public function getAction()
	{
		return $this->_action;
	}
		
}

?>