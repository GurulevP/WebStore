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
        for(let j = 0; j < 5; j++)
        {
            if(val[j] === array[i][j]){
                count++;
            }
        }
        if(count === 5)
        {
            return i;
        }
    }
    return -1;
}
function addToCart(array)//https://www.w3schools.com/html/html5_webstorage.asp#gsc.tab=0
{
    alert(""+array[1]+" added to cart");//https://www.w3schools.com/jsref/tryit.asp?filename=tryjsref_alert
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
            let number = cart[find(array,cart)][5];
            number = JSON.parse(number);
            number+=1;
            cart[find(array, cart)][5] = JSON.stringify(number);
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