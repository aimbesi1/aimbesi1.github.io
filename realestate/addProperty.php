<?php 
	include("common.php");
	session_start();
	checkLogin();
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="table.css">
		<meta charset="utf-8">
		<title>Add a Property</title>
	</head>
	<body>
	<h1>
       ADD A PROPERTY
    </h1>

	<!-- Begin code from https://www.w3schools.com/php/php_file_upload.asp -->
	<form action="addPropertyToDB.php" method="post" enctype="multipart/form-data">
		 <p> Select image to upload:
		  <input type="file" name="fileToUpload" id="fileToUpload">
		 </p>
	  
		 <br>

<label> Location:</label> <input  type="text" name="location" placeholder="Type your location here" required><br>
<label> Price (dollar):</label> <input type="number" name="price" id="price" min="1" placeholder = "Type a number" required><br>
<label>Floor plan:</label> <br>
<textarea name="floorplan" placeholder="Describe your floor plan here" rows="4" cols="50" maxlength="255" required></textarea><br>
<label> Age (years): </label><input type="number" name="age" id="age" min="1" placeholder = "Type a number" required>  <br>
<label> Number of bedrooms:</label> <input type="number" name="bedrooms" id="bedrooms" min="1" placeholder = "Type a number" required> <br>
<label>Comment for Additional facilities: </label><br>
  <textarea name="facilities" placeholder="Additional Facilities" rows="4" cols="50" maxlength="255" required></textarea><br>
  <label for="garden">Garden available (check if YES) :</label> 
<input type="checkbox" name="garden" id="garden" value="Garden">
<br>
<label>Other requirements: </label> <br>
  <textarea name="parking" placeholder="Parking Availability" rows="4" cols="50" maxlength="255" required></textarea><br>
  <textarea name="proximity" placeholder="Proximity to main roads & facilities" rows="4" cols="50" maxlength="255" required></textarea><br><br>
 <center><input class = "buttons" type="submit" value="Submit" name="submit"></center> 
</form>
</body>
</html>