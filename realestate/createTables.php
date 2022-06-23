<?php

$host = "localhost";
$user = "aimbesi1";
$pass = "aimbesi1";
$dbname = "aimbesi1";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
	echo "Could not connect to server\n";
	die("Connection failed: " . $conn->connect_error);
}

// Users table
$sql = "CREATE TABLE users (
	ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	firstname VARCHAR(30) NOT NULL, 
	lastname VARCHAR(30) NOT NULL,
	email VARCHAR(50),
	username VARCHAR(20),
	pass VARCHAR(40) NOT NULL
	)";
$conn->query($sql);

if ($conn->query($sql) === TRUE) {
	echo "Table users created successfully";
} else {
	echo "Error creating table: " . $conn->error;
}

// Properties table
$sql = "CREATE TABLE properties (
	OwnerID INT(6),
	PropertyID INT(6) AUTO_INCREMENT PRIMARY KEY,
	image VARCHAR(100),
	location VARCHAR(50),
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
$conn->query($sql);

if ($conn->query($sql) === TRUE) {
	echo "Table properties created successfully";
} else {
	echo "Error creating table: " . $conn->error;
}

// Properties table
$sql = "CREATE TABLE wishlist (
	ListID INT(6),
	PropertyID INT(6)
	)";
$conn->query($sql);

if ($conn->query($sql) === TRUE) {
	echo "Table wishlist created successfully";
} else {
	echo "Error creating table: " . $conn->error;
}

$conn->close();
?>  