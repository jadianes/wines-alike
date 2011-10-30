<?php

require_once("config.php");

class Wine
{
	var $wine_id = -1;
	var $wine_name;
	var $region;
	var $vintage_year;
	var $producer_id;
	var $avg_rating;
	var $num_ratings;
	
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

	function load_by_id($wine_id) 
	{
	
		if ($stmt = $this->conn->prepare("
			SELECT * FROM wines
            WHERE wine_id=? "))
        {
			$stmt->bind_param( 'i', $wine_id );
			$stmt->execute();
			$stmt->bind_result(
				$this->wine_id, 
				$this->wine_name,
				$this->region,
		 		$this->vintage_year,
				$this->producer_id,
				$this->avg_rating,
				$this->num_ratings
			);
			if ($stmt->fetch())
			{
				return true;
			}
			else
			{
				$stmt->close();	
				$this->wine_id = -1;
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	function load($wine_name, $producer_id, $region, $vintage_year) 
	{
		if ($stmt = $this->conn->prepare("
			SELECT * FROM wines
            WHERE wine_name=?
            AND producer_id=?
            AND region=?
            AND vintage_year=?"))
        {
        	$stmt->bind_param( 'siss', $wine_name, $producer_id, $region, $vintage_year );
			$stmt->execute();
			$stmt->bind_result(
				$this->wine_id, 
				$this->wine_name,
				$this->region,
		 		$this->vintage_year,
				$this->producer_id,
				$this->avg_rating,
				$this->num_ratings
			);
			if ($stmt->fetch())
			{
				return true;
			}
			else
			{
				$stmt->close();
				$this->wine_id = -1;
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
		if ( $this->wine_id == -1 )
		// if a new id is not assigned, this will be a new wine
		{
			if ( $stmt = $this->conn->prepare("
				INSERT INTO wines (wine_name, region, vintage_year, producer_id, avg_rating, num_ratings)
            	VALUES (?, ?, ?, ?, ?, ?)") )
        	{
        		$stmt->bind_param( 
        			'sssidi', 
        			$this->wine_name, 
        			$this->region, 
        			$this->vintage_year, 
        			$this->producer_id, 
        			$this->avg_rating, 
        			$this->num_ratings);
				$stmt->execute();
				return $this->load($this->wine_name, $this->producer_id, $this->region, $this->vintage_year);
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
				UPDATE wines 
				SET wine_name=?, region=?, vintage_year=?, producer_id=?, avg_rating=?, num_ratings=?
				WHERE wine_id=?") )
        	{
        		$stmt->bind_param( 'ssiidii', $this->wine_name, $this->region, $this->vintage_year, $this->producer_id, $this->avg_rating, $this->num_ratings, $this->wine_id);
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