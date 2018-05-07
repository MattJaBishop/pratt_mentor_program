<?php
session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';

if (isset($_POST['submit'])) { 
	if ((strpos(($_POST['username']), '@pratt.edu') === false) || (empty($_POST['student_first_name'])) || (empty($_POST['student_last_name'])) || (empty($_POST['username'])) || (empty($_POST['password'])) ) {
		$message = '<p class="error">Please fill out all of the fields and include a valid Pratt email address!</p>';
	} else {
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$student_last_name = sanitizeMySQL($conn, $_POST['student_last_name']);
		$student_first_name = sanitizeMySQL($conn, $_POST['student_first_name']);
		$username = sanitizeMySQL($conn, $_POST['username']);
		$password = sanitizeMySQL($conn, $_POST['password']);			
		$salt1 = "jd@g*";  
		$salt2 = "og?#";  
		$password = hash('ripemd128', $salt1.$password.$salt2);
		$query  = "INSERT INTO student VALUES(NULL, \"$student_last_name\", \"$student_first_name\", \"$username\", \"$password\")"; 
		$result = $conn->query($query);    
		if (!$result) {
			die ("Database access failed: " . $conn->error);	
		} else {
			$message = "<p class=\"message\">Thank you $student_first_name for signing up to use this site! Please return to the homepage to log-in. <a href=\"pmp_signin.php\">Return to homepage</a></p>";
		}
	}
}
?>

<?php 
include_once 'includes/header.php'; 
if (isset($message)) echo $message;
?>

<form method="post" action="">
	<fieldset>
		<legend>Create a Log-In</legend>
		<label for="student_first_name">First Name:</label>
		<input type="text" name="student_first_name"><br> 
		<label for="student_last_name">Last Name:</label>
		<input type="text" name="student_last_name"><br> 
		<label for="username">Username (Your Pratt Email):</label>
		<input type="email" name="username"><br> 
		<label for="password">Password:</label>
		<input type="password" name="password"><br> 
		<input type="submit" name="submit">
	</fieldset>
</form>

<?php include_once 'includes/footer.php'; ?>