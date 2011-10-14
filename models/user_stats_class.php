<?php

require_once('ratings_class.php');

class UserStats {
  var $username;
  var $ratings;
  
  function UserStats($username) {
    $this->username = $username;
    $this->ratings = new Ratings();
  }
  
  function get_num_ratings() {
    return sizeof( $this->ratings->get_user_ratings( $this->username ) );
  }
 
  function get_avg_rating() {
    
  }

  function get_num_regions() {

  }

  function get_num_vintages() {

  }
 
}

?>