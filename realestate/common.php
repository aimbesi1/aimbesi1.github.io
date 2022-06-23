<?php
// Set up an SQL connection with one function
function sql_connect() {
	$host = "localhost";
	$user = "aimbesi1";
	$pass = "aimbesi1";
	$dbname = "aimbesi1";

	$conn = new mysqli($host, $user, $pass, $dbname);

	if ($conn->connect_error) {
		echo "Could not connect to server\n";
		die("Connection failed: " . $conn->connect_error);
	}
	else {
		return $conn;
	}
}

// Create the necessary tables after establishing a server connection.
function createTables($conn) {
	// Users table
	$sql = "CREATE TABLE users (
		ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		firstname VARCHAR(30) NOT NULL, 
		lastname VARCHAR(30) NOT NULL,
		email VARCHAR(50),
		username VARCHAR(20),
		pass VARCHAR(40) NOT NULL
		)";
	// $conn->query($sql);

	if ($conn->query($sql) === TRUE) {
		//echo "Table users created successfully";
	} else {
		//echo "Error creating table: " . $conn->error;
	}

	// Properties table
	$sql = "CREATE TABLE properties (
		OwnerID INT(6),
		PropertyID INT(6) AUTO_INCREMENT PRIMARY KEY,
		image VARCHAR(100),
		location VARCHAR(255),
		price INT(10),
		floorplan VARCHAR(255),
		age INT(3),
		bedrooms INT(2),
		facilities VARCHAR(255),
		garden BOOLEAN,
		parking VARCHAR(255),
		proximity VARCHAR(255),
		tax DOUBLE(10, 2)
		)";
	// $conn->query($sql);

	if ($conn->query($sql) === TRUE) {
		//echo "Table properties created successfully";
	} else {
		//echo "Error creating table: " . $conn->error;
	}
	
	// Properties table
	$sql = "CREATE TABLE wishlist (
		ListID INT(6),
		PropertyID INT(6)
		)";
	$conn->query($sql);

	if ($conn->query($sql) === TRUE) {
		//echo "Table wishlist created successfully";
	} else {
		//echo "Error creating table: " . $conn->error;
	}
}

// Redirect user to the registration page if they are not logged in.
function checkLogin() {
	if (isset($_SESSION["loggedIn"])) {
		if (!$_SESSION["loggedIn"]) {
			header("Location: register.php");
		}
	}
	else {
		header("Location: register.php");
	}
}
// Show all the properties registered to the user.
// function showRegisteredProperties() {
	// $conn = sql_connect();
	// createTables($conn);
	// $sql = "SELECT * FROM properties WHERE OwnerID = ".$_SESSION['userID']."";
	// $result = $conn->query($sql);
	// if($result->num_rows > 0) {
		// echo "<table><tr><th>Location</th>
		// <tr><th>Price</th>
		// <tr><th>Floor Plan</th>
		// <tr><th>Age</th>
		// <tr><th>Bedrooms</th>
		// <tr><th>Facilities</th>
		// <tr><th>Garden?</th>
		// <tr><th>Parking</th>
		// <tr><th>Proximity</th>
		// <tr><th>Tax</th></tr>";

		 // Run a loop and display the records on screen dynamically
		// lets say the above query returned 20 rows
		// Now display the table on screen with 20 records
		// Begin modified code from https://tryphp.w3schools.com/showphpfile.php?filename=demo_db_select_oo
		// while ($row = $result->fetch_assoc()) {
			// echo "<tr><td>".$row["location"]."</td>
				// <td>".$row["price"]."</td>
				// <td>".$row["floorplans"]."</td>
				// <td>".$row["age"]."</td>
				// <td>".$row["bedrooms"]."</td>
				// <td>".$row["facilities"]."</td>
				// <td>".$row["garden"]."</td>
				// <td>".$row["parking"]."</td>
				// <td>".$row["proximity"]."</td>
				// <td>".$row["tax"]."</td></tr>";
		// }
		// End modified code from https://tryphp.w3schools.com/showphpfile.php?filename=demo_db_select_oo

		 // echo "</table>";
	// } 
	// else {
		// echo 'No properties registered! Add your first one by clicking the +';
	// }
// }
?>