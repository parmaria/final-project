<!DOCTYPE html>
<html>
<head>
	<title> <?php echo (isset($page_title)) ? $page_title : "Mary's Shop!"; ?></title>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Chelsea+Market&family=Roboto+Mono:ital,wght@0,300;0,500;1,700&display=swap" rel="stylesheet">
</head>
<body>
	<header>
			<h1> <a href="index.php">Mary's Shop</a></h1>
			<div class="connect">
				<?php 

					if (isset($_SESSION['id'])) {
						echo '<p class="logsign">Καλωσήρθες! Είσαι συνδεμένος</p>';
						echo '<a  href="logout.php">Αποσύνδεση</a>';
					}
						else{
							 echo '<p class="logsign">Καλωσήρθατε!</p>
							 <a href="login.php">Συνδεθείτε</a>
							  <p class="logsign">Είστε νέος χρήστης;</p>
								<a  href="register.php">Εγγραφή</a>';
						}
				?>
				
			</div>
			<div>
				<?php 
					if (isset($_SESSION['id'])) {
						echo '<p id="cart"><a href="viewcart.php">Καλάθι<img class="icons" src="images/cart.png" alt="phone"></a></p>';
					} ?>
				<table id="cartfastview">

					<?php 
					if (isset($_SESSION['products'])) { 
						foreach ($_SESSION['products'] as $prodid => $value){

							echo "<tr>";
						
							?>
							<td>
								<a href="product.php?id= <?php echo $_SESSION['products'][$prodid]['id'] ?> "> <?php echo $_SESSION['products'][$prodid]['name'] ?> </a>
							</td>
							<?php 
							echo "<td>".$_SESSION['products'][$prodid]['price']."</td>";
						
						
							echo "</tr>";
						}

					}
					?>



				</table>
			</div>
	</header>
	<main>
	<?php 
		require_once ('mysqli_connent.php');
    $q= 'SELECT * FROM categories';
		$r = @mysqli_query ($dbc, $q);
	
	?>
		<nav id="productnav">
		<ul id="menubar">	
	<?php
		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) { 
			echo '<li class="menuitems"><a href="categories.php?id='.$row["id"].'">'.$row["name"].'<img class="icons" src="images/'.$row['photo'].'"></a></li>';
		}
	?>
		</ul>
	</nav>





