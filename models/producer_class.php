<?php

class Producer
{
	var $producer_id=-1; // if not -1, update when save :)
	var $producer_name;
	var $country;
	
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

	function load_by_id($producer_id) 
	{
	
		if ($stmt = $this->conn->prepare("
			SELECT * FROM producers
            WHERE producer_id=? "))
        {
			$stmt->bind_param( 'i', $producer_id );
			$stmt->execute();
			$stmt->bind_result(
				$this->producer_id,
				$this->producer_name,
				$this->country
			);
			if ($stmt->fetch())
			{
				return true;
			}
			else
			{
				$stmt->close();
				$this->producer_id = -1;
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	function load($producer_name) 
	{
		if ($stmt = $this->conn->prepare("
			SELECT * FROM producers
            WHERE producer_name=?"))
        {
        	$stmt->bind_param( 's', $producer_name );
			$stmt->execute();
			$stmt->bind_result(
				$this->producer_id,
				$this->producer_name,
				$this->country
			);
			if ($stmt->fetch())
			{
				return true;
			}
			else
			{
				$stmt->close();
				$this->producer_id = -1;
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	function save()
	{		
		if ( $this->producer_id == -1 )
		// if a new id is not assigned, this will be a new wine
		{
			if ( $stmt = $this->conn->prepare("
				INSERT INTO producers (producer_name, country)
            	VALUES (?, ?)") )
        	{
        		$stmt->bind_param( 'ss', $this->producer_name, $this->country);
				$stmt->execute();
				return $this->load($this->producer_name);;
			}
			else
			{
				return FALSE;
			}
		}
		else 
		// update
		{
			if ( $stmt = $this->conn->prepare("
				UPDATE producers 
				SET producer_name=?, country=?
				WHERE producer_id=?") )
        	{
        		$stmt->bind_param( 'ssi', $this->producer_name, $this->country, $this->producer_id);
				$stmt->execute();
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}	
	}
}
?>