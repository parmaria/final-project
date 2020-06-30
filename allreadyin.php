
<?php 
session_start(); // Start the session.

// If no session value is present, redirect the user:
if (!isset($_SESSION['id'])) {
	require_once ('includes/functions.php');
	$url = absolute_url('index.php');
	header("Location: $url");
	exit();	
}

$page_title = 'Logged In!';
include ('includes/header.php');

// Print a customized message:
echo "<div class='loginout'>
<h1>Συνδεθήκατε!</h1>
<p>Καλησπέρα, {$_SESSION['name']}!</p>
<p class='missyou'>Wellcome to Mary's Shop! Have a nice shopping day!</p>
<p class='connect'>
	<a class='buttons' href='logout.php'>Αποσύνδεση</a>
</p>
</div>";

include ('includes/footer.html');
?>