<?php
	$conn;
	include 'dbConnect.php';
	
	$userID = $_GET["userID"];
	$filmID = $_GET["filmID"];
	
	$sql = "DELETE FROM recommended
			WHERE userID = ".$userID."
			      AND filmID = ".$filmID;
				  
	$conn->query($sql);

	$conn-> close();
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>