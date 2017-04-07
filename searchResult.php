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
			include 'dbConnect.php';
			include 'searchByName.php';
			echo "<br><br><br><br>";
			
			$search = $_GET["search"]; // This determines which studio to show info for
			
			films();
			persons();
			studios();
			$conn-> close();
			
		// Prints found films
		function films() {
			global $search, $conn;
			
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
				echo "<br>Films:<br>";
				while($row = $result->fetch_assoc()){
					
					echo "<a href=\"filmPage.php?ID=".$row["ID"]."\">";		
					echo $row["name"]." (".$row["year"].")</a><br>";
				}
			}
		}
		
		// Prints found persons
		function persons() {
			global $search, $conn;
			
			$sql = "SELECT *
			        FROM persons p
			        WHERE p.name LIKE '%".$search."%'
					ORDER BY p.name";
					
					
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Prints out films
			if($result->num_rows > 0){
				echo "<br>People:<br>";
				while($row = $result->fetch_assoc()){
					
					echo "<a href=\"personPage.php?ID=".$row["ID"]."\">";		
					echo $row["name"]."</a><br>";
				}
			}
		}
		
		// Prints found studios
		function studios() {
			global $search, $conn;
			
			$sql = "SELECT *
			        FROM studios s
			        WHERE s.name LIKE '%".$search."%'
					ORDER BY s.name";
					
					
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Prints out films
			if($result->num_rows > 0){
				echo "<br>Studios:<br>";
				while($row = $result->fetch_assoc()){
					
					echo "<a href=\"studioPage.php?ID=".$row["ID"]."\">";		
					echo $row["name"]."</a><br>";
				}
			}
		}
		
		?>
	</body>
</html>