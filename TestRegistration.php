<?php
session_start();
?>
<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" type="text/css" href="index.css" />
<script type="text/javascript" src="HelperFunctions.js"></script>
<style>
.error {color: #FF0000;}
</style>
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
<?php
// define variables and set to empty values
$nameErr = $mailErr = $adressErr = $passwErr = "";
$name = $mail = $adress = $passw = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
  }

  if (empty($_POST["passw"])) {
    $passwErr = "Password is required";
  } else {
    $passw = test_input($_POST["passw"]);
  }
  if (empty($_POST["adress"])) {
    $adressErr = "Adress is required";
  } else {
    $adress = test_input($_POST["adress"]);
  }
  if (empty($_POST["mail"])) {
    $mailErr = "EMail is required";
  } else {
    $mail = test_input($_POST["mail"]);
  }
  if (isset($_POST['resetSession']))
  {
	  $_SESSION['userID'] = "";
	  echo "<script>deleteElement();</script>";
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Registration form</h2>
<div id='deleteData'>
<p><span class="error">* required field</span></p>
<form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <p>Full Name: <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span></p>
  <br>
  <p>Password: <input type="text" name="passw">
  <span class="error">* <?php echo $passwErr;?></span></p>
  <br>
  <p>Adress: <input type="text" name="adress">
  <span class="error">* <?php echo $adressErr;?></span></p>
  <br>
  <p>EMail: <input type="email" name="mail">
  <span class="error">* <?php echo $mailErr;?></span></p>
  <br>
  <div id='buttonCentred'>
  <input type="submit" name="submit" value="Submit">  
  </div>
</form>
</div>

<?php
if(empty($_SESSION['userID'])){
	if($name != ""){
$connection = mysqli_connect("localhost","pgurulev", "mQQHhbvpfY","pgurulev");
$myQuery = "SELECT * FROM `tbl_users`";
$result = mysqli_query($connection, $myQuery);
$flag = true;
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
	if($name === $row["user_full_name"])
	{
		$flag = false;
		echo "<h3>This user already exists try another name</h3>";
	}
}
		if($flag){
		$myQuery = "INSERT INTO `tbl_users` (`user_id`, `user_full_name`, `user_address`, `user_email`, `user_pass`, `user_timestamp`) Values (NULL, '".$name."', '".$adress."', '".$mail."', '".crypt($passw, '$2y$10$anexamplestringforsalt$')."', current_timestamp())";
		$result = mysqli_query($connection, $myQuery);
		echo "<h3>Your account registred!</h3>";
		echo "<script>delThings()</script>";
		$myQuery = "SELECT * FROM `tbl_users`";
		$result = mysqli_query($connection, $myQuery);
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			if($name === $row["user_full_name"]){
				$_SESSION['userID']=$row["user_id"];
				echo "<script>addData(('".strval($name)."'))</script>";
			}
		}
		}
	}
}
else{
	echo "<h3>You already logged in</h3> <br> <form method='post'><div id='buttonCentred'><input type='submit' name='resetSession' value='Log out'></div></form>";
	echo "<script>delThings()</script>";
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