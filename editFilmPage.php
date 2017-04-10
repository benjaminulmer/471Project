<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Edit Film Page</title>
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
		<form action = "deleteFilm.php" method = "GET">
		<input type="hidden" name = "ID" value = "<?php echo $filmID; ?>">
		<input type="submit" class = "button" name = "submit" value = "Delete Film from the Database"><br><br>
		
		</form>
		
		<form action = "editFilmInfo.php?ID=" method = "GET">
		<?php
		// Basic film info setting
		$row = $result->fetch_assoc();
		//name setting
		echo "<b>Name: </b>".$row["name"]."<br>";
		?>
		<input type="hidden" name = "ID" value = "<?php echo $filmID; ?>">
		<input type="text" name="name" value = "<?php echo $row["name"]; ?>"><br><br>
		<?php
		//Year seting
		echo "<b>Year: </b>".$row["year"]."<br>";
		?>
		<input type="year" name="year" value = "<?php echo $row["year"]; ?>"><br><br>
		<?php
		//Runtime setting
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
		
		//Description setting
		echo "<br><br>".$description;
		?>
		<form action = "editFilmDesc.php" method = "GET">
		<input type="hidden" name = "ID" value = "<?php echo $filmID; ?>">		
		<TEXTAREA NAME="description"  ROWS=5 COLS=65 ><?php echo $row["description"]; ?></TEXTAREA><br>
		<input type="submit" class="button" name="submit" value="Edit Description"><br><br>
		</form>
		
		
		<?php
		//check if director is set
		if (isset($dirID))  {
				director();
			}
		else{
			setdirector();
		}
		
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
			global $filmID, $dirID, $conn;
			
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
				//Delete
				?>
				<form action = "removeFilmDirector.php" method = "GET">
				<input type="hidden" name = "ID" value = "<?php echo $filmID; ?>">
				<input type="hidden" name = "dirID" value = "<?php echo $dirID; ?>">
				<input type="submit" class="button" name="submit" value="Delete Director"><br><br>
				</form>
				<?php
			}
			else{
				
			}
		}
		
		function setdirector() {
			global $filmID, $conn;
				?>
				<form action = "addFilmDirector.php" method = "GET">
				<font color="#3498DB"><b>Add Director(Use ID):</b></font>
				<input type="hidden" name = "ID" value = "<?php echo $filmID; ?>">
				<input type="number" name="dirID"><br>				
				<input type="submit" class="button" name="submit" value="Add Director"><br><br>
				</form>
				Directors
				<?php
		
				
				
				
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 
				
				$sql = "SELECT d.ID, name FROM directors AS d, persons AS p
				WHERE d.ID = p.ID
				GROUP BY ID";
				$result = $conn->query($sql);
				
				if ($result->num_rows > 0) {
					echo "<table><tr><th>ID</th><th>Name</th></tr>";
					// output data of each row
					while($row = $result->fetch_assoc()) {
						echo "<tr><td>".$row["ID"]."</td><td>".$row["name"]."</td></tr>";
					}
				echo "</table>";
				} else {
					echo "0 results";
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
					?>
					<form action = "removeFilmActor.php" method = "GET">
					<input type="hidden" name = "filmID" value = "<?php echo $filmID; ?>">
					<input type="hidden" name = "actID" value = "<?php echo $row["actorID"]; ?>">
					<input type="submit" class="button" name="submit" value="Delete Actor"><br>
					</form>
					<?php
					
				}
			}	
			
			//Add Actors to movie
			?>
			<form action = "addFilmActors.php" method = "GET">
			<font color="#3498DB"><b>Add Actor(Use ID):</b></font><br>
			<input type="hidden" name = "filmID" value = "<?php echo $filmID; ?>">
			ID:
			<input type="number" name="actID"><br>
			Role:
			<input type= "text" name = "role"><br>
			<input type="submit" class="button" name="submit" value="Add Actor"><br>
			</form>
			<br>
			<b>Actors</b><?php
			//List the actors and IDS
			$sql = "SELECT a.ID, name FROM actors AS a, persons AS p
			WHERE a.ID = p.ID
			GROUP BY ID";
			
			$result2 = $conn->query($sql);
		
			if ($result2->num_rows > 0) {
				echo "<table><tr><th>ID</th><th>Name</th></tr>";
				
				while($row = $result2->fetch_assoc()) {
					echo "<tr><td>".$row["ID"]."</td><td>".$row["name"]."</td></tr>";
				}
			echo "</table>";
			} else {
				echo "0 results";
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
					echo $row["review"]."<br>";
					?>
					<form action = "removeFilmReview.php" method = "GET">
					<input type="hidden" name = "filmID" value = "<?php echo $filmID; ?>">
					<input type="hidden" name = "userID" value = "<?php echo $row["userID"]; ?>">
					<input type="submit" class="button" name="submit" value="Delete Review"><br>
					</form>
					<?php
				}
			}
		}
		

		?>
				

	</body>
</html>