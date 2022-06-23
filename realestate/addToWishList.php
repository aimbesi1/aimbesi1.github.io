<?php 
	// Code modified from https://www.w3schools.com/js/js_ajax_database.asp
	include("common.php");
	session_start();
	checkLogin();
	
	$conn = sql_connect();
	$ID = $_GET['q'];
	$sql = "SELECT wishlist.ListID FROM wishlist INNER JOIN properties 
				ON properties.PropertyID = wishlist.PropertyID
				WHERE wishlist.ListID = ".$_SESSION["userID"]." 
				AND wishlist.PropertyID =".$ID." ";
	$result = $conn->query($sql);
	if($result->num_rows == 0) {
		$sql = "INSERT INTO wishlist (ListID, PropertyID)
			VALUES (".$_SESSION['userID'].", ".$ID.")";
		$conn->query($sql);
	}
	
	
	
	
	$conn->close();
?>