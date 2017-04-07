<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Film</title>
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
		<font color="#3498DB"><center><h1>Film</h1></center></font>
		<?php
		
			/*
			Code to open page will look something like this:
			
			<form action="filmPage.php" method="get">
				<input type="submit" class="button" name="ID" value="3">
			</form>
			
			can also be accessed directly with .../filmPage.php?ID=3
			*/
		
			$conn;
			include 'dbConnect.php';
			
			$filmID = $_GET["ID"]; // This determines which film to show info for
			
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
			
			genres();
			director();
			echo "<br>".$description;
			cast();
			awards();
			studios();
			sequelsAndSimilar();
			trailers();
			reviews();
			
			$conn-> close();
			
		// Prints genres	
		function genres() {
			global $filmID, $conn;
			
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
		}	
			
		// Prints director
		function director() {
			global $dirID, $conn;
			
			$sql = "SELECT * 
					FROM directors d, persons p
					WHERE d.ID = ".$dirID."
						  AND p.ID = d.ID";
			
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Director name
			if($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				echo "<br>Director: <a href=\"personPage.php?ID=".$dirID."\">";
				echo $row["name"]."</a><br>"; 
			}
		}
		
		// Prints cast
		function cast() {
			global $filmID, $conn;
			
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
			if($result->num_rows > 0){
				echo "<br>Cast:<br>";
				while($row = $result->fetch_assoc()){
					echo "<a href=\"personPage.php?ID=".$row["actorID"]."\">";
					echo $row["name"]."</a> as ".$row["role"]."<br>";
				}
			}	
		}
		
		// Prints awards
		function awards() {
			global $filmID, $conn;
			
			// Awards won
			$sql = "SELECT p.ID AS pID, p.Name AS pName, a.name AS aName, a.year, a.organization
			        FROM awards a, won w, persons p
					WHERE w.personID = p.ID
					      AND w.awardID = a.ID
						  AND w.filmID = ".$filmID;

			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Print out awards
			if($result->num_rows > 0){
				echo "<br>Awards won:<br>";
				while($row = $result->fetch_assoc()){
					echo "<a href=\"personPage.php?ID=".$row["pID"]."\">";
					echo $row["pName"]."</a> for ".$row["organization"]." ".$row["aName"]." ".$row["year"]."<br>";
				}
			}
			
			// Awards nominated
			$sql = "SELECT p.ID AS pID,  p.Name AS pName, a.name AS aName, a.year, a.organization
			        FROM awards a, nominated w, persons p
					WHERE w.personID = p.ID
					      AND w.awardID = a.ID
						  AND w.filmID = ".$filmID;

			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Print out awards
			if($result->num_rows > 0){
				echo "<br>Awards nominated:<br>";
				while($row = $result->fetch_assoc()){
					echo "<a href=\"personPage.php?ID=".$row["pID"]."\">";
					echo $row["pName"]."</a> for ".$row["organization"]." ".$row["aName"]." ".$row["year"]."<br>";
				}
			}
		}
		
		// Prints studios
		function studios() {
			global $filmID, $conn;
						
			$sql = "SELECT * 
			        FROM studios s, worked_on w
					WHERE s.ID = w.studioID
						  AND w.filmID = ".$filmID;
			
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Print out studios
			if($result->num_rows > 0){
				echo "<br>Studios:<br>";
				while($row = $result->fetch_assoc()){
					echo "<a href=\"studioPage.php?ID=".$row["studioID"]."\">";
					echo $row["name"]."</a><br>";
				}
			}	
		}
		
		// Prints sequels and similar films
		function sequelsAndSimilar() {
			global $filmID, $conn;
			
			// Sequels
			$sql = "SELECT * 
			        FROM films f, sequel_to s
					WHERE s.sequelID = f.ID
						  AND s.baseFilmID = ".$filmID."
					ORDER BY f.year";
			
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Print out sequels
			if($result->num_rows > 0){
				echo "<br>Sequels:<br>";
				while($row = $result->fetch_assoc()){
					echo "<a href=\"filmPage.php?ID=".$row["sequelID"]."\">";
					echo $row["name"]." (".$row["year"].")"."</a><br>";
				}
			}	
			
			// Similar films
			$sql = "SELECT * 
			        FROM films f, similar_films s
					WHERE (s.film1ID = f.ID
						  AND s.film2ID = ".$filmID.") OR
						  (s.film2ID = f.ID
						  AND s.film1ID = ".$filmID.")
					ORDER BY f.year";
			
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Print out similar films
			if($result->num_rows > 0){
				echo "<br>Similar films:<br>";
				while($row = $result->fetch_assoc()){
					
					// Figure out what the ID of the other film is
					$otherID;
					if ($row["film1ID"] == $filmID) {
						$otherID = $row["film2ID"];
					}
					else {
						$otherID = $row["film1ID"];
					}
					echo "<a href=\"filmPage.php?ID=".$otherID."\">";
					echo $row["name"]." (".$row["year"].")"."</a><br>";
				}
			}
		}
		
		// Prints trailers
		function trailers() {
			global $filmID, $conn;
			
			$sql = "SELECT * 
			        FROM trailers t
					WHERE t.filmID = ".$filmID;
			
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Print out trailers
			if($result->num_rows > 0){
				echo "<br>Trailers:<br>";
				while($row = $result->fetch_assoc()){
					
					echo "<a href=\"".$row["trailer"]."\">";
					echo $row["name"]."</a><br>";
				}
			}
		}
		
		// Prints reviews
		function reviews() {
			global $filmID, $conn;
			
			$sql = "SELECT * 
			        FROM reviews r, users u
					WHERE u.ID = r.userID
					      AND r.filmID = ".$filmID;
			
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Print out reviews
			if($result->num_rows > 0){
				echo "<br>Reviews:<br>";
				while($row = $result->fetch_assoc()){
					
					echo "<a href=\"userPage.php?ID=".$row["userID"]."\">";
					echo $row["username"]."</a>: ".$row["rating"]."/10<br>";
					echo $row["review"]."<br><br>";
				}
			}
		}
		
		?>
	</body>
</html>
