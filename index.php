<?php
$page_title = "Mary's shop";
session_start();
include ('includes/header.php');
require_once ('mysqli_connent.php');
?>

 <!-- Taken from w3scools as it is -->
 <div class="slideshow-container">
    <div class="mySlides fade">
      <div class="numbertext">1 / 3</div>
      <img src="images/phones.jpg" style="width:100%">

    </div>

    <div class="mySlides fade">
      <div class="numbertext">2 / 3</div>
      <img src="images/speakers.jpg" style="width:100%">

    </div>

    <div class="mySlides fade">
      <div class="numbertext">3 / 3</div>
      <img src="images/tablets.jpg" style="width:100%">

    </div>

    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>

  <br>
  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span> 
    <span class="dot" onclick="currentSlide(2)"></span> 
    <span class="dot" onclick="currentSlide(3)"></span> 
  </div>

  <?php 
    $q= 'SELECT products.id, products.name, products.price, photos.url FROM products, photos WHERE products.id=photos.product_id ORDER BY RAND() LIMIT 6';
    $r = @mysqli_query ($dbc, $q);
   ?>
    <div class="product_border">
     <?php
        while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {?>
          <div class="product_wtf">
          <!-- // ****** ΔΕΥΤΕΡΟΣ ΤΡΌΠΟΣ ΕΜΦΩΛΕΥΣΗΣ PHP ΣΕ HTML ************************* -->
            <a href="product.php?id=<?php echo $row['id'] ?>">
              <p class="product_name"><?php echo $row['name']?></p>
              <p><?php echo $row['price']?>&euro;</p>
              <img class="photo-show" src="images/<?php echo $row['url'] ?>"/>
            </a>
          </div> 
        <?php } ?> 
    </div>


  <script src="includes/script.js"></script>

<?php 
include ('includes/footer.html');
?>

