<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Recommended Films</title>
	</head>

	<style>
		h1 {
			width: 500px;
			margin: 50px auto;
		}
		.button {
			position: relative;
			padding: 6px 15px;
			left: -8px;
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
		<font color="#3498DB"><center><h1>Recommended Films</h1></center></font>
		<?php
		
		$conn;
		include 'dbConnect.php';
		
		$userID = $_GET["ID"]; // This determines which user to show info for
		
		// **** User information **** //
		$sql = "SELECT * 
				FROM users u
				WHERE u.ID = ".$userID;
		$result = $conn->query($sql);
		if ($result == NULL) {
			die("Failed");
		}
		
		// Basic user info
		$row = $result->fetch_assoc();
		echo "<b>Name: </b>";
		echo "<a href=\"userPage.php?ID=".$userID."\">";
		echo $row["username"]; 
		echo "</a><br>";
		
		recommended();
		$conn-> close();
		
		// Prints recommended
		function recommended() {
			global $userID, $conn;
			
			$sql = "SELECT * 
			        FROM recommended r, films f
					WHERE f.ID = r.filmID
					      AND r.userID = ".$userID;
			
			$result = $conn->query($sql);
			if ($result == NULL) {
				die("Failed");
			}
			
			// Print out watched
			if($result->num_rows > 0){
				echo "<br><b>Recommended:</b><br>";
				while($row = $result->fetch_assoc()){
					echo "<a href=\"filmPage.php?ID=".$row["filmID"]."\">";
					echo $row["name"]."</a>";
					
					if (isset($_SESSION['user_id']) And ($_SESSION['user_id'] == $userID)) {
						
						?>
						<form action = "remove.php" method = "GET">
						<input type="hidden" name = "filmID" value = "<?php echo $row["filmID"]; ?>">
						<input type="hidden" name = "userID" value = "<?php echo $userID; ?>">	
						<input type="submit" class="button" name="submit" value="Remove"><br><br>
						</form>
						<?php
						
						?>
						<form action = "watched.php" method = "GET">
						<input type="hidden" name = "filmID" value = "<?php echo $row["filmID"]; ?>">
						<input type="hidden" name = "userID" value = "<?php echo $userID; ?>">	
						<input type="submit" class="button" name="submit" value="Watched"><br><br>
						</form>
						<?php
					}
					echo "<br>";
				}
			}
		}
		
		?>
	</body>
</html>