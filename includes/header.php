<!DOCTYPE html>
<html>
<head>
<title>Pratt Mentor Program Database</title>
<link rel="stylesheet" type="text/css" href="includes/pmpstyle.css" />
</head>
<body>
<header>
<!-- Navigation bar from Bootstrap -->
<nav class="navbar navbar-dark primary-color">
<a class="navbar-brand" href="pmp_index.php">
    <img src="images/pratt_logo.jpg" height="100" class="d-inline-block align-top" alt="">
</a>
	<h1>Pratt Mentor Program Database</h1>
</nav>
	<?php
	if (isset($_SESSION['student_first_name']) && isset($_SESSION['student_last_name']) ) {
		echo "<h3>Welcome, ".$_SESSION['student_first_name']." ".$_SESSION['student_last_name'];
		echo " | <small><a href=\"pmp_signout.php\">Logout</a></small></h3><br>";
	}
	?>
</header>
<div id="body">
