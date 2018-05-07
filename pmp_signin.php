<?php
session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';

if (isset($_POST['submit'])) { 
	if ( empty($_POST['username']) || empty($_POST['password']) ) {
		$message = '<p class="error">Please fill out all of the fields!</p>';
	} else {
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$username = sanitizeMySQL($conn, $_POST['username']);
		$password = sanitizeMySQL($conn, $_POST['password']);			
		$salt1 = "jd@g*";  
		$salt2 = "og?#";  
		$password = hash('ripemd128', $salt1.$password.$salt2);
		$query  = "SELECT student_first_name, student_last_name, student_id FROM student WHERE username='$username' AND password='$password'"; 
		$result = $conn->query($query);    
		if (!$result) die($conn->error); 
		$rows = $result->num_rows;
		if ($rows==1) {
			$row = $result->fetch_assoc();
			$_SESSION['student_first_name'] = $row['student_first_name'];
			$_SESSION['student_last_name'] = $row['student_last_name'];
		#Use following variable to call user information in tables
			$_SESSION['student_id'] = $row['student_id'];
			$goto = empty($_SESSION['goto']) ? 'pmp_index.php' : $_SESSION['goto'];			
			header('Location: ' . $goto);
			exit;			
		} else {
			$message = '<p class="error">Invalid username/password combination!</p>';
		}
	}
}
?>

<?php 
include_once 'includes/header.php'; 
if (isset($message)) echo $message;
?>
<fieldset style="width:80%"><legend>Log-in</legend>
<form method="POST" action="">
Username:<br><input type="email" name="username" size="40"><br>
Password:<br><input type="password" name="password" size="40"><br>
<input type="submit" name="submit" value="Log-In">
<?php echo "  <a href=\"pmp_signup.php\">Sign up</a>" ?>
</form>
</fieldset>
<?php include_once 'includes/footer.php'; ?>