<?php 
	include("common.php");
	session_start();
	checkLogin();
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="./stylesheet.css">
		<meta charset="utf-8">
		<title>Wish List</title>
	</head>
	<body>
	<a href="buyerdash.php"><button class="buttons">Back to buyers' dashboard</button></a>
	<div class="properties-list">
		<?php
			$conn = sql_connect();
			createTables($conn);
			$sql = "SELECT * FROM properties INNER JOIN wishlist ON properties.PropertyID = wishlist.PropertyID 
			WHERE ListID = ".$_SESSION['userID']."";
			$result = $conn->query($sql);
			if($result->num_rows > 0) {
				

				// Begin modified code from https://tryphp.w3schools.com/showphpfile.php?filename=demo_db_select_oo
				while ($row = $result->fetch_assoc()) {
					echo "<div class='property'>";
					echo "<img class='property-img' src='".$row["image"]."'>";
					echo "<table><tr><th>Location</th>
						<tr><th>Price</th>
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
						<td>".$row["floorplans"]."</td>
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
				echo 'No properties in the list';
			}
			
			$conn->close();
		?>
	</div>
	</body>
</html>