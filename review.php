<?php
	$conn;
	include 'dbConnect.php';
	
	$userID = $_GET["userID"];
	$filmID = $_GET["filmID"];
	$rating = $_GET["rating"];
	$review = $_GET["review"];
	
	$sql = "DELETE FROM recommended
			WHERE userID = ".$userID."
				  AND filmID = ".$filmID;
				  
	$conn->query($sql);
	
	$sql = "INSERT INTO watched
	        VALUES(".$userID. ",".$filmID.")";

	$conn->query($sql);
	
	$sql = "INSERT INTO reviews
	        VALUES(".$userID. ",".$filmID.",".$rating.",'".$review."')";

	$conn->query($sql);
			
	$conn-> close();
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>