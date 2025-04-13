<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product</title>
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
  <div class="containerForProd">
    <script type="text/javascript" src="productScript.js"></script>
  </div>
  <div id='buttonCentred'>

  <h3 <?php if(!empty($_SESSION['userID'])){echo "style=display:none";} ?>>To leave a review please log in</h3>
  <form method='post' <?php if(empty($_SESSION['userID'])){echo "style=display:none";} ?> >
  <p>Title<input type='text' name='title'></p>
  <p><textarea name='desc' rows='5' cols='40'></textarea></p>
  <input type='radio' id='1' name='rating' value='1'>
  <label for='1'>1</label><input type='radio' id='2' name='rating' value='2'>
  <label for='2'>2</label><input type='radio' id='3' name='rating' value='3'>
  <label for='3'>3</label><input type='radio' id='4' name='rating' value='4'>
  <label for='4'>4</label><input type='radio' id='5' name='rating' value='5'>
  <label for='5'>5</label><br><input type='submit' value='submit'>
  </form>
  </div>
  <?php
	$titleErr = $descErr = $ratingErr = $formErr = "";
	$title = $desc = $rating = "";
	function test_input($data) {//https://www.w3schools.com/php/php_form_complete.asp
	//$data = trim($data);
	//$data = stripslashes($data);
	//$data = htmlspecialchars($data);
	return $data;
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {////https://www.w3schools.com/php/php_form_complete.asp
		if (empty($_POST["title"])) {
			$formErr = "<h3>Try to fill form again</h3>";
		} else {
		$title = test_input($_POST["title"]);
		}

		if (empty($_POST["desc"])) {
			$formErr = "<h3>Try to fill form again</h3>";
		} else {
		$desc = test_input($_POST["desc"]);
		}
		if (empty($_POST["rating"])) {
			$formErr = "<h3>Try to fill form again</h3>";
		} else {
		$rating = test_input($_POST["rating"]);
		}
	}
	if($rating=="" || $desc=="" || $title=="")
	{
		echo $formErr;
	}
	else{
		echo $rating;
		$connection = mysqli_connect("localhost","pgurulev", "mQQHhbvpfY","pgurulev");
		$myQuery = "INSERT INTO `tbl_reviews` (`review_id`, `user_id`, `product_id`, `review_title`, `review_desc`, `review_rating`, `review_timestamp`) VALUES (NULL, '".$_SESSION["userID"]."', '".$_COOKIE["id"]."', '".$title."', '".$desc."', '".$rating."', current_timestamp());";
		$result = mysqli_query($connection, $myQuery);
	}
  ?>
  <div>
	<?php $connection = mysqli_connect("localhost","pgurulev", "mQQHhbvpfY","pgurulev");
	$myQuery = "SELECT * FROM `tbl_reviews`";
	$result = mysqli_query($connection, $myQuery);
	$sum = $count = 0;
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		if($_COOKIE["id"] == $row["product_id"]){
			$sum+=$row['review_rating'];
			$count+=1.0;
		}
	}
	if($count != 0){
	$ratingResult = $sum / $count;
	echo "<h3>Overall rating is ".number_format($ratingResult, 2)."</h3>";
	}
	else{
		echo "<h3>Nobody haven't rewieved this product yet</h3>";
	}
	?>
  </div>
  <div class='reviewContainer'>
  <?php
	$connection = mysqli_connect("localhost","pgurulev", "mQQHhbvpfY","pgurulev");
	$myQuery = "SELECT * FROM `tbl_reviews`";
	$result = mysqli_query($connection, $myQuery);
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		if($_COOKIE["id"] == $row["product_id"]){
			echo "<div class='rewievExample'><h2>".$row['review_title']."</h2><p>".$row['review_desc']."</p><h3>Final rating is ".$row['review_rating']."</h3></div>";
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