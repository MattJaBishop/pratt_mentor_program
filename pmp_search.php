<?php
session_start();

require_once 'includes/auth.php';
include_once 'includes/header.php';
require_once 'includes/login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_POST['submit'])) { 

$skill_type = $_POST['skill_type'];

	if ((empty($_POST['skill_type'])) ) {
		$message = '<p class="error">Please fill out the field!</p>';
	} else {
header("Location: pmp_searchresults.php?skill_type=".$skill_type);
		}
	}

?>

<form method="post" action="">
	<fieldset>
		<legend>Search by skill type.</legend><br>
		<label for="skill_type">Skill Type:</label> 
		<select name="skill_type"><br><br> 
		  <option value="technology">Technology</option>
		  <option value="writing">Writing</option>
		  <option value="research">Research</option>
		  <option value="design">Design</option>
		  <option value="language">Language</option>
		  <option value="other">Other</option>
		</select><br><br> 
		<input type="submit" name="submit"><br><br>
	</fieldset>
</form>

<?php
echo "<br><a href=\"pmp_mentormenu.php\">Become a mentor!</a> ";

include_once 'includes/footer.php';
?>
