<?php
session_start();

require_once 'includes/auth.php';
require_once 'includes/login.php';
require_once 'includes/functions.php';
?>

<?php 
include_once 'includes/header.php'; 
if (isset($message)) echo $message;
?>

<h3 style="text-align: center;">Become a Mentor!</h3>
<h4 style="text-align: center;">Please choose an option below to enter you information.</h4>

<fieldset>
<form>
<input type="button" value="Add a skill" onclick="window.location.href='pmp_addskill.php'" />
<br>
<br>
<input type="button" value="Add student enrollment information" onclick="window.location.href='pmp_addenrollment.php'" />
<br>
<br>
<input type="button" value="Add availability details" onclick="window.location.href='pmp_addavailability.php'" />
</form>
</fieldset>

<?php include_once 'includes/footer.php'; ?>