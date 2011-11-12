<?php

class Rating
{
	var $rating_id = -1; // if not -1, update when save :)
	var $wine_id;
	var $user_id;
	var $rating;
	var $rating_date;
	var $price;
	
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

	function load_by_id($rating_id) 
	{
	
		if ($stmt = $this->conn->prepare("
			SELECT * FROM ratings
            WHERE rating_id=? "))
        {
			$stmt->bind_param( 'i', $rating_id );
			$stmt->execute();
			$stmt->bind_result(
				$this->rating_id,
				$this->wine_id,
				$this->user_id,
				$this->rating,
				$this->rating_date);
			if ($stmt->fetch())
			{
				return true;
			}
			else
			{
				$stmt->close();
				$this->rating_id = -1;
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	function load($wine_id, $user_id) 
	{
		if ($stmt = $this->conn->prepare("
			SELECT * FROM ratings
            WHERE wine_id=?
            AND user_id=?"))
        {
        	$stmt->bind_param( 'ii', $wine_id, $user_id);
			$stmt->execute();
			$stmt->bind_result(
				$this->rating_id,
				$this->wine_id,
				$this->user_id,
				$this->rating,
				$this->rating_date,
				$this->rating_price
			);
			if ($stmt->fetch())
			{
				return true;
			}
			else
			{
				$stmt->close();
				$this->rating_id = -1;
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
		if ( $this->rating_id == -1 )
		// if a new id is not assigned, this will be a new rating
		{
			if ( $stmt = $this->conn->prepare("
				INSERT INTO ratings (wine_id, user_id, rating)
            	VALUES (?, ?, ?)") )
        	{
        		$stmt->bind_param( 'iid', $this->wine_id, $this->user_id, $this->rating);
				$stmt->execute();
				return $this->load($this->wine_id, $this->user_id);
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
				UPDATE ratings 
				SET rating=?
				WHERE rating_id=?") )
        	{
        		$stmt->bind_param( 'di', $this->rating, $this->rating_id );
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