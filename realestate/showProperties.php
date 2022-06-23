<?php 
	// Code modified from https://www.w3schools.com/js/js_ajax_database.asp
	include("common.php");
	session_start();
	checkLogin();
	
	$conn = sql_connect();
	createTables($conn);
	$query_string = explode(" ", $_GET['q']);

	$sql = "SELECT *
	FROM properties WHERE ";
	
	function addClause($column, $query_string) {
		foreach($query_string as $value) {
			$value = trim($value);
			$value = strtolower($value);
			if (strlen($value) > 0) {
				$str .= "LOWER(".$column.") LIKE '%".$value."%' ";
				if ($value != trim(strtolower($query_string[count($query_string) - 1]))) {
					$str .= "OR ";
				}
			}
		}
		return $str;
	}
	
	$sql .= addClause("location", $query_string) . "OR ";
	$sql .= addClause("price", $query_string) . "OR ";
	$sql .= addClause("floorplan", $query_string) . "OR ";
	$sql .= addClause("age", $query_string) . "OR ";
	$sql .= addClause("bedrooms", $query_string) . "OR ";
	$sql .= addClause("facilities", $query_string) . "OR ";
	$sql .= addClause("parking", $query_string) . "OR ";
	$sql .= addClause("proximity", $query_string);
	
	//echo $sql;
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
			// Show wishlist button
			$sql2 = "SELECT wishlist.ListID FROM wishlist INNER JOIN properties 
				ON properties.PropertyID = wishlist.PropertyID
				WHERE wishlist.ListID = ".$_SESSION["userID"]." 
				AND wishlist.PropertyID =".$row["PropertyID"]." ";
			$wishquery = $conn->query($sql2);
			if($wishquery->num_rows > 0) {
				echo "<p> Already added to wish list </p>";
			}
			else {
				echo "<button class='wish-button' onclick='addToWishList(".$row["PropertyID"].")'>Add to Wish List</button>";
			}
			
			echo "</div>";
		}
		// End modified code from https://tryphp.w3schools.com/showphpfile.php?filename=demo_db_select_oo
		 
		 
	}
	else {
		echo 'No properties found. Too bad!';
	}
	
	
	
	
	
	
	
	$conn->close();
?>