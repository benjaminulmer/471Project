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
		.button:hover {
			background-color: #fafafa;
			color: #207cca;
		}
	</style>
	
	<body>
		<?php include 'header.php' ?>

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

		
	</body>
</html>