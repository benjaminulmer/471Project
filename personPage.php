<?php
session_start();
?>
<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Person</title>
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
		<form action="homePage.php">
		<input type="submit" class="button2" value="Home">
		</form>
		<?php
		if (isset($_SESSION['login_user'])){
			?>
			
			<form action="logout.php">
			<input type="submit" class="button4" value="Log Out: <?php echo $_SESSION['login_user']; ?>">
			</form>
			<?php
		} else {
		?>
			<form action="loginPage.php">
			<input type="submit" class="button2" value="Log In">
			</form>
			<form action="signUpPage.php">
			<input type="submit" class="button3" value="Sign Up">
			</form>
			<?php
		}
		?>
	
		<font color="#3498DB"><center><h1>Person</h1></center></font>
		
		<?php
		
			/*
			Code to open page will look something like this:
			
			<form action="personPage.php" method="get">
				<input type="submit" class="button" name="ID" value="3">
			</form>
			
			can also be accessed directly with .../personPage.php?ID=3
			*/
	
			$conn;
			include 'dbConnect.php';
			
			$personID = $_GET["ID"]; // This determines which person to show info for
			
			// **** Person information **** //
			$sql = "SELECT * 
			        FROM persons p
			        WHERE p.ID = ".$personID;

			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Basic person info
			$row = $result->fetch_assoc();
			echo "Name: ".$row["name"]."<br>"; 
			if ($row["dateOfBirth"] != 0) {
				echo "Date of birth: ".$row["dateOfBirth"]."<br>";
			}
			if ($row["dateOfDeath"] != 0) {
				echo "Date of death: ".$row["dateOfDeath"]."<br>";
			}
			
			director();
			actor();
			awards();
			$conn-> close();
			
		// Prints director info	
		function director() {
			global $personID, $conn;
			
			$sql = "SELECT * 
			        FROM directors d
					WHERE d.ID = ".$personID;
			
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// If person is a director
			if($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				
				$favFilm = $row["favFilm"];
				$sql = "SELECT f.name, f.ID AS fID, f.year
				        FROM directors d, films f
				        WHERE d.ID = ".$personID."
				              AND f.director = d.ID
						ORDER BY f.year";
				
				$result = $conn->query($sql);
				if ($result == NULL) {
					die("Failed");
				}
				
				// Print all films directed
				if($result->num_rows > 0) {
					echo "<br>Directed:<br>";
					while($row = $result->fetch_assoc()){
						
						echo "<a href=\"filmPage.php?ID=".$row["fID"]."\">";
						echo $row["name"]." (".$row["year"].")"."</a>";
						
						if ($row["fID"] == $favFilm) {
							echo " - favourite film directed";
						}
						echo "<br>";
					}
				}
			}
		}	
			
		// Prints actor info
		function actor() {
			global $personID, $conn;
			
			$sql = "SELECT * 
			        FROM actors a
					WHERE a.ID = ".$personID;
			
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// If person is an actor
			if($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				
				$favFilm = $row["favRole"];
				$sql = "SELECT f.name, f.ID AS fID, f.year, ac.role 
				        FROM actors a, films f, acted_in ac
				        WHERE a.ID = ".$personID."
				              AND ac.actorID = a.ID
							  AND ac.filmID = f.ID
						ORDER BY f.year";
				
				$result = $conn->query($sql);
				if ($result == NULL) {
					die("Failed");
				}
				
				// [film] as [role]
				if($result->num_rows > 0) {
					echo "<br>Stared in:<br>";
					while($row = $result->fetch_assoc()){
						
						echo "<a href=\"filmPage.php?ID=".$row["fID"]."\">";
						echo $row["name"]." (".$row["year"].")"."</a>"." as ".$row["role"];			
						
						if ($row["fID"] == $favFilm) {
							echo " - favourite role";
						}
						echo "<br>";
					}
				}
			}
		}	
		
		// Prints awards
		function awards() {
			global $personID, $conn;
			
			// Awards won
			$sql = "SELECT f.Name AS fName, a.name AS aName, a.year, a.organization, f.ID
			        FROM awards a, won w, films f
					WHERE w.awardID = a.ID
						  AND w.filmID = f.ID
						  AND w.personID = ".$personID;

			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Print out awards
			if($result->num_rows > 0){
				echo "<br>Awards won:<br>";
				while($row = $result->fetch_assoc()){
					
					echo "<a href=\"filmPage.php?ID=".$row["ID"]."\">";
					echo $row["fName"]."</a> for ".$row["organization"]." ".$row["aName"]." ".$row["year"]."<br>";
				}
			}
			
			// Awards nominated
			$sql = "SELECT f.Name AS fName, a.name AS aName, a.year, a.organization, f.ID
			        FROM awards a, nominated w, films f
					WHERE w.awardID = a.ID
						  AND w.filmID = f.ID
						  AND w.personID = ".$personID;

			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Print out awards
			if($result->num_rows > 0){
				echo "<br>Awards nominated:<br>";
				while($row = $result->fetch_assoc()){
					
					echo "<a href=\"filmPage.php?ID=".$row["ID"]."\">";
					echo $row["fName"]."</a> for ".$row["organization"]." ".$row["aName"]." ".$row["year"]."<br>";
				}
			}
		}
		
		?>
	</body>
</html>
