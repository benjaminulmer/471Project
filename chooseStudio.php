<!DOCTYPE html>

<html>
	<head>
		<title>Choose Studios</title>
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
			position: relative;
			padding: 6px 15px;
			border: 2px solid #3498DB;
			background-color: #3498DB;
			color: #fafafa;
		}
		.button:hover {
			background-color: #fafafa;
			color: #207cca;
		}
	</style>
	
	<body>
		<?php include 'header.php' ?>
		<font color="#3498DB"><center><h1>Choose Studios</h1></center></font>
		
		<center>
		<input type="checkbox">Warner Bros. Animation
		</center><br>
		
		<center>
		<form action="searchByFilter.php"><input type="submit" class="button" value="Ok"></form>
		<span style="display: inline-block; width: 1px;"></span>
		<form><input type="submit" class="button" value="Clear"></form>
		</center>
	</body>
</html>