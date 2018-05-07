<?php
session_start();

require_once 'includes/auth.php';
require_once 'includes/login.php';
require_once 'includes/functions.php';

$student_id = $_SESSION['student_id'];

if (isset($_POST['submit'])) { 
	if ((empty($_POST['skill_name'])) || (empty($_POST['skill_type'])) ) {
		$message = '<p class="error">Please fill out all of the required (*) form fields!</p>';
	} else {
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$skill_name = sanitizeMySQL($conn, $_POST['skill_name']);
		$skill_type = sanitizeMySQL($conn, $_POST['skill_type']);	
		$skill_details = sanitizeMySQL($conn, $_POST['skill_details']);
		$query = "INSERT INTO skill 
			(student_id, skill_name, skill_type, skill_details) 
			VALUES ($student_id, \"$skill_name\", \"$skill_type\", \"$skill_details\")";
		$result = $conn->query($query);
		if (!$result) {
			die ("Database access failed: " . $conn->error);
		} else {
			$message = "<p class=\"message\">You volunteered to mentor in $skill_name - thank you! <a href=\"pmp_index.php\">Return to skill list</a></p>";
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
		<legend>Become a Mentor!<br>You must fill out all * fields.</legend><br>
		<label for="skill_type">*Skill Type:</label> 
		<select name="skill_type"><br><br> 
		  <option value="technology">Technology</option>
		  <option value="writing">Writing</option>
		  <option value="research">Research</option>
		  <option value="design">Design</option>
		  <option value="language">Language</option>
		  <option value="other">Other</option>
		</select><br><br> 
		<label for="skill_name">*Skill Name:</label>
		<input type="text" name="skill_name"><br><br> 
		<label for="skill_details">Skill Details:</label>
		<input type="text" name="skill_details"><br><br> 
		<input type="submit" name="submit">
		<?php echo "  <a href=\"pmp_mentormenu.php\">Go back</a>" ?><br><br>
	</fieldset>
</form>
<?php include_once 'includes/footer.php'; ?>