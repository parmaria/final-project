<?php 

//ΝΑ ΔΙΑΒΑΣΩ ΤΙ ΚΑΝΕΙ
function absolute_url ($page = 'index.php') {
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	$url = rtrim($url, '/\\');
	$url .= '/' . $page;
	return $url; //http://www.example.com/
}

function redirectFunction($uri){
	$case = strrpos($uri, '/', -1)+1;
	$_SESSION['url'] = substr($uri, $case);
}

function check_login($dbc, $email = '', $pass = '') {
  $errors = null; //ΕΔΩΩΩΩΩΩΩΩΩΩΩΩΩΩΩΩΩΩΩ      ΔΗΜΙΟΥΡΓΩ ΤΟΝ ΠΙΝΑΚΑ ΛΑΘΩΝ
	$e = mysqli_real_escape_string($dbc, $email);
	$p = mysqli_real_escape_string($dbc, trim($pass));


  //ΕΛΕΓΧΩ ΑΝ ΥΠΑΡΧΕΙ ΑΥΤΟΣ ΠΟΥ ΚΑΝΕΙ LOG IN ΣΤΗ ΒΑΣΗ - ΕΠΙΣΤΡΕΦΩ ΛΑΘΗ
	$q = "SELECT id, name FROM users WHERE (email='$e' AND pass=SHA1('$p'))";		

	$r = @mysqli_query ($dbc, $q); // Run the query.
	if (mysqli_num_rows($r) == 1) {
		$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
		return array(true, $row);		
	}else { 
		$errors= 'Το mail σας δεν ταιριάζει με τον κωδικό σας ή δεν έχετε κάνει εγγραφή.<a href="register.php">ε';
		return array(false, $errors);
	}
} 


//ΕΜΦΑΝΙΖΩ ΛΑΘΗ
function printerrors($errors){
  if (!empty($errors)) {
    echo '<h1>Πρόβλημα σύνδεσης!</h1><ul>';
    foreach ($errors as $msg) {
      echo "<li> $msg </li>";
    }
    echo '</ul>
    <p>Συμπληρώστε ξανά τα στοιχεία σας.</p>';
  }

}

?>
