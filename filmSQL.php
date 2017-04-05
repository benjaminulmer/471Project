<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Films</title>
	</head>
	<body>
		<h1>Film</h1>
		<?php
			// put your code here
			$servername = "localhost";		  //should be same for you
			$username = "root";				 //same here
			$password = "";					 //your localhost root password
			$db = "films_db";				   //your database name
			
			$conn = new mysqli($servername, $username, $password, $db);
			
			if($conn->connect_error){
				die("Connection failed".$conn->connect_error);
			}
			
			$filmID = 1;
			
			// Film information
			$sql = "SELECT * 
			        FROM films f
			        WHERE f.ID = ".$filmID;

			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			$row = $result->fetch_assoc();
			echo "Name: ".$row["name"]."<br>"; 
			echo "Year: ".$row["year"]."<br>";
			echo "Runtime: ".$row["runtime"]." minutes<br>";
			echo "Budget: $".$row["budget"]."<br>";
			echo "Box Office: $".$row["boxOffice"]."<br>";
			echo "Description: ".$row["description"]."<br>";
			
			// Director information
			$dirID = $row["director"];
			$sql = "SELECT * 
			        FROM directors d, persons p
					WHERE d.ID = ".$dirID."
					      AND p.ID = ".$dirID;
			
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			if($result->num_rows >0) {
				$row = $result->fetch_assoc();
				echo "Director: ".$row["name"]."<br>"; 
			}
			
			// Cast
			$sql = "SELECT * 
			        FROM actors a, persons p, acted_in ac
					WHERE a.ID = p.ID
					      AND a.ID = ac.actorID
						  AND ac.filmID = ".$filmID;
			
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			if($result->num_rows >0){
				echo "<br>Cast:<br>";
				while($row = $result->fetch_assoc()){
					echo $row["name"]." as ".$row["role"]."<br>";
				}
			}			
						  
			// Studios		  
			$sql = "SELECT * 
			        FROM studios s, worked_on w
					WHERE s.ID = w.studioID
						  AND w.filmID = ".$filmID;
			
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			if($result->num_rows >0){
				echo "<br>Studios:<br>";
				while($row = $result->fetch_assoc()){
					echo $row["name"]." as ".$row["role"]."<br>";
				}
			}		  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
			
			$conn-> close();			//close the connection to database
		?>
	</body>
</html>
