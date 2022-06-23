
<!DOCTYPE html>
<?php
include("common.php");
session_start();
// $_SESSION['passwd'] = $_POST['passwd'];
	if (!isset($_POST['username'], $_POST['passwd'], $_POST['email'], $_POST['fname'], $_POST['lname'])) {
		exit('Please fill the form to complete registration');
	}

	if (empty($_POST['username']) || empty($_POST['passwd']) || empty($_POST['email']) || empty($_POST['fname']) || empty($_POST['lname'])) {
		exit('Please fill all the fields');
	}
	$conn = sql_connect();
	createTables($conn);
	$stmt = $conn->prepare('SELECT ID, pass, firstname, lastname, email FROM users WHERE username = ?');
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	
	if($stmt-> num_rows > 0) {
		//echo 'User already registered';
		header('Location: login.php');
	} else {
		$stmt = $conn->prepare('INSERT INTO users (username, pass, firstname, lastname, email) VALUES (?, ?, ?, ?, ?)');
		$stmt->bind_param('sssss', $_POST['username'], sha1($_POST['passwd']), $_POST['fname'], $_POST['lname'], $_POST['email']);
		$stmt->execute();
		session_start();
		$_SESSION['loggedIn'] = true;
		$_SESSION['username'] = $_POST['username'];
		//echo 'User successfully created!';
		header('Location: login.php');
	}
	
	$conn->close();
?>
<html>
	<head>
		<link rel="stylesheet" href="./stylesheet.css">
		<meta charset="utf-8">
		<title>Register</title>
		<script type="application/javascript">
		//window.location.replace("login.php");
		</script>
	</head>
	<body>
	</body>
</html>