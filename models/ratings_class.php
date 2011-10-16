<?php

/*
 * Model class for Wine Ratings
 * 
 * Author: Jose A. Dianes
 * 
 */
require_once('db_fns.php');
require_once('wine_class.php');
require_once('rating_class.php');
require_once('user_class.php');
require_once('region_class.php');
require_once('producer_class.php');

class Ratings {
	
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
	
	function add_rating($email, $wine_name, $producer_name, $region_name, $vintage_year, $new_rating) 
	/*
	 * Add new rating to the database
	 * NOTE: Users can only have one rating for a given wine. This is not intended to be use in wine
	 * rating websites, but in wine affinity ones. A new rating means that the user changed its
	 * mind about a wine, and maybe her or his taste is changing (and therefore affinity is
	 * changing too).
	 * We use prepared statements here since there is user input...
	 */ 
	{
		$user = new User();
		if ( !$user->load($email) ) throw new Exception('Wrong user email');
		
		// find or add region
		$region = new Region();
		if ( !($region->load($region_name)) ) 
		{ // New region, add it
			$region->region_name = $region_name;
			if ( !($region->save()) ) throw new Exception('Could not add Region to DB.');
		} 
		
		// find or add producer
		$producer = new Producer();
		if ( !($producer->load($producer_name)) ) { // Add it
			$producer->producer_name = $producer_name;
			if ( !($producer->save()) ) throw new Exception('Could not add Producer to DB.');
		}
		
		$wine = new Wine();
		
		if ( $wine->load($wine_name,$producer->producer_id,$region->region_name,$vintage_year) ) 
		// wine exists, recalculate avge. rating
		{
			// add new rating or update if user already rated this wine
			$wine_id = $wine->wine_id;
			$user_id = $user->user_id;
			$rating = new Rating();
			if ( $rating->load( $wine_id, $user_id ) )
			{ // User already rated this wine, update
			    $old_avg = $wine->avg_rating;
				$old_rating = $rating->rating;
				$num_ratings = $wine->num_ratings;
				$rating->rating = $new_rating;
				if ( !$rating->save() )
			 	{
					throw new Exception('Rating could not be updated.');
				} 
				else 
				{
					$new_avg = (($old_avg*$num_ratings) - $old_rating + $new_rating) / ($num_ratings);
				}
			} 
			else 
			{ // Not rated before, add rating...
				$old_avg = $wine->avg_rating;
				$num_ratings = $wine->num_ratings;
				$rating->wine_id = $wine_id;
				$rating->user_id = $user_id;
				$rating->rating = $new_rating;
	   
				if ( !$rating->save() )
				{
					throw new Exception('New rating could not be added.');
				} 
				else 
				{
					$new_avg = (($old_avg*$num_ratings) + $new_rating) / ($num_ratings + 1); 
					$num_ratings = $num_ratings + 1;        	
				}
			}
			// Update wine (avg_rating and num_ratings)
			$wine->avg_rating = $new_avg;
			$wine->num_ratings = $num_ratings;
			$wine->save();
		} 
		else
		// Wine doesn't exists, add it, and add region and producer if required
		{ 
			// Add new wine
			$wine->wine_name = $wine_name;
			$wine->region = $region->region_name;
			$wine->vintage_year= $vintage_year;
			$wine->producer_id = $producer->producer_id;
			$wine->avg_rating = $new_rating;
			$wine->num_ratings = 1;
			if ( !($wine->save()) ) throw new Exception('Could not add new wine to DB.');
			
        	// add new rating
        	$rating = new Rating();
        	$rating->wine_id = $wine->wine_id;
        	$rating->user_id = $user->user_id;
        	$rating->rating = $new_rating;
        	if ( !($rating->save()) ) throw new Exception('Could not add new Rating to DB.');
		}
		return true;	
	}
 	
	/*
	 * TODO - Delete a specific rating from the database 
	 */
	function delete_rating($username, $rating) {
		$this->conn = db_connect();
		
		if ( !$this->conn->query( '
			DELETE FROM !
			WHERE username=? and wine_id=?',
			array ( 'ratings', $username, $rating['wine_id'] ))) {
    		throw new Exception('Rating could not be deleted');
    	}
    	return true;
	}
 	
	function find_suggestions($email)
	{
		// We will provide semi intelligent recomendations to people
		// If they have given similar ratings to coincident wines its likely
		// that they will agree in other unrated (by one of them) wines as well 
		  
		// First, get all the wines rated by this user
		$all_wines = $this->conn->query("
					SELECT ratings.wine_id
					FROM users, ratings
					WHERE users.email='$email' AND ratings.user_id=users.user_id
		");
		
		// Second, iterate thorough all the wines and build the discrepance list
		for ($i = 1; $wine = $all_wines->fetch_object(); ++$i) 
		{
			// Get all users that rated this wine
			$wineid = $wine->wine_id;
			$user_ratings = $this->conn->query("
				SELECT ratings.user_id, ratings.rating 
				FROM users, ratings
				WHERE ratings.wine_id='$wineid' AND users.email!='$email' AND ratings.user_id=users.user_id
			");
			if ($user_ratings && $user_ratings->num_rows>0) {
				// Update discrepances with user ratings against this user rating
				for ($j = 1; $rating = $user_ratings->fetch_object(); ++$j) {
				//	echo ("        Calculating discrepances with user "+$rating->user_id);
					$indexvar = $rating->user_id;
					if (!$discrepances[$indexvar]) {
						$discrepances[$indexvar] = 0;
						$num_comps[$indexvar] = 0;
					}
					$discrepances[$indexvar] += abs(($rating->rating) - $wine->rating);
					$num_comps[$indexvar]++;	
				}
			}
		}
		if ( $discrepances != NULL )
		{ 
		foreach ($discrepances as $affine_user_id => $discrepance) {
			$discrepances[$affine_user_id] = ($discrepance/$num_comps[$affine_user_id]) - 2*$num_comps[$affine_user_id];
		}
		asort($discrepances);
		// ...now we have an array with the most affine users of this user (most affine in the first place)
		
		// Third, build a suggestions list taking those wines from less discrepant users
		// not rated by this user
		$suggestions = array();
		foreach ($discrepances as $affine_user_id => $discrepance) {
			// for each user, look for its highest rated wines not rated by this user
			$suggestions_result = $conn->query("
							   SELECT producers.producer_name, wines.wine_name, wines.vintage_year, wines.region, wines.avg_rating, wines.num_ratings, ratings.rating
							   FROM users, producers, wines, ratings
							   WHERE producers.wine_id=ratings.wine_id AND ratings.user_id='$affine_user_id' AND ratings.wine_id=wines.wine_id
								AND ratings.wine_id != ALL (
									SELECT ratings.wine_id FROM users, ratings
									WHERE users.email='$username' AND users.user_id=ratings.user_id
								)
							   
							   ORDER BY ratings.rating
							   LIMIT 0, 20
			");		
			
			if ($suggestions_result && $suggestions_result->num_rows>0) 
				for ($count = count($suggestions)+1; $new_suggestion = $suggestions_result->fetch_object(); ++$count) 
				{
					$suggestions[$count] = $new_suggestion;
				}
		}  
        }
		return $suggestions;
	}
 	
	/*
	 * Get latest ratings excluding ratings of a specific $username
	 * if defined
	 */
	function get_latest_ratings($email) {
		if ( isset($email) && ($email != '') ) {
			$query = "
				SELECT producers.producer_name, wines.wine_name, wines.vintage_year, wines.region, wines.avg_rating, wines.num_ratings, ratings.rating
				FROM producers, users, wines, ratings
				WHERE producers.producer_id=wines.producer_id AND users.email='$email' AND ratings.user_id!=users.user_id AND ratings.wine_id=wines.wine_id
				ORDER BY ratings.rating_date DESC
				LIMIT 0, 20
			";
			$result = $this->conn->query( $query );
		} else {
			$query = "
				SELECT producers.producer_name, wines.wine_name, wines.vintage_year, wines.region, wines.avg_rating, wines.num_ratings, ratings.rating
				FROM producers, users, wines, ratings
				WHERE producers.producer_id=wines.producer_id AND users.user_id=ratings.user_id AND ratings.wine_id=wines.wine_id
				ORDER BY ratings.rating_date DESC
				LIMIT 0, 20
			";
			$result = $this->conn->query( $query );
		}
		
		if (!$result) {
			return false;
		} else {
			// create an array of ratings 
			$rating_array = array();
			for ($count = 0; $row = $result->fetch_object(); ++$count) 
			{
				$rating_array[$count] = $row;
			}
			return $rating_array;
		}
		
	}
 	
	/*
	 * Get an array of ratings for a particular $username
	 */
	function get_user_ratings($email) {
		// Query database
		$query = "SELECT producers.producer_name, wines.wine_name, wines.vintage_year, wines.region, wines.avg_rating, wines.num_ratings, ratings.rating
			      FROM producers, wines, ratings, users
			      WHERE users.email='$email' AND ratings.user_id=users.user_id AND ratings.wine_id=wines.wine_id AND producers.producer_id=wines.producer_id
				  ORDER BY ratings.rating_date DESC";
		$result = $this->conn->query($query);
		
		// Return result
		if (!$result) {
    		return false;
		} else {
			// Create an array of ratings 
			$rating_array = array();
			for ( $count = 0; $row = $result->fetch_object(); ++$count ) 
			{
				//echo('Adding rating for '.$row->wine_name.' to list </br>');
				$rating_array[$count] = $row;
			}  
			return $rating_array;
		}

	}
	
}
?>