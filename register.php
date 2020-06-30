<?php 

$page_title = 'Register';
include ('includes/header.php');

// Check if the form has been submitted:
if (isset($_POST['submitted'])) {
	require_once ('mysqli_connent.php');

		$fn = mysqli_real_escape_string($dbc, trim($_POST['name']));
		$ln = mysqli_real_escape_string($dbc, trim($_POST['surname']));
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));

		if ($_POST['pass1'] == $_POST['pass2']) {
			$p = mysqli_real_escape_string($dbc, $_POST['pass1']);
			$errors=false;

		} else {
			$errors = 'Οι κωδικοί σας δεν ταιριάζουν.';
		}

	
	if (!$errors) { 
	
		$q = "INSERT INTO users (name, surname, email, pass, registration_date) VALUES ('$fn', '$ln','$e', SHA1('$p'), NOW() )";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { 
			echo '<h1>Ευχαριστούμε!</h1>
		<p>Τώρα είστε εγγεγραμένος. Παρακλώ συνδεθείτε!</p><p><br /></p>';		
		}
		 else { 
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';				
		} 	
		mysqli_close($dbc); // Close the database connection.
		// Include the footer and quit the script:
		include ('includes/footer.html'); 
		exit();		
	} 
	else {
	
		echo '<h1>Error!</h1>';
		echo $errors;
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	}
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>







<h1 id="cracc">Δημιουργία Λογαριασμού</h1>
<form class='logsignform' action="register.php" method="post">
	<p>Όνομα: <input type="text" name="name" required size="15" maxlength="20" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" /></p>
	<p>Επίθετο: <input type="text" name="surname" required size="15" maxlength="40" value="<?php if (isset($_POST['surname'])) echo $_POST['surname']; ?>" /></p>
	<p>Email: <input type="email" name="email" required size="20" maxlength="80" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> </p>
	<p>Κωδικός: <input type="password" name="pass1" required size="10" maxlength="20" /></p>
	<p>Επαλήθευση κωδικού: <input type="password" name="pass2" required size="10" maxlength="20" /></p>
	<p><input class="call-to-enter" type="submit" name="submit" value="Εγγραφή" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>
<?php
include ('includes/footer.html');


?>