<?php  
  $page_title = 'View cart';
  session_start();
  include ('includes/header.php');
?>

<table>
  <tr>

    <th>ΠΡΟΙΟΝ</th>
    <th>ΤΙΜΗ</th>
    <th>ΠΟΣΟΤΗΤΑ</th>
    <th>ΑΛΛΑΓΗ</th>
  </tr>
<?php  
$total = 0;
foreach ($_SESSION['products'] as $prod => $value){

  echo "<tr>";

  ?>
  <td>
    <a href="product.php?id= <?php echo $_SESSION['products'][$prod]['id'] ?> "> <?php echo $_SESSION['products'][$prod]['name'] ?> </a>
  </td>
  <?php 
  echo "<td>".$_SESSION['products'][$prod]['price']."</td>";
  echo "<td>".$_SESSION['products'][$prod]['quantity']."</td>";
  echo "<td><button> - </button> <button> + </button> </td>";
  $total+= $_SESSION['products'][$prod]['price'] * $_SESSION['products'][$prod]['quantity'];

  echo "</tr>";
}
echo "</table>";
echo "Σύνολο:".$total." €";



?>
<?php  
 include ('includes/footer.html');
?>