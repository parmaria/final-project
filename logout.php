<?php  
session_start(); 

// If no session variable exists, redirect the user:
if (!isset($_SESSION['id'])) {

	require_once ('includes/functions.php');
	$url = absolute_url();
	header("Location: $url");
	exit();

} else { // Cancel the session.

	$_SESSION = array(); // Clear the variables.
	session_destroy(); // Destroy the session itself.
}

// Set the page title and include the HTML header:
$page_title = 'Logged Out!';
include ('includes/header.php');

// Print a customized message:
echo "<div class='loginout'><h1>Έχετε αποσυνδεθεί επιτυχώς!</h1>

<p class='missyou'>Mary's shop will miss you!</p>
<p class='missyou'>See you soon!</p></div>";

include ('includes/footer.html');
?>
