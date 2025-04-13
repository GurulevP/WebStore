<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
  <link rel="stylesheet" type="text/css" href="index.css" />
  <script type="text/javascript" src="productsScript.js"></script>
  <script type="text/javascript" src="HelperFunctions.js"></script>
</head>
<body>
<header>
  <img class ="logo" src="images/logo.svg" alt="UCLan logo">
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
  <div class="container-button">
	<form>
	<input type="text" id="searchEngine" name="fname">	
	<input type="button" onclick="findProduct()" value="Search">
	</form>
    <button onclick="showHoodies()">Hoodies</button>
    <button onclick="showJumpers()">Jumpers</button>
    <button onclick="showTShirts()">TShirts</button>
  </div>
  <div class="itemBlocks">
	<?php
		$connection = mysqli_connect("localhost","pgurulev", "mQQHhbvpfY","pgurulev");
		$myQuery = "SELECT * FROM `tbl_products`";
		$result = mysqli_query($connection, $myQuery);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$num = "1";
			$path = $num.''.$row["product_image"];
			/*$productData = [
			"productName" => $row["product_title"],
			"productDescription"=> $row["product_desc"],
			"productImage" => $path,
			"productPrice" => $row["product_price"],
			];*/
			$productData = array($row["product_id"],$row["product_title"],$row["product_desc"], $path, $row["product_price"]);
			$jsonProductData = json_encode($productData);
			if($row["product_type"] === 'UCLan Hoodie'){
				echo "<div class='hoodie'><img src='".$path."' alt='".$row["product_title"]."'><h2>".$row["product_title"]."</h2><p>".$row["product_desc"]." <a class='inf' onclick='moreInfo(".$jsonProductData.")'>more info</a></p><p>".$row["product_price"]."</p><button onclick='addToCart(".$jsonProductData.")'>add to cart</button></div>";
			}
			else if($row["product_type"] === "UCLan Logo Jumper"){
				echo "<div class='jumper'><img src='".$path."' alt='".$row["product_title"]."'><h2>".$row["product_title"]."</h2><p>".$row["product_desc"]." <a class='inf' onclick='moreInfo(".$jsonProductData.")'>more info</a></p><p>".$row["product_price"]."</p><button onclick='addToCart(".$jsonProductData.")'>add to cart</button></div>";
			}
			else{
				echo "<div class='tshirt'><img src='".$path."' alt='".$row["product_title"]."'><h2>".$row["product_title"]."</h2><p>".$row["product_desc"]." <a class='inf' onclick='moreInfo(".$jsonProductData.")'>more info</a></p><p>".$row["product_price"]."</p><button onclick='addToCart(".$jsonProductData.")'>add to cart</button></div>";
			}
		}
	?>	
  </div>
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