<?php

require_once('models/config.php');

function create_database() 
{
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	/* check connection */
	if (mysqli_connect_errno())
	{ // return proper errors here with mysqli_connect_error
		throw new Exception("DB connection error");
	}
	
	$query = "DROP TABLE IF EXISTS users;";
	$query .= "CREATE TABLE users  (
  				user_id int not null auto_increment primary key,
  				user_type int not null default 2,
  				user_name varchar(16) not null,
  				passwd char(40) not null,
  				email varchar(256) not null,
  				register_date timestamp NOT NULL default CURRENT_TIMESTAMP
				);";
	$query .= "DROP TABLE IF EXISTS producers;";
	$query .= "CREATE TABLE producers (
  				producer_id int not null auto_increment primary key,
  				producer_name varchar(60) not null,
  				country varchar(60)
				);";			
	$query .= "DROP TABLE IF EXISTS wines;";
	$query .= "CREATE TABLE wines (
  				wine_id int not null auto_increment primary key,
  				wine_name varchar(200),
				type_id int not null references types(type_id),
  				region_id int not null references regions(region_id),
  				producer_id int not null references producers(producer_id),
  				vintage_year varchar(30),
  				avg_rating double not null,
  				num_ratings int not null,
  				index (wine_name),
  				index (vintage_year)
				);";
	$query .= "DROP TABLE IF EXISTS types;";
	$query .= "CREATE TABLE types (
		  		type_id int not null auto_increment primary key,
		  		type_name varchar(100) not null,
		  		subtype varchar(100)
				);";				
	$query .= "DROP TABLE IF EXISTS regions;";
	$query .= "CREATE TABLE regions (
  				region_id int not null auto_increment primary key,
  				region_name varchar(60) not null,
  				country varchar(60),
  				latitud double,
  				longitud double
				);";	
	$query .= "DROP TABLE IF EXISTS ratings;";
	$query .= "CREATE TABLE ratings (
				rating_id int not null auto_increment primary key,
				wine_id int not null references wines(wine_id),
				user_id int not null references users(user_id),
				rating double not null,
				rating_date timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
				price double
				);";
	// a comment review about a wine allowed to privileged users
	$query .= "DROP TABLE IF EXISTS comments;";
	$query .= "CREATE TABLE comments (
				comment_id int not null auto_increment primary key,
				wine_id int not null references wines(wine_id),
				user_id int not null references users(user_id),
				comment varchar(150) not null
				);";
	$query .= "DROP TABLE IF EXISTS events;";
	$query .=  "CREATE TABLE events (
				event_id int not null auto_increment primary key,
				event_type int not null,
  				user_id int not null references users(user_id),
  				event_action_id int,
  				event_date timestamp not null default CURRENT_TIMESTAMP,
  				description varchar(100)
				);";
	/* execute multi query */
	if ( $mysqli->multi_query($query) )
	{
		/* close connection */
		$mysqli->close();
	}
	else
	{ // notify errors (e.g. themdatabase exists...
		/* close connection */
		$mysqli->close();
		throw new Exception("DB query error");
	}

}

$smarty = new Smarty_WinesAlike();
$smarty->assign('version','0.1b');

try
{
	create_database();
	$smarty->assign('message','WinesAlike installation successful.');
}
catch (Exception $ex)
{
	$smarty->assign('message', $ex->getMessage());
}

$smarty->caching = 0;
$smarty->display('install.tpl');
	
?>