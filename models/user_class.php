<?php

class User
{
	var $user_id;
	var $user_type;
	var $user_name;
	var $passwd;
	var $email;
	var $register_date;
		
	/* database connection */
	var $conn;
	
	function __construct() 
	{
		$this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	}

	function __destruct()
	{
		$this->conn->close();
	}

	function load_by_id($user_id) 
	{
	
		if ($stmt = $this->conn->prepare("
			SELECT * FROM users
            WHERE user_id=? "))
        {
			$stmt->bind_param( 'i', $user_id );
			$stmt->execute();
			$stmt->bind_result(
				$this->user_id,
				$this->user_type,
				$this->user_name,
				$this->passwd,
				$this->email,
				$this->register_date);
			if ($stmt->fetch())
			{
				return true;
			}
			else
			{
				$stmt->close();
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	function load($email) 
	{
		if ($stmt = $this->conn->prepare("
			SELECT * FROM users
            WHERE email=?"))
        {
        	$stmt->bind_param( 's', $email );
			$stmt->execute();
			$stmt->bind_result(
				$this->user_id,
				$this->user_type,
				$this->user_name,
				$this->passwd,
				$this->email,
				$this->register_date
			);
			if ($stmt->fetch())
			{
				return true;
			}
			else
			{
				$stmt->close();
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
}
?>