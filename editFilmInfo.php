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
	$name = $db->real_escape_string($_REQUEST['name']);
	$year = $db->real_escape_string($_REQUEST['year']);
	$runtime = $db->real_escape_string($_REQUEST['runtime']);
	
	$sql = "UPDATE films SET name='$name', year='$year', runtime='$runtime' WHERE ID='$filmID'";
	
	if ($db->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $db->error;
	}
	
	$db->close();
	header("location: editFilmPage.php?ID=$filmID");
?>