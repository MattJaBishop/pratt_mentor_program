<?php
session_start();

require_once 'includes/auth.php';
require_once 'includes/login.php';
require_once 'includes/functions.php';

$student_id = $_SESSION['student_id'];

if (isset($_POST['submit'])) { 
	if (empty($_POST['main_campus'])) {
		$message = '<p class="error">Please fill out all of the required (*) form fields!</p>';
	} else {
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$main_campus = sanitizeMySQL($conn, $_POST['main_campus']);
		$program_enrollment = sanitizeMySQL($conn, $_POST['program_enrollment']);
		$advanced_certificate = sanitizeMySQL($conn, $_POST['advanced_certificate']);
		$degree_level = sanitizeMySQL($conn, $_POST['degree_level']);
		$graduation_date = sanitizeMySQL($conn, $_POST['graduation_date']);
		$query = "INSERT INTO student_enrollment 
		(student_id, main_campus, program_enrollment, advanced_certificate, degree_level, graduation_date) 
		VALUES ($student_id, \"$main_campus\", \"$program_enrollment\", \"$advanced_certificate\", \"$degree_level\", \"$graduation_date\")";
		$result = $conn->query($query);
		if (!$result) {
			die ("Database access failed: " . $conn->error);
		} else {
			$message = "<p class=\"message\">Thank you for providing your student enrollment details! <a href=\"pmp_index.php\">Return to skill list</a></p>";
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
		<legend>Please submit your enrollment information.<br>You must fill out all * fields.</legend><br>
		<label for="main_campus">*Campus Location</label> 
		<select name="main_campus"><br> 
		  <option value="Brooklyn">Brooklyn</option>
		  <option value="Manhattan">Manhattan</option>
		</select><br><br> 
		<label for="program_enrollment">Degree Name:</label>
		<input type="text" name="program_enrollment"><br><br> 
		<label for="advanced_certificate">Advanced Certificate:</label>
		<input type="text" name="advanced_certificate"><br><br> 
		<label for="degree_level">Undergraduate or Graduate:</label> 
		<select name="degree_level"><br> 
		  <option value="undergraduate">Undergraduate</option>
		  <option value="graduate">Graduate</option>
		</select><br><br> 
		<label for="graduation_date">Expected Graduation Date:</label>
		<input type="date" name="graduation_date"><br><br> 
		<input type="submit" name="submit">
		<?php echo "  <a href=\"pmp_mentormenu.php\">Go back</a>" ?><br><br>
	</fieldset>
</form>
<?php include_once 'includes/footer.php'; ?>