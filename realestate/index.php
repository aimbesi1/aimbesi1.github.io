<?php
//echo "Entering PHP";
include("common.php");
session_start();
checkLogin();
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<meta charset="utf-8">
		<title>Logged In</title>
	</head>
	<body>
	<center>
		<div>
			<h1>WELCOME!</h1>
			<a class = "buttons" href="buyerdash.php">Go to buyer dashboard &#129304</a><br><br><br>
			<a class = "buttons" href="sellerdash.php">Go to seller dashboard &#129297</a><br><br><br>
			<a class = "buttons" href="admindash.php">Go to admin dashboard &#129488</a><br><br><br>
			<a class = "buttons" href="home.html">Log out</a><br>
		</div>
	</center>
	</body>
</html>