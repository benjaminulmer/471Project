<!DOCTYPE html>

<html>
	<head>
		<title>Moderator Page</title>
	</head>
	
	<style>
		h1 {
			width: 500px;
			margin: 50px auto;
		}
		form {
			display: inline;
		}		
	</style>
	
	<body>
		<?php include 'header.php' ?>
		
		<font color="#3498DB"><center><h1>Moderator Page</h1></center></font>
		<center>
			<form action="addMovie.php">
			<input type="submit" class="button" value="Add Film">
			</form>
			<span style="display: inline-block; width: 1px;"></span>
			<form action="addPerson.php">
			<input type="submit" class="button" value="Add Person">
			</form>
			<span style="display: inline-block; width: 1px;"></span>
			<form action="addStudio.php">
			<input type="submit" class="button" value="Add Studio">
			</form>

			
		</center>
	</body>
</html>