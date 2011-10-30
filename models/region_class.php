<?php

require_once("config.php");

class Region
{
	var $region_id=-1; // if not -1, update when save :)
	var $region_name;
	var $country;
	var $latitud;
	var $longitud;
	
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

	function load_by_id($region_id) 
	{
	
		if ($stmt = $this->conn->prepare("
			SELECT * FROM regions
            WHERE region_id=? "))
        {
			$stmt->bind_param( 'i', $region_id );
			$stmt->execute();
			$stmt->bind_result(
				$this->region_id,
				$this->region_name,
				$this->country,
				$this->latitud,
				$this->longitud
			);
			if ($stmt->fetch())
			{
				return true;
			}
			else
			{
				$stmt->close();
				$this->region_id = -1;
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	function load($region_name) 
	{
		if ($stmt = $this->conn->prepare("
			SELECT * FROM regions
            WHERE region_name=?"))
        {
        	$stmt->bind_param( 's', $region_name );
			$stmt->execute();
			$stmt->bind_result(
				$this->region_id,
				$this->region_name,
				$this->country,
				$this->latitud,
				$this->longitud
			);
			if ($stmt->fetch())
			{
				return true;
			}
			else
			{
				$stmt->close();
				$this->region_id = -1;
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
		if ( $this->region_id == -1 )
		// if a new id is not assigned, this will be a new wine
		{
			echo "<p>Trying to save region ".$this->region_name."</p>";
			if ( $stmt = $this->conn->prepare("
				INSERT INTO regions (region_name, country)
            	VALUES (?, ?)") )
        	{
        		$stmt->bind_param( 'ss', $this->region_name, $this->country);
				$stmt->execute();
				return $this->load($this->region_name);
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
				UPDATE regions 
				SET region_name=?, country=?
				WHERE region_id=?") )
        	{
        		$stmt->bind_param( 'ssi', $this->region_name, $this->country, $this->region_id);
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