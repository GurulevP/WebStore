<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main page</title>
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
<main>
	<h3>
	<?php if(!empty($_SESSION['userID']))
	{
		$connection = mysqli_connect("localhost","pgurulev", "mQQHhbvpfY","pgurulev");
		$myQuery = "SELECT * FROM `tbl_users`";
		$result = mysqli_query($connection, $myQuery);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			if($row["user_id"] == $_SESSION['userID']){
				echo "Welcome back ".$row["user_full_name"]."!";
			}
		}
	} ?>
	</h3>
    <h1 id="Header">Where opportunity creates success</h1>
    <p>You can support our university buying our merch</p>
    <p>Your story starts here, let's build our future</p>
	<h2>Special Offers!</h2>
	<div class="flexContainer">
		<?php 
			$connection = mysqli_connect("localhost","pgurulev", "mQQHhbvpfY","pgurulev");
			$myQuery = "SELECT * FROM `tbl_offers`";
			$result = mysqli_query($connection, $myQuery);
			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			echo "<div class='flexOffers'><h3>".$row["offer_title"]."</h3><p>".$row["offer_dec"]."</p></div>";
			}
		?>
	</div>
    <h2>Together</h2>
    <video src="video/video.mp4" controls width="800" height="600"></video>
    <h2>Discover Preston with Uclan!</h2>
    <iframe src="https://www.youtube.com/embed/EI_lco-qdw8" width="800" height="600" ></iframe>
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