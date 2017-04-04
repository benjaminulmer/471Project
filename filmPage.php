<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Films</title>
	</head>
	<body>
		<h1>Film</h1>
		<?php
			// Connect to the database
			$servername = "localhost";		  //should be same for you
			$username = "root";				 //same here
			$password = "";					 //your localhost root password
			$db = "films_db";				   //your database name
			
			$conn = new mysqli($servername, $username, $password, $db);
			if($conn->connect_error){
				die("Connection failed".$conn->connect_error);
			}
			
			$filmID = 3; // This determines which film to show info for
			
			// **** Film information **** //
			$sql = "SELECT * 
			        FROM films f
			        WHERE f.ID = ".$filmID;

			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Basic film info
			$row = $result->fetch_assoc();
			echo "Name: ".$row["name"]."<br>"; 
			echo "Year: ".$row["year"]."<br>";
			echo "Runtime: ".$row["runtime"]." minutes<br>";
			echo "Budget: $".$row["budget"]."<br>";
			echo "Box Office: $".$row["boxOffice"]."<br>";
			
			// Store description and dirID for later
			$description = "Description: ".$row["description"]."<br>";
			$dirID = $row["director"];
			
			// **** Genres **** //
			$sql = "SELECT * 
			        FROM film_genres g
			        WHERE g.filmID = ".$filmID;
					
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Pretty print each genre
			if($result->num_rows > 0){
				echo "Genres: ";
				$i = 0;
				while($row = $result->fetch_assoc()){
					if ($i != 0) {
						echo ", ";
					}
					echo $row["genre"];
					$i++;
				}
			}
			
			// **** Director information **** //
			$sql = "SELECT * 
			        FROM directors d, persons p
					WHERE d.ID = ".$dirID."
					      AND p.ID = ".$dirID;
			
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Director name
			if($result->num_rows >0) {
				$row = $result->fetch_assoc();
				echo "<br>Director: ".$row["name"]."<br>"; 
			}
			
			// Print out desctiption now (after director)
			echo "<br>".$description;
			
			// **** Cast information **** //
			$sql = "SELECT * 
			        FROM actors a, persons p, acted_in ac
					WHERE a.ID = p.ID
					      AND a.ID = ac.actorID
						  AND ac.filmID = ".$filmID;
			
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// [person] as [role]
			if($result->num_rows >0){
				echo "<br>Cast:<br>";
				while($row = $result->fetch_assoc()){
					echo $row["name"]." as ".$row["role"]."<br>";
				}
			}			
						  
			// **** Studio information **** //		  
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
					echo $row["name"]."<br>";
				}
			}		  

			$conn-> close();
		?>
	</body>
</html>
