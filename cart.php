<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
  <link rel="stylesheet" type="text/css" href="index.css" />
  <script type="text/javascript" src="HelperFunctions.js"></script>
</head>
<body>
<header>
  <img class="logo" src="images/logo.svg" alt="UCLan logo">
  <p class="StudS">Student Shop</p>
  <nav>
    <ul class="myNav">
      <li class="navList"><a href="index.php">Home</a> </li>
      <li class="navList"><a href="products.php">Products</a></li>
      <li class="navList"><a href="cart.php">Cart</a> </li>
	   <li class="navList"><a href="FormTest.php" id="login">Log in</a> </li>
    </ul>
  </nav>
</header>
<main class ='cartMain'>
  <div class="flexContainer">
    <div class="Dva">Image</div>
    <div class="Dva">Product</div>
    <div class="Dva">Quantity</div>
    <div class="Dva">Price</div>
  </div>
  <script type="text/javascript" src="cart.js"></script>
  <?php 
  if(empty($_SESSION['userID'])){
	  echo "<h3>You have to log in to make an order!</h3>";
  }
  else{
	  if (isset($_POST['sendOrder']))
  {
		$connection = mysqli_connect("localhost","pgurulev", "mQQHhbvpfY","pgurulev");
		$myQuery = "INSERT INTO `tbl_orders` (`order_id`, `order_date`, `user_id`, `product_ids`) VALUES (NULL, current_timestamp(), '".$_SESSION["userID"]."', '".$_COOKIE["id"]."');";
		$result = mysqli_query($connection, $myQuery);
		echo "<script>cleanStorage()</script>";
  }
  }
  ?>
</main>
<footer>
  <div class="block">
    <div class="undBlock">
      <h1 style="text-align: center">Links</h1>
      <p><a class="link" href="https://www.uclancyprus.ac.cy/">Uclan original site</a></p>
    </div>
    <div class="undBlock">
      <h1 style="text-align: center">Contacts</h1>
      <p>Phone: + 357 24 69 40 00</p>
      <p>email:info@uclancyprus.ac.cy</p>
    </div>
    <div class="undBlock">
      <h1 style="text-align: center">Location</h1>
      <p>12 – 14 University Avenue Pyla</p>
      <p>7080 Larnaka, Cyprus</p>
    </div>
  </div>
</footer>
</body>
</html>