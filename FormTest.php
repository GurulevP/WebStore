<?php
session_start();
?>
<!DOCTYPE HTML>  
<html>
<head>
<script type="text/javascript" src="HelperFunctions.js"></script>
<link rel="stylesheet" type="text/css" href="index.css" />
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  <header>
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
$nameErr = $emailErr = $genderErr = $passwErr = "";
$name = $email = $gender = $passw = $website = "";

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

<h2>Login form</h2>
<div id='deleteData'>
<p><span class="error">* required field</span></p>
<form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <p>Full Name: <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span></p>
  <br>
  <p>Password: <input type="text" name="passw">
  <span class="error">* <?php echo $passwErr;?></span></p>
  <br>
  <div id='buttonCentred'>
  <input type="submit" name="submit" value="Submit">
  <a href='TestRegistration.php'>       Register new account</a>
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
	if($name === $row["user_full_name"] && crypt($passw, '$2y$10$anexamplestringforsalt$') === $row["user_pass"])
	{
		$_SESSION['userID']=$row["user_id"];
		echo "<h3>You have logged in!</h3>";
		echo "<script>delThings();</script>";
		echo "<script>addData(('".strval($name)."'))</script>";
		$flag = false;
	}
}
if($flag){
	echo "<h3>Your login or password are incorrect try again</h3>";
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