<?php
session_start();

require_once 'includes/auth.php';
require_once 'includes/login.php';
require_once 'includes/functions.php';

$student_id = $_SESSION['student_id'];

if (isset($_POST['submit'])) { 
	if ((empty($_POST['start_date'])) || (empty($_POST['end_date'])) ) {
		$message = '<p class="error">Please fill out all of the required (*) form fields!</p>';
	} else {
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$availability_details = sanitizeMySQL($conn, $_POST['availability_details']);
		$start_date = sanitizeMySQL($conn, $_POST['start_date']);
		$end_date = sanitizeMySQL($conn, $_POST['end_date']);
		$query = "INSERT INTO availability 
		(student_id, availability_details, start_date, end_date) 
		VALUES ($student_id, \"$availability_details\", \"$start_date\", \"$end_date\")";
		$result = $conn->query($query);
		if (!$result) {
			die ("Database access failed: " . $conn->error);
		} else {
			$message = "<p class=\"message\">Thank you for providing your availability details! <a href=\"pmp_index.php\">Return to skill list</a></p>";
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
		<legend>Please submit your availability information.<br>You must fill out all * fields.</legend><br>
		<label for="start_date">*First Date Available:</label>
		<input type="date" name="start_date"><br><br> 
		<label for="end_date">*Last Date Available:</label>
		<input type="date" name="end_date"><br><br> 
		<label for="availability_details">Days and Times Available:</label>
		<input type="text" name="availability_details"><br><br> 
		<input type="submit" name="submit">
		<?php echo "  <a href=\"pmp_mentormenu.php\">Go back</a>" ?><br><br>
	</fieldset>
</form>
<?php include_once 'includes/footer.php'; ?>