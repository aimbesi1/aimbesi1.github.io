<?php 
	// echo "Begin PHP";
	include("common.php");
	// echo "Common PHP";
	session_start();
	// echo "Enter CheckLogin";
	checkLogin();
	// echo "Exit CheckLogin";
?>

<?php
// Get the data from addProperty.php
// echo "Before isset";
if (!isset($_POST['location'], $_POST['price'], $_POST['floorplan'], $_POST['age'], $_POST['bedrooms'], $_POST['facilities'], $_POST['parking'], $_POST['proximity'])) {
		echo 'Please fill the form completely';
		exit;
}
$garden = 0;
if (!isset($_POST["garden"]))
	$garden = 0;
else if ($_POST["garden"] == true)
	$garden = 0;
// echo "After isset";
$owner = $_SESSION["userID"];
$location = $_POST["location"];
$price = $_POST["price"];
$floorplan = $_POST["floorplan"];
$age = $_POST["age"];
$bedrooms = $_POST["bedrooms"];
$facilities = $_POST["facilities"];
$parking = $_POST["parking"];
$proximity = $_POST["proximity"];
$tax = $price * 0.07;

$image = null;

// Begin modified code from https://www.w3schools.com/php/php_file_upload.asp

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$fileExists = false;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    //echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    //echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  //echo "Sorry, file already exists.";
  $uploadOk = 0;
  $fileExists = true;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 9000000) {
  //echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  //echo "Sorry, your file was not uploaded.";
  $image = "uploads/placeholder_icon.png";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	$image = $target_file;
    //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    //echo "Sorry, there was an error uploading your file.";
	//echo $target_file;
	$image = "uploads/placeholder_icon.png";
  }
}
if ($fileExists == true) {
	$image = $target_file;
}

// End modified code from https://www.w3schools.com/php/php_file_upload.asp

// Insert the data
$conn = sql_connect();

$sql = "INSERT INTO properties (OwnerID, image, location, price, floorplan, age, bedrooms, facilities, garden, parking, proximity, tax) 
	VALUES ('".$owner."', '".$image."', '".$location."', '".$price."', '".$floorplan."', '".$age."', '".$bedrooms."', '".$facilities."', ".$garden.", '".$parking."', '".$proximity."', '".$tax."')";
echo $floorplan;
if ($conn->query($sql) === TRUE) {
    //echo "New data successfully saved";
} else {
    //echo "Error inserting data: " . $conn->error;
}

$conn->close();
?>
<!doctype html>
<!-- Tony Imbesi -->
<html>

<head lang="en">
<link rel="stylesheet" href="table.css">
	<meta charset="UTF-8">
	<title>Adding Property to DB</title>
</head>

<body>
	<div>
	<?php
	if ($uploadOk || $fileExists) {
		echo "<p> Image uploaded successfully! </p>";
	}
	else {
		echo "<p> Image was NOT uploaded successfully! </p>";
	}
	echo "<p> Property uploaded! Go back to seller dashboard to see it </p>"; 
	?>
	<!-- Redirect the user to show the data -->
	<?php echo "<center><img src='".$image."'></center>"; ?>
	<a href="sellerdash.php"><input class = "buttons" type="button" id="btn1" value="OK"></a>
	</div>
</body>

</html>