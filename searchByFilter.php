<!DOCTYPE html>

<html>
	<head>
		<title>Search By Filter</title>
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
		<?php include 'header.php' ?>
		<font color="#3498DB"><center><h1>Search By Filter</h1></center></font>
		<center>
		<form>
			<input type="submit" class="button" value="Actors">
		</form>
		<form>
			<input type="submit" class="button" value="Directors">
		</form>
		<form>
			<input type="submit" class="button" value="Genres">
		</form>
		<form>
			<input type="submit" class="button" value="Studios">
		</form><br><br>
		<form action="">
			<input type="checkbox" name="release date">Sort by
			<span style="display: inline-block; width: 3px;"></span>
			<select>
				<option value="action">newest</option>
				<option value="action">oldest</option>
			</select>
			<span style="display: inline-block; width: 3px;"></span>
			release date<br>
			<input type="checkbox" name="release date">Sort by number of Oscars
			<span style="display: inline-block; width: 3px;"></span>
			<select>
				<option value="action">won</option>
				<option value="action">nominated</option>
			</select><br><br>
			<input type="submit" class="button" name="submit" value="Filter">
		</form>
		</center>
	</body>
</html>