<?php
session_start();
?>
<!DOCTYPE html>

<html>
	<head>
		<title>Sign Up Page</title>
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
		
		$myusername = mysqli_real_escape_string($db,$_POST['username']);
		$mypassword = mysqli_real_escape_string($db,$_POST['password']);
		
		$sql = "SELECT username 
				FROM users 
				WHERE username = '$myusername' ";
				
		$result = $db->query($sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$active = $row['active'];
		
		$count = mysqli_num_rows($result);
		
		// if result matched $myusername and $mypassword, table row must be 1 row
		// means the account is already made
		if ($count == 1) {
			
			session_destroy();
			$message = "Username already taken.";
			$db->close();
			echo "<script type='text/javascript'>alert('$message'); location='signUpPage.php';</script>";
		}
		else {
			$query = "INSERT INTO users (username, passwordHash, moderator)
				      VALUES('$myusername', '$mypassword', '0')";
			
			mysqli_query($db, $query);
			$accmessage = "Account Created";
			$db->close();
			echo "<script type='text/javascript'>alert('$accmessage'); location='loginPage.php';</script>";
		}
	}
?>	

	<body>
		<form action="homePage.php">
			<input type="submit" class="button2" value="Home">
		</form>
		<form action="loginPage.php">
			<input type="submit" class="button3" value="Log In">
		</form>
		<font color="#3498DB"><center><h1>Create An Account</h1></center></font>
		<center><form action = "" method = "post">
			<font color="#3498DB"><b>Username:</b></font>
			<span style="display: inline-block; width: 3px;"></span>
			<input type="text" name="username"><br><br>
			<font color="#3498DB"><b>Password:</b></font>
			<span style="display: inline-block; width: 7px;"></span>
			<input type="password" name="password"><br><br>
			<input type="submit" class="button" name="submit" value="Create Account"><br><br>
		</form></center>
	</body>
</html>