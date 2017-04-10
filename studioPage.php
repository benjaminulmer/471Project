<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Studio Page</title>
	</head>
	
	<style>
		h1 {
			width: 500px;
			margin: 50px auto;
		}
	</style>
	
	<body>
		<?php include 'header.php' ?>
		<font color="#3498DB"><center><h1>Studio Details</h1></center></font>
		<?php
		
		$conn;
		include 'dbConnect.php';
		
		$studioID = $_GET["ID"]; // This determines which studio to show info for
		
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
		echo "<b>Name: </b>".$row["name"]."<br>"; 
		if ($row["founded"] != 0) {
			echo "<b>Founded: </b>".$row["founded"]."<br>";
		}
		echo "<b>Headquarters: </b>".$row["headquarters"]."<br>";
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
				echo "<br><b>Worked on:</b><br>";
				while($row = $result->fetch_assoc()){
					
					echo "<a href=\"filmPage.php?ID=".$row["ID"]."\">";		
					echo $row["fName"]." (".$row["year"].")</a><br>";
				}
			}
		}
		
		?>
	</body>
</html>