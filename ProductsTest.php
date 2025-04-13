<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
  <link rel="stylesheet" type="text/css" href="index.css" />
  <script>
  function showHoodies()//https://www.w3schools.com/cssref/pr_class_display.php
{
    let elem = document.getElementsByClassName("hoodie");
    for(let i = 0; i < elem.length; i++){
        elem[i].style.display="block";
    }
    let elem1 = document.getElementsByClassName("jumper");
    for(let i = 0; i < elem1.length; i++){
        elem1[i].style.display="none";
    }
    let elem2 = document.getElementsByClassName("tshirt");
    for(let i = 0; i < elem2.length; i++){
        elem2[i].style.display="none";
    }

}
function showJumpers()//https://www.w3schools.com/cssref/pr_class_display.php
{
    let elem = document.getElementsByClassName("hoodie");
    for(let i = 0; i < elem.length; i++){
        elem[i].style.display="none";
    }
    let elem1 = document.getElementsByClassName("jumper");
    for(let i = 0; i < elem1.length; i++){
        elem1[i].style.display="block";
    }
    let elem2 = document.getElementsByClassName("tshirt");
    for(let i = 0; i < elem2.length; i++){
        elem2[i].style.display="none";
    }
}
function showTShirts()//https://www.w3schools.com/cssref/pr_class_display.php
{
    let elem = document.getElementsByClassName("hoodie");
    for(let i = 0; i < elem.length; i++){
        elem[i].style.display="none";
    }
    let elem1 = document.getElementsByClassName("jumper");
    for(let i = 0; i < elem1.length; i++){
        elem1[i].style.display="none";
    }
    let elem2 = document.getElementsByClassName("tshirt");
    for(let i = 0; i < elem2.length; i++){
        elem2[i].style.display="block";
    }
}
  function moreInfo(array)//https://www.w3schools.com/html/html5_webstorage.asp#gsc.tab=0
  {
    sessionStorage.setItem("selectedItema", JSON.stringify(array));
    window.location.href= "product.php";
  }
  function find(val, array)//Made by myself
{
    for(let i = 0; i < array.length; i++){
        let count = 0;
        for(let j = 0; j < 4; j++)
        {
            if(val[j] === array[i][j]){
                count++;
            }
        }
        if(count === 4)
        {
            return i;
        }
    }
    return -1;
}
function addToCart(array)//https://www.w3schools.com/html/html5_webstorage.asp#gsc.tab=0
{
    alert(""+array[0]+" added to cart");//https://www.w3schools.com/jsref/tryit.asp?filename=tryjsref_alert
    if(localStorage.cart){

        let cart = JSON.parse(localStorage.cart);
        let val = [];
        for(let i = 0; i < array.length; i++){
            val.push(array[i]);
        }
        if(find(val, cart) === -1) {
            cart.push(array);
            cart[cart.length - 1].push(JSON.stringify(1));
        }
        else{
            let number = cart[find(array,cart)][4];
            number = JSON.parse(number);
            number+=1;
            cart[find(array, cart)][4] = JSON.stringify(number);
        }
        localStorage.cart = JSON.stringify(cart);


    }else{



        let cart = Array();

        cart.push(array);
        cart[cart.length-1].push(JSON.stringify(1));
        localStorage.cart = JSON.stringify(cart);

    }

}
function findProduct()
{
	let searchBasis = document.getElementById("searchEngine").value;
	let elem = document.getElementsByClassName("hoodie");
    for(let i = 0; i < elem.length; i++){
        elem[i].style.display="none";
    }
    let elem1 = document.getElementsByClassName("jumper");
    for(let i = 0; i < elem1.length; i++){
        elem1[i].style.display="none";
    }
    let elem2 = document.getElementsByClassName("tshirt");
    for(let i = 0; i < elem2.length; i++){
        elem2[i].style.display="none";
    }
	for(let j = 0; j < elem.length; j++)
	{
		if(elem[j].childNodes[1].innerText.toLowerCase().search(searchBasis.toLowerCase()) != -1)
		{
			elem[j].style.display="block";
		}
	}
	for(let j = 0; j < elem1.length; j++)
	{
		if(elem1[j].childNodes[1].innerText.toLowerCase().search(searchBasis.toLowerCase()) != -1)
		{
			elem1[j].style.display="block";
		}
	}
	for(let j = 0; j < elem2.length; j++)
	{
		if(elem2[j].childNodes[1].innerText.toLowerCase().search(searchBasis.toLowerCase()) != -1)
		{
			elem2[j].style.display="block";
		}
	}
}
  </script>
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
  <div class="itemBlock">
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
			$productData = array($row["product_title"],$row["product_desc"], $path, $row["product_price"]);
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