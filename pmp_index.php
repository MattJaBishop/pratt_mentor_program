<?php
session_start();

require_once 'includes/auth.php';
include_once 'includes/header.php';
require_once 'includes/login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query = "SELECT * FROM student NATURAL JOIN skill ORDER BY student_last_name ASC, student_first_name ASC, skill_name ASC, skill_type ASC";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;

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

echo '<p>'."Please click on a Mentor ID to view the mentor's availability and enrollment details.".'</p>';
echo "<a href=\"pmp_mentormenu.php\">Become a mentor!</a><br>";
echo "<br><a href=\"pmp_search.php\">Search by skill type</a>";

include_once 'includes/footer.php';
?>
