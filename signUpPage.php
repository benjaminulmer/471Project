<!DOCTYPE html>
<script>
	function popUp() {
		alert("Username Already Taken");
		
	}
	
	function accPopUP() {
		alert("Account Created");
	}

</script>


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
	include("config.php");
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// username and password sent from form
		
		$myusername = mysqli_real_escape_string($db,$_POST['username']);
		$mypassword = mysqli_real_escape_string($db,$_POST['password']);
		
		$sql = "SELECT username 
				FROM users 
				WHERE username = '$myusername' 
				";
				
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$active = $row['active'];
		
		$count = mysqli_num_rows($result);
		
		// if result matched $myusername and $mypassword, table row must be 1 row
		//means the account is already made
		if ($count == 1) {
			
			session_destroy();
			$message = "you done messed up a a ron";
			echo "<script type='text/javascript'>alert('$message'); location='signUpPage.php';</script>";
			
			

		}
		else {
			
			//insert user
			/*
			$query =
			"INSERT 
			INTO users
			VALUES ('$myusername',''$mypassword','0')"
			mysqli_query($db,$query)*/ 
			
			
			if(session_destroy()){}
			
			echo "<script>accPopUP()</script>";
			header("location: loginPage.php");
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