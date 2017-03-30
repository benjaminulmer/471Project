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
			padding: 6px 15px;
			border: 2px solid #3498DB;
			background-color: #3498DB;
			color: white;
			font-size: 16px;
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
	
	<body>
		<form action="homePage.php">
			<input type="submit" class="button2" value="Log In">
		</form>
		<form action="homePage.php">
			<input type="submit" class="button3" value="Sign Up">
		</form>
		<font color="#3498DB"><center><h1>Wan Shi Tong's Library</h1></center></font>
		<img src="img/wan_shi_tong.jpg" alt="Wan Shi Tong" style="width:274px;height:198px;">
		<center><form action="searchByName.php">
			<input type="submit" class="button" value="Search By Name">
		</form>
		<form action="searchByFilter.php">
			<input type="submit" class="button" value="Search By Filter">
		</form></center>
	</body>
</html>