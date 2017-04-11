<?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'films_db');
	$db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	
	if ($db==false) {
		die("Connection failed: " . $db->connect_error);
	} 

	$filmID = $_GET["filmID"];
	$actID = $_GET["actID"];

	$sql = "DELETE FROM acted_in WHERE actorID='$actID' AND filmID ='$filmID' ";
	
	if ($db->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $db->error;
	}
	
	$db->close();
	header("location: editFilmPage.php?ID=$filmID");
?>