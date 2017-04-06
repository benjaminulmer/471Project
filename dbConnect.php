<?php
	// Connect to the database
	$servername = "localhost";		  //should be same for you
	$username = "root";				 //same here
	$password = "";					 //your localhost root password
	$db = "films_db";				   //your database name
	
	$conn = new mysqli($servername, $username, $password, $db);
	if($conn->connect_error){
		die("Connection failed".$conn->connect_error);
	}
?>