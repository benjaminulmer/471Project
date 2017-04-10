<!DOCTYPE html>

<html>
	<head>
		<title>Add Person</title>
	</head>
	
	<style>
		h1 {
			width: 500px;
			margin: 50px auto;
		}
		.button {
			width: 173px;
			margin-left: 16px;
			padding: 6px 15px;
			border: 2px solid #3498DB;
			background-color: #3498DB;
			color: white;
		}
		.button:hover {
			background-color: #fafafa;
			color: #207cca;
		}
	</style>

<?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'films_db');
	$db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	
	if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} 
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// username and password sent from form
		
		$personname = mysqli_real_escape_string($db,$_POST['name']);
		$actor = mysqli_real_escape_string($db,$_POST['actor']);
		$director = mysqli_real_escape_string($db,$_POST['director']);
		$dateOfBirth = mysqli_real_escape_string($db,$_POST['dateOfBirth']);
		$dateOfDeath = mysqli_real_escape_string($db,$_POST['dateOfDeath']);
		
		$query = "INSERT INTO persons (name, dateOfBirth, dateOfDeath)
		VALUES('$personname', '$dateOfBirth', '$dateOfDeath')";
		$db->query($query);
		
		if($actor == 'Actor'){
			$query = "SELECT MAX(ID) AS max FROM persons";
			$result=  $db->query($query);
			$row = $result->fetch_assoc();
			$actorID = $row["max"];
			
			$query = "INSERT INTO actors (ID)
			VALUES('$actorID')";
			$db->query($query);
		}
		if($director == 'Director'){
			$query = "SELECT MAX(ID) AS max FROM persons";
			$result=  $db->query($query);
			$row = $result->fetch_assoc();
			$directorID = $row["max"];
			
			$query = "INSERT INTO directors (ID)
			VALUES('$directorID')";
			$db->query($query);
		}
		
		$accmessage = "Person Added";
		$db->close();
		echo "<script type='text/javascript'>alert('$accmessage'); location='modPage.php';</script>";
	}
?>

	<body>
		<?php include 'header.php' ?>
		
		<font color="#3498DB"><center><h1>Add Person</h1></center></font>
		<center><form action = "" method = "post">
			
			<font style="margin-left: -103px" color="#3498DB"><b>Person Name:</b></font>
			<span style="display: inline-block"></span>
			<input type="text" name="name"><br>
			
			<input style="margin-left: -35px" type="checkbox" name="actor" value="Actor"> Actor
			<input type="checkbox" name="director" value="Director"> Director<br><br>
			
			<font style="margin-left: -131px" color="#3498DB"><b>Date of Birth:</b></font>
			<span style="display: inline-block"></span>
			<input type="date" name="dateOfBirth"><br><br>

			<font style="margin-left: -135px" color="#3498DB"><b>Date of Death: </b></font>
			<span style="display: inline-block"></span>
			<input type="date" name="dateOfDeath"><br><br>

			
			<input type="submit" class="button" name="submit" value="Add Person"><br><br>
		</form></center>
	</body>
</html>