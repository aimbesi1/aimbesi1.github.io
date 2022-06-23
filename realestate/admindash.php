<?php 
	session_start();
	include("common.php");
	session_start();
	checkLogin();
	
	$conn = sql_connect();
	createTables($conn);
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<meta charset="utf-8">
		<title>Admin Info</title>
	</head>
	<body>
	<center>
		<div>
			<h1>TOP SECRET ADMIN ZONE</h1>
			<img src="uploads/butler.png" width="200px" height="200px" style="border: 3px solid black">
			<h2>Welcome Home Master~~~</h2>
			<a class = "buttons" href="index.php">Go back to main menu</a><br>
			<div class="stats" id="top-seller">
				<table class="stats-table">
				<caption>Users in order of most properties listed</caption>
				<tr>
					<th>User</th><th>Email</th><th>Properties listed</th>
				</tr>
				<?php
					$sql = "SELECT users.username, users.email, COUNT(properties.PropertyID) AS Frequency
							FROM users INNER JOIN properties ON users.ID = properties.OwnerID
							GROUP BY users.username ORDER BY Frequency DESC";
					$topseller = $conn->query($sql);
					while ($row = $topseller->fetch_assoc()) {
						echo "<tr><td>".$row["username"]."</td>
							<td>".$row["email"]."</td>
							<td>".$row["Frequency"]."</td></tr><br>";
					}
				?>
				</table>
				
			</div>
			
			<div class="stats" id="top-wishlisted">
				<table class="stats-table">
				<caption>Most wishlisted properties</caption>
				<tr>
					<th>Property ID</th><th>Location</th><th>Times wishlisted</th>
				</tr>
				<?php
					$sql = "SELECT properties.PropertyID, properties.location, COUNT(properties.PropertyID) AS WishFrequency
						FROM properties INNER JOIN wishlist ON properties.PropertyID = wishlist.PropertyID
						GROUP BY properties.PropertyID ORDER BY WishFrequency DESC";
					$wishlisted = $conn->query($sql);
					
					while ($row = $wishlisted->fetch_assoc()) {
						echo "<tr><td>".$row["PropertyID"]."</td>
							<td>".$row["location"]."</td>
							<td>".$row["WishFrequency"]."</td></tr><br>";
					}
				?>
				</table>
			</div>
			
			<div class="stats" id="most-expensive">
				<table class="stats-table">
				<caption>Most expensive properties (Uh Oh)</caption>
				<tr>
					<th>Property ID</th><th>Location</th><th>Price Point</th>
				</tr>
				<?php
					$sql = "SELECT * FROM properties ORDER BY price DESC";
					$expensive = $conn->query($sql);
					
					while ($row = $expensive->fetch_assoc()) {
						echo "<tr><td>".$row["PropertyID"]."</td>
							<td>".$row["location"]."</td>
							<td>".$row["price"]."</td></tr><br>";
					}
				?>
				</table>
			</div>
			
			
		</div>
	</center>
	</body>
</html>
<?php

$conn->close();
?>