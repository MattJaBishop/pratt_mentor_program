<?php
session_start();
require_once 'includes/auth.php';

include_once 'includes/header.php';
require_once 'includes/login.php';
require_once 'includes/functions.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_GET['student_id'])) {
	$student_id = sanitizeMySQL($conn, $_GET['student_id']);
	$query = "SELECT * FROM availability NATURAL JOIN student_enrollment NATURAL JOIN student WHERE student_id=".$student_id;
	$result = $conn->query($query);
	if (!$result) die ("Invalid mentor id.");
	$rows = $result->num_rows;
	if ($rows == 0) {
		echo "No mentor availability and enrollment information found with an id of $student_id.<br>";
	} else {
		while ($row = $result->fetch_assoc()) {
			echo '<h1 style="text-align: center;">Mentor Details</h1>';
			echo '<h4>Mentor period:</h4>';
			echo '<p>'.$row["student_first_name"]." ".$row["student_last_name"]." is available from ".$row["start_date"]." to ".$row["end_date"].".".'</p>';
			echo '<h4>Days and times available:</h4>';
			echo '<p>'.$row["availability_details"].".".'</p>';
			echo '<h4>Enrollment information:</h4>';
			echo '<p>'.$row["student_first_name"]." ".$row["student_last_name"]." is a ".$row["degree_level"]." student in the ".$row["program_enrollment"].
			" program at the ".$row["main_campus"]." campus and expects to graduate on ".$row["graduation_date"].".".'</p>';
			echo '<p>'."Advanced certificate: ".$row["advanced_certificate"].".".'</p>';
			echo "<br>If you're interested in contacting this mentor, you can email ".$row["student_first_name"]." ".$row["student_last_name"]." at "."<a href=\"mailto:".$row["username"]."\">".$row["username"]."</a>.";			
		}
	}
	echo "<p><a href=\"pmp_index.php\">Return to skill list</a></p>";
} else {
	echo "No mentor information found";
}

include_once 'includes/footer.php';
?>
