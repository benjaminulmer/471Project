<!DOCTYPE html>

<html>
	<head>
		<title>Search By Name</title>
	</head>
	
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
		.button:hover {
			background-color: #fafafa;
			color: #207cca;
		}
		.button2:hover {
			background-color: #fafafa;
			color: #207cca;
		}
	</style>
	
	<body>
		<form action="homePage.php">
			<input type="submit" class="button2" value="Back">
		</form>
		<font color="#3498DB"><center><h1>Search By Name</h1></center></font>
		<center><form>
			<input type="text" class="search" size="30" placeholder="Search..." required>
			<input type="submit" class="button" value="Go">
		</form></center>
	</body>
</html>