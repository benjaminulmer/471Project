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
	$budget = $db->real_escape_string($_REQUEST['budget']);
	$gross = $db->real_escape_string($_REQUEST['gross']);
	
	$sql = "UPDATE films SET budget='$budget', boxOffice='$gross' WHERE ID='$filmID'";
	
	if ($db->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $db->error;
	}
	
	$db->close();
	header("location: editFilmPage.php?ID=$filmID");
?>