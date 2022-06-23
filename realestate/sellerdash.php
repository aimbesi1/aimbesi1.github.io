<?php 
	include("common.php");
	session_start();
	checkLogin();
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="wishlist.css">
		<meta charset="utf-8">
		<title>Registered Properties</title>
	</head>
	<body>
	<center><a href="addProperty.php"><button class="add-property">Add a new property</button></a><center><br>
	<center><a href="index.php"><button class="add-property">Go back to main menu</button></a><center><br>
	<div class="properties-list">
		<?php
			$conn = sql_connect();
			createTables($conn);
			$sql = "SELECT * FROM properties WHERE OwnerID = ".$_SESSION['userID']."";
			$result = $conn->query($sql);
			if($result->num_rows > 0) {
				

				// Begin modified code from https://tryphp.w3schools.com/showphpfile.php?filename=demo_db_select_oo
				while ($row = $result->fetch_assoc()) {
					echo "<div class='property'>";
					echo "<img class='property-img' src='".$row["image"]."'>";
					echo "<table><tr><th>Location</th>
						<th>Price</th>
						<th>Floor Plan</th>
						<th>Age</th>
						<th>Bedrooms</th>
						<th>Facilities</th>
						<th>Garden?</th>
						<th>Parking</th>
						<th>Proximity</th>
						<th>Tax</th></tr>";
					echo "<tr><td>".$row["location"]."</td>
						<td>".$row["price"]."</td>
						<td>".$row["floorplan"]."</td>
						<td>".$row["age"]."</td>
						<td>".$row["bedrooms"]."</td>
						<td>".$row["facilities"]."</td>
						<td>".$row["garden"]."</td>
						<td>".$row["parking"]."</td>
						<td>".$row["proximity"]."</td>
						<td>".$row["tax"]."</td></tr><br>";
					echo "</table>"; 
					
					echo "</div>";
				}
				// End modified code from https://tryphp.w3schools.com/showphpfile.php?filename=demo_db_select_oo
				 
				 
			}
			else {
				echo 'No properties registered! Add your first one by clicking the +';
			}
			
			$conn->close();
		?>
	</div>
	</body>
</html>