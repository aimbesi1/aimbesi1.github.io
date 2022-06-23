
<!DOCTYPE html>
<?php
echo "Entering PHP";
include("common.php");
session_start();
// $_SESSION['passwd'] = $_POST['passwd'];
	if (!isset($_POST['username'], $_POST['passwd'])) {
		echo 'Please fill the form to complete login';
		exit;
	}

	if (empty($_POST['username']) || empty($_POST['passwd'])) {
		echo 'Please fill all the fields';
		exit;
	}

	$conn = sql_connect();
	createTables($conn);
	$sql = "SELECT ID FROM users WHERE username = '".$_POST['username']."' and pass = '".sha1($_POST['passwd'])."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		//echo 'Successfully logged in';
		$row = $result->fetch_row();
		$_SESSION['loggedIn'] = true;
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['userID'] = $row[0];
		//echo 'ID: '.$_SESSION['userID'];
		header('Location: index.php');
		
	} else {
		header('Location: login_failed.php');
	}

	$conn->close();
?>
<html>
	<head>
		<link rel="stylesheet" href="./stylesheet.css">
		<meta charset="utf-8">
		<title>Logged In</title>
	</head>
	<body>
	<center>
		<div>
			<h1>Welcome!</h1>
			<a href="buyerdash.php">Go to buyer dashboard</a><br>
			<a href="sellerdash.php">Go to seller dashboard</a><br>
			<a href="admindash.php">Go to admin dashboard</a><br>
		</div>
	</center>
	</body>
</html>