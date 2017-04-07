<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Search Result</title>
	</head>
	
	<body>
		<?php
		
			/*
			Code to open page will look something like this:
			
			<form action="searchResult.php" method="get">
				<input type="submit" class="button" name="search" value="some string">
			</form>
			
			can also be accessed directly with .../searchResult.php?search=some string
			*/
	
			$conn;
			$flag = false;
			include 'dbConnect.php';
			include 'searchByName.php';
			echo "<br><br><br>";
			
			$search = $_GET["search"]; // This determines which studio to show info for
			
			echo "<center><b>Search results:</b></center><br>";
			films();
			persons();
			studios();
			
			// Prints message if the user search is not in the database
			if ($flag != true) {
				echo "<center>The item you searched for does not exist in the database.</center>";
			}
			
			$conn-> close();
			
		// Prints found films
		function films() {
			global $search, $conn, $flag;
			
			$sql = "SELECT *
			        FROM films f
			        WHERE f.name LIKE '%".$search."%'
					ORDER BY f.year";
					
					
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Prints out films
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					
					echo "<a href=\"filmPage.php?ID=".$row["ID"]."\">";
					echo "<center>".$row["name"]." (".$row["year"].")</center>";
					
					$flag = true;
				}
				echo "<br>";
			}
		}
		
		// Prints found persons
		function persons() {
			global $search, $conn, $flag;
			
			$sql = "SELECT *
			        FROM persons p
			        WHERE p.name LIKE '%".$search."%'
					ORDER BY p.name";
					
					
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Prints out people
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					
					echo "<a href=\"personPage.php?ID=".$row["ID"]."\">";
					echo "<center>".$row["name"]."</center>";
					
					$flag = true;
				}
				echo "<br>";
			}
		}
		
		// Prints found studios
		function studios() {
			global $search, $conn, $flag;
			
			$sql = "SELECT *
			        FROM studios s
			        WHERE s.name LIKE '%".$search."%'
					ORDER BY s.name";
					
					
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Prints out studios
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					
					echo "<a href=\"studioPage.php?ID=".$row["ID"]."\">";
					echo "<center>".$row["name"]."</center>";
					
					$flag = true;
				}
				echo "<br>";
			}
		}
		
		?>
	</body>
</html>