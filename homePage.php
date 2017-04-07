<?php
session_start();
?>
<!DOCTYPE html>

<html>
	<head>
		<title>Home Page</title>
	</head>
	
	<style>
		h1 {
			width: 500px;
			margin: 50px auto;
		}
		form {
			display: inline;
		}
		.button {
			width: 250px;
			padding: 6px 15px;
			border: 2px solid #3498DB;
			background-color: #3498DB;
			color: white;
		}
		.button2 {
			position: absolute;
			top: 0;
			right: 81px;
			padding: 6px 15px;
			color: #3498DB;
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
		.button4 {
			position: absolute;
			bottom: 0;
			left: 0;
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
			<input type="submit" class="button3" value="Log Out: <?php echo $_SESSION['login_user']; ?>">
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

		<font color="#3498DB"><center><h1>Ultimate Movie Database of Ultimate Destiny</h1></center></font>
		<center>
			<img src="img/logo.png" alt="logo" style="width:304px;heigh:228px;"><br><br>
			<form action="searchByName.php">
				<input type="submit" class="button" value="Search By Name">
			</form>
			<span style="display: inline-block; width: 1px;"></span>
			<form action="searchByFilter.php">
			<input type="submit" class="button" value="Search By Filter">
			</form>
		</center>
		<?php
		if (isset($_SESSION['is_mod']) And ($_SESSION['is_mod'] == 1)){
			?>
			
			<form action="modPage.php">
			<input type="submit" class="button4" value="It's a secret!">
			</form>
			<?php
		} 
		?>
		
	</body>
</html>