<?php

  $page_title = 'Product'.$_GET["id"];
  require_once ('mysqli_connent.php');
  include ("includes/functions.php");
  
  session_start();
  include ('includes/header.php');
  


  $q='SELECT products.id,products.brand_id, products.name, products.price,products.details,photos.id, photos.url FROM products, photos WHERE (products.id = photos.product_id AND products.id = '.$_GET["id"].')';
  $r = @mysqli_query ($dbc, $q);
  $row = mysqli_fetch_array ($r, MYSQLI_ASSOC); 
  $brand = $row['brand_id']; 

?>
<!--ΤΡΊΤΟΣ ΤΡΌΠΟΣ ΕΜΦΩΛΕΥΣΗΣ PHP ΣΕ HTML ME σύντομο.. αντι για < ? php echo βαζω < ? =  -->
<div class="prod_general">
<div class="prod_container">
  <div class="prod_left">
    <img  class="prod_photo" src="images/<?php echo $row["url"] ?>" />
  </div>
  <div class="prod_right">
      <h1 class="prod_name"><?= $row['name'] ?> </h1>
      <p class="prod_det">Λεπτομέριες: <?= $row['details'] ?> </p>
      <p class="prod_price">Τιμή: <?= $row['price'] ?> €</p>
      <?php if (isset($_SESSION['id'])) { ?>
      <form action="product.php?id=<?php echo $_GET["id"] ?>" method="post">

        <button class="addtocart" type="submit" name="submit" value="TRUE">Προσθήκη στο καλάθι</button>
      </form>
      <?php }else{ ?>
        <p class="call-to-login">Συνδεθείτε για να μπορείτε να προσθέσετε προιόντα στο καλάθι σας!</p>
      <?php } ?>
      <?php                                  
  if (ISSET($_POST['submit'])) {

    $q= "SELECT id, name, price FROM products WHERE id=".$_GET["id"];

    $r = @mysqli_query ($dbc, $q);
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    // while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {  
      // array_push($_SESSION['prod_id'], $row['id']);
      // array_push($_SESSION['prod_name'], $row['name']);
      // array_push($_SESSION['prod_price'], $row['price']);
      // array_push($_SESSION['quantity'], 1);
      if (isset($_SESSION['products'][$row['id']] )){
        $_SESSION['products'][$row['id']]['quantity']= $_SESSION['products'][$row['id']]['quantity'] + 1;
      }else{
        $_SESSION['products'][$row['id']] = array ('pid' => $row['id'] , 'name' => $row['name'], 'quantity' => 1, 'price' => $row['price'] );
      // }
    }

  

  


    echo "<p class='addedincart'>Προστέθηκε στο καλάθι!</p>" ; 


  }

?> 
    </div>
  </div>
</div>

<?php
  $q='SELECT products.id, products.name, products.price, photos.url FROM products, photos WHERE (products.id = photos.product_id AND products.brand_id = '.$brand.' AND products.id != '.$_GET["id"].') ORDER BY RAND() limit 3';
  $r = @mysqli_query ($dbc, $q);
  echo "<h3>Μπορεί να σας ενδιαφέρουν επίσης άλλα μοντέλα της ίδια εταιρίας:</h3>";
  echo '<div class="product_border">';
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {  
    
    echo '<div class="product_wtf">';
    echo '<a href="product.php?id='.$row['id'].'">';
    echo '<p class="product_name">'.$row['name'].'</p>';
    echo '<p>'.$row['price'].'&euro;</p>';
    echo '<img class="photo-show" src="images/'.$row['url'].'"/>';
    echo '</a></div>';

}  
echo "</div>";
?>


<?php
  include ('includes/footer.html');
?>
