<?php
session_start();

require_once 'includes/login.php';
require_once 'includes/functions.php';
?>

<?php 
include_once 'includes/header.php'; 
if (isset($message)) echo $message;
?>

<h3 style="text-align: center;">About This Site</h3>

<p>
This website was created to provided a database of volunteer student mentors at Pratt Institute.
</p>
<p>
Any students that submit information to this page should be aware that their information is made available to anyone that can access this site.
</p>
<p>
Only individuals with a Pratt email address are able to access this site.
</p>
<p>
Please use the information provided on this site responsibly. Any misuse of the information on this site will be reported to the appropriate parties at Pratt Institute and your access to the site will be revoked.
</p>
<p>
If you have any questions or concerns, please contact the site admin at <a href="mailto:mabisho26@pratt.edu">mabisho36@pratt.edu</a>.
</p>
<br>

<?php include_once 'includes/footer.php'; ?>