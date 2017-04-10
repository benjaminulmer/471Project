<!DOCTYPE html>

<html>
	<head>
		<title>Add Studio</title>
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
		
		$studioname = mysqli_real_escape_string($db,$_POST['name']);
		$founded = mysqli_real_escape_string($db,$_POST['founded']);
		$headquarters = mysqli_real_escape_string($db,$_POST['headquarters']);
		
		$sql = "SELECT name 
				FROM studios 
				WHERE name = '$studioname' 
				";
				
		$result = $db->query($sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$active = $row['active'];
		
		$count = mysqli_num_rows($result);
		
		// if result matched $myusername and $mypassword, table row must be 1 row
		// means the account is already made
		if ($count == 1) {
			
			session_destroy();
			$message = "Studio name already taken.";
			$db->close();
			echo "<script type='text/javascript'>alert('$message'); location='addStudio.php';</script>";
		}
		else {
			
			$query = "INSERT INTO studios (name, founded, headquarters)
			VALUES('$studioname', '$founded', '$headquarters')";
			
			$db->query($query);
			$accmessage = "Studio Added";
			$db->close();
			echo "<script type='text/javascript'>alert('$accmessage'); location='modPage.php';</script>";
		}
	}
?>

	<body>
		<?php include 'header.php' ?>
		
		<font color="#3498DB"><center><h1>Add Studio</h1></center></font>
		<center><form action = "" method = "post">
			
			<font style="margin-left: -100px" color="#3498DB"><b>Studio Name:</b></font>
			<span style="display: inline-block"></span>
			<input type="text" name="name"><br><br>
			
			<font style="margin-left: -100px" color="#3498DB"><b>Founded:</b></font>
			<span style="display: inline-block"></span>
			<input type="date" name="founded"><br><br>			
			
			<font style="margin-left: -100px" color="#3498DB"><b>Headquaters:</b></font>
			<span style="display: inline-block"></span>
			<input type="text" name="headquarters"><br><br>
			
			
			<input type="submit" class="button" name="submit" value="Add Studio"><br><br>
		</form></center>
	</body>
</html>
