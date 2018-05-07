<?php
session_start();
require_once 'includes/auth.php';

include_once 'includes/header.php';
require_once 'includes/login.php';
require_once 'includes/functions.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_GET['skill_type'])) {
	$skill_type = sanitizeMySQL($conn, $_GET['skill_type']);
	$query = "SELECT * FROM student NATURAL JOIN skill WHERE skill_type='$skill_type' 
		ORDER BY student_last_name ASC, student_first_name ASC, skill_name ASC";
	$result = $conn->query($query);
	if (!$result) die ("Invalid skill type.");
	$rows = $result->num_rows;
	if ($rows == 0) {
		echo "No skill type information found.<br>";
	} else {
		echo "<table><tr> <th>Mentor ID</th><th>Skill Type</th><th>Skill Name</th><th>Mentor Name</th><th>Email</th><th>Details</th></tr>";
		while ($row = $result->fetch_assoc()) {
			echo '<tr>';
			echo "<td><a href=\"pmp_viewdetails.php?student_id=".$row["student_id"]."\">".$row["student_id"]."</a></td>";
			echo "<td>".$row["skill_type"]."</td>";
			echo "<td>".$row["skill_name"]."</td>";
			echo "<td>".$row["student_first_name"]." ".$row["student_last_name"]."</td>";
			echo "<td><a href=\"mailto:".$row["username"]."\">".$row["username"]."</a></td>";
			echo "</td><td>".$row["skill_details"]."</td>";
			echo '</tr>';
		}

		echo "</table>";

	}
} else {
	echo "No skills found";
}

echo '<p>'."Please click on a Mentor ID to view the mentor's availability and enrollment details.".'</p>';
echo "<a href=\"pmp_mentormenu.php\">Become a mentor!</a>";
echo "<p><a href=\"pmp_search.php\">Search by another skill type</a></p>";
echo "<p><a href=\"pmp_index.php\">Return to skill list</a></p>";

include_once 'includes/footer.php';
?>