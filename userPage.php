<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<title>User Page</title>
	</head>

	<style>
		h1 {
			width: 500px;
			margin: 50px auto;
		}
	</style>	
	
	<body>
		<?php include 'header.php' ?>
		<font color="#3498DB"><center><h1>User Details</h1></center></font>
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
		echo "<b>Name: </b>".$row["username"]; 
		if ($row["moderator"]) {
			echo "*";	// Includes star if user is a moderator
		}
		echo "<br><br>";
		
		echo "<a href=\"watchedPage.php?ID=".$row["ID"]."\">";
		echo "Films ".$row["username"]." has seen</a><br>";
		
		echo "<a href=\"recommendPage.php?ID=".$row["ID"]."\">";
		echo $row["username"]."'s recommendation queue</a><br>";
		
		reviews();
		$conn-> close();
		
		// Prints reviews
		function reviews() {
			global $userID, $conn;
			
			$sql = "SELECT * 
			        FROM reviews r, films f
					WHERE f.ID = r.filmID
					      AND r.userID = ".$userID;
			
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Print out reviews
			if($result->num_rows > 0){
				echo "<br><b>Reviews:</b><br>";
				while($row = $result->fetch_assoc()){
					echo "<a href=\"filmPage.php?ID=".$row["filmID"]."\">";
					echo $row["name"]."</a>: ".$row["rating"]."/10<br>";
					echo $row["review"]."<br><br>";
				}
			}
		}
		
		?>
	</body>
</html>