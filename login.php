<?php
  $page_title = "Log in";
  include ('includes/header.php');
  require ('includes/functions.php');

  printerrors(isset($errors));
 
?>
<div  class="logsignform">
  <h1>Σύνδεση</h1>
  <form action="login.php" method="post">
    <p>Email: <input type="email" required name="email" maxlength="50" /> </p>
    <p>Κωδικός: <input type="password" required name="pass" size="20" maxlength="20" /></p>
    <p><input class="call-to-enter" type="submit" name="submit" value="Σύνδεση" /></p>
    <input type="hidden" name="submitted" value="TRUE" />
  </form>
</div>

<?php
//ΟΤΑΝ ΠΑΤΑΩ SUBMIT
  if (isset($_POST['submitted'])) {
    require_once ('mysqli_connent.php');
    //επειδη ενα function επιστρεφει 2 πραγματα τα βαζω σε πινακα με το list
    //επιστρεφει απο την βάση 2 πραγματα, ενα true αν ολα οκ και ενα πινακα με id και όνομα αφου πρωτα ελεγξει αν συμπληρωθηκαν
    list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);
      if ($check) { 
        session_start(); //γγγγγγκκκκκκρρρρρρρρρρρρρρ
        //πεταω μεσα στο σεσιον οτι δεδομενα χρειάζομαι μεχρι να κλεισει ο χρηστης τον browser. ενας πινακας ειναι μονοοοο


        $_SESSION['id'] = $data['id'];
        $_SESSION['name'] = $data['name'];
        // $_SESSION['prod_id'] = array();
        // $_SESSION['prod_name'] = array();
        // $_SESSION['prod_price'] = array();
        // $_SESSION['quantity'] = array();



        // Redirect: wtf????????????
        $url = absolute_url ('allreadyin.php');
        header("Location: $url");
        exit();  
      } 
      else {
        echo '<h3>'.$data.'</h3>';
      }

      }
      //κλεινω κληση σε βαση
    mysqli_close($dbc);
  

  include ('includes/footer.html');
?>