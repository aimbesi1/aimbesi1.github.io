<?php 
	include("common.php");
	session_start();
	checkLogin();
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="wishlist.css">
		<meta charset="utf-8">
		<title>Browse Properties</title>
		<script>
		// Begin modified code from https://www.w3schools.com/js/js_ajax_database.asp
		function showProperties(str) {
		  if (str == "") {
			document.getElementById("properties").innerHTML = "";
			return;
		  }
		  const xhttp = new XMLHttpRequest();
		  xhttp.onload = function() {
			document.getElementById("properties").innerHTML = this.responseText;
		  }
		  xhttp.open("GET", "showProperties.php?q="+str);
		  xhttp.send();
		  
		  const buttons = document.getElementsByClassName("wish-button");
		  for (var i = 0; i < buttons.length; i++) {
			  buttons[i].setAtribute('onmousedown', 'function() { buttons[i].innerHTML = "Added"; alert("Added new property to wish list"); }');
		  }
		}
		// End modified code from https://www.w3schools.com/js/js_ajax_database.asp
		
		function addToWishList(ID) {
			const xhttp = new XMLHttpRequest();
			xhttp.open("GET", "addToWishList.php?q="+ID);
			xhttp.send();
		}
		
		</script>
	</head>
	<body>
	<center>
	<form>
	 Search for properties: <input type="text" id="search" placeholder = "What are you looking for?" onkeyup="showProperties(this.value)">
	</form>
	<a href="wishlist.php"><button>Go to wishlist</button></a>
	<a href="index.php"><button>Go back to main menu</button></a><br>
	</center>

	
	<div id="properties"></div>
	</body>
</html>