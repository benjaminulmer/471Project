<?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'films_db');
	$db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	
	if ($db==false) {
		die("Connection failed: " . $db->connect_error);
	} 

	$filmID = $_GET["ID"];
	

	
	$sql = "DELETE FROM films WHERE ID='$filmID'";
	
	if ($db->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $db->error;
	}
	
	$db->close();
	header("location: homePage.php?");
?>