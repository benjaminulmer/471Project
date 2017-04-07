<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Studio</title>
	</head>
		<style>
		h1 {
			width: 500px;
			margin: 50px auto;
		}
		.button {
			width: 249px;
			padding: 6px 15px;
			border: 2px solid #3498DB;
			background-color: #3498DB;
			color: white;
			font-size: 16px;
		}
		.button2 {
			position: absolute;
			top: 0;
			left: 0;
			padding: 6px 15px;
			border: 2px solid #3498DB;
			background-color: #3498DB;
			color: #fafafa;
		}
		.button3 {
			position: absolute;
			top: 0;
			right: 81px;
			padding: 6px 15px;
			color: #3498DB;
		}
		.button4 {
			position: absolute;
			top: 0;
			right: 0;
			padding: 6px 15px;
			border: 2px solid #3498DB;
			background-color: #3498DB;
			color: #fafafa;
		}
		.button:hover {
			background-color: #fafafa;
			color: #207cca;
		}
		.button2:hover {
			background-color: #fafafa;
			color: #207cca;
		}
		.button3:hover {
			background-color: #fafafa;
			color: #207cca;
		}
		.button4:hover {
			background-color: #fafafa;
			color: #207cca;
		}
	</style>
	
	
	<body>
		<?php include 'header.php' ?>
		<font color="#3498DB"><center><h1>Studio</h1></center></font>		

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