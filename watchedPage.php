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
		.search {
			padding: 8px 15px;
			background: rgba(50, 50, 50, 0.2);
			border: 0px solid #dbdbdb;
		}
		.button {
			position: relative;
			padding: 6px 15px;
			left: -8px;
			border: 2px solid #3498DB;
			background-color: #3498DB;
			color: #fafafa;
		}
		.button:hover {
			background-color: #fafafa;
			color: #207cca;
		}
	</style>	
	
	<body>
		<?php include 'header.php' ?>
		<font color="#3498DB"><center><h1>Watched Films</h1></center></font>
		<?php
		
		/*
		Code to open page will look something like this:
		
		<form action="studioPage.php" method="get">
			<input type="submit" class="button" name="ID" value="1">
		</form>
		
		can also be accessed directly with .../studioPage.php?ID=1
		*/

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