<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<title>User</title>
	</head>
	<body>
		<h1>User</h1>
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
			
			// Basic studio info
			$row = $result->fetch_assoc();
			echo "Name: ".$row["username"]; 
			if ($row["moderator"]) {
				echo " - Moderator";
			}
			echo "<br><br>";

			echo "See watched films<br>";
			echo "See recommendation queue<br>";
			
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
				echo "<br>Reviews:<br>";
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
