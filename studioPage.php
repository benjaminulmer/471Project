<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Studio</title>
	</head>
	<body>
		<h1>Studio</h1>
		<?php
		
			/*
			Code to open page will look something like this:
			
			<form action="studioPage.php" method="get">
				<input type="submit" class="button" name="ID" value="1">
			</form>
			
			can also be accessed directly with .../studioPage.php?ID=1
			*/
	
	
			// Connect to the database
			$servername = "localhost";		  //should be same for you
			$username = "root";				 //same here
			$password = "";					 //your localhost root password
			$db = "films_db";				   //your database name
			
			$conn = new mysqli($servername, $username, $password, $db);
			if($conn->connect_error){
				die("Connection failed".$conn->connect_error);
			}
			
			$studioID = $_GET["ID"]; // This determines which person to show info for
			
			// **** Studio information **** //
			$sql = "SELECT * 
			        FROM studios s
			        WHERE s.ID = ".$studioID;

			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Basic studio info
			$row = $result->fetch_assoc();
			echo "Name: ".$row["name"]."<br>"; 
			if ($row["founded"] != 0) {
				echo "Founded: ".$row["founded"]."<br>";
			}
			echo "Headquarters: ".$row["headquarters"]."<br>";

			films();
			$conn-> close();
		
		// Prints out films worked on
		function films() {
			global $studioID, $conn;
			
			$sql = "SELECT f.name as fName, f.year, f.ID
			        FROM films f, worked_on w
			        WHERE w.filmID = f.ID
					      AND w.studioID = ".$studioID."
					ORDER BY f.year";
					
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Prints out films
			if($result->num_rows > 0){
				echo "<br>Worked on:<br>";
				while($row = $result->fetch_assoc()){
					
					echo "<a href=\"filmPage.php?ID=".$row["ID"]."\">";		
					echo $row["fName"]." (".$row["year"].")</a><br>";
				}
			}
		}
		
		?>
	</body>
</html>
