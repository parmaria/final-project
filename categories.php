<?php  
session_start();
include ('includes/header.php');

$page_title = 'Categories';
if(isset($_GET["id"])){
    $page_title = "Categories";
    $catid= $_GET["id"];

    $q="SELECT * FROM products,photos WHERE (products.id=photos.product_id AND products.category_id = '$catid')";
    $r = @mysqli_query ($dbc, $q);
 
    echo '<div class="product_border">';
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {  
         // ****** ΠΡΩΤΟΣ ΤΡΌΠΟΣ ΕΜΦΩΛΕΥΣΗΣ HTML ΣΕ PHP *************************
        echo '<div class="product_wtf">';
        echo '<a href="product.php?id='.$row['id'].'">';
        echo '<p class="product_name">'.$row['name'].'</p>';
        echo '<p>'.$row['price'].'&euro;</p>';
        echo '<img class="photo-show" src="images/'.$row['url'].'"/>';
        echo '</a></div>';
    }  
    echo '</div>';

}else{

    require_once ('includes/functions.php');
	$url = absolute_url();
	header("Location: $url");
    exit();
}

include ('includes/footer.html');
      
?>



