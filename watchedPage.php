<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Watched Films</title>
	</head>

	<style>
		h1 {
			width: 500px;
			margin: 50px auto;
		}
	</style>	
	
	<body>
		<?php include 'header.php' ?>
		<font color="#3498DB"><center><h1>Watched Films</h1></center></font>
		<?php
		
		$conn;
		include 'dbConnect.php';
		
		$userID = $_GET["ID"]; // This determines which user to show info for
		
		// **** User information **** //
		$sql = "SELECT * 
				FROM users u
				WHERE u.ID = ".$userID;
		$result = $conn->query($sql);
		if ($result == NULL) {
			die("Failed");
		}
		
		// Basic user info
		$row = $result->fetch_assoc();
		echo "<b>Name: </b>";
		echo "<a href=\"userPage.php?ID=".$userID."\">";
		echo $row["username"]; 
		echo "</a><br>";
		
		watched();
		$conn-> close();
		
		// Prints watched
		function watched() {
			global $userID, $conn;
			
			$sql = "SELECT * 
			        FROM watched w, films f
					WHERE f.ID = w.filmID
					      AND w.userID = ".$userID;
			
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Print out watched
			if($result->num_rows > 0){
				echo "<br><b>Watched:</b><br>";
				while($row = $result->fetch_assoc()){
					echo "<a href=\"filmPage.php?ID=".$row["filmID"]."\">";
					echo $row["name"]."</a><br>";
				}
			}
		}
		
		?>
	</body>
</html>