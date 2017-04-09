<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Film Page</title>
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
		.button:hover {
			background-color: #fafafa;
			color: #207cca;
		}

	</style>
	
	
	<body>		
		<?php include 'header.php' ?>
		<font color="#3498DB"><center><h1>Film Details</h1></center></font>
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
		?>
		<form action = "editFilmInfo.php?ID=" method = "GET">
		<?php
		// Basic film info
		$row = $result->fetch_assoc();
		//name
		echo "<b>Name: </b>".$row["name"]."<br>";
		?>
		<input type="hidden" name = "ID" value = "<?php echo $filmID; ?>">
		<input type="text" name="name" value = "<?php echo $row["name"]; ?>"><br><br>
		<?php
		//Year
		echo "<b>Year: </b>".$row["year"]."<br>";
		?>
		<input type="year" name="year" value = "<?php echo $row["year"]; ?>"><br><br>
		<?php
		//Runtime
		echo "<b>Runtime: </b>".$row["runtime"]." minutes<br>";
		?>
		<input type="number" name="runtime" value = "<?php echo $row["runtime"]; ?>"><br><br>
		<input type="submit" class="button" name="submit" value="Edit Info"><br><br>
		</form>
		
		
		
		<?php
		// Store description and dirID for later
		$description = "<b>Description:</b><br>".$row["description"]."<br>";
		$dirID = $row["director"];
		
		genres();
		echo "<br><br>".$description;
		?>
		<form action = "editFilmDesc.php" method = "GET">
		<input type="hidden" name = "ID" value = "<?php echo $filmID; ?>">
		
		<TEXTAREA NAME="description"  ROWS=5 COLS=65 ><?php echo $row["description"]; ?></TEXTAREA><br>
		<input type="submit" class="button" name="submit" value="Edit Description"><br><br>
		</form>
		
		
		<?php
		
		
		director();
		cast();
		awards();
		echo "<br><b>Box Office:</b><br>";
		echo "<u>Budget:</u> $".$row["budget"]."<br>";
		echo "<u>Gross:</u> $".$row["boxOffice"]."<br>";
		studios();
		trailers();
		sequelsAndSimilar();
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
				echo "<b>Genre: </b>";
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
				echo "<br><b>Directors:</b> <a href=\"personPage.php?ID=".$dirID."\">";
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
				echo "<br><b>Stars:</b><br>";
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
				echo "<br><b>Awards won:</b><br>";
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
				echo "<br><b>Awards nominated:</b><br>";
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
				echo "<br><b>Studios:</b></br>";
				while($row = $result->fetch_assoc()){
					echo "<a href=\"studioPage.php?ID=".$row["studioID"]."\">";
					echo $row["name"]."</a><br>";
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
				echo "<br><b>Trailers:</b></br>";
				while($row = $result->fetch_assoc()){
					
					echo "<a href=\"".$row["trailer"]."\">";
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
				echo "<br><b>Sequels:</b><br>";
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
				echo "<br><b>Similar films:</b><br>";
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
				echo "<br><b>Reviews:</b><br>";
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