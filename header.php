<?php
session_start();
?>
<!DOCTYPE html>

<html>
	<style>
		h1 {
			width: 500px;
			margin: 50px auto;
		}
		.search {
			padding: 8px 15px;
			background: rgba(50, 50, 50, 0.2);
			border: 0px solid #dbdbdb;
		}
		.button {
			position: relative;
			padding: 6px 15px;
			left: -8px;
			border: 2px solid #3498DB;
			background-color: #3498DB;
			color: #fafafa;
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
			<input type="submit" class="button3" value="Log In">
			</form>
			<form action="signUpPage.php">
			<input type="submit" class="button4" value="Sign Up">
			</form>
			<?php
		}
		?>	
	</body>
</html>