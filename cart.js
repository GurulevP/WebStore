function cleanStorage(){//https://www.w3schools.com/html/html5_webstorage.asp#gsc.tab=0
    localStorage.clear();
	alert("Your order is added");
    window.location.href= "products.php";
}

if(localStorage.getItem("cart") !== null) {//Made by myself + https://www.w3schools.com/html/html5_webstorage.asp#gsc.tab=0
    let items = JSON.parse(localStorage.getItem("cart"));
    let finalPrice = 0;
	let productIDs = "";
    for (let i = 0; i < items.length; i++) {
        let cont = document.getElementsByClassName("cartMain")[0];
        cont.innerHTML += "<div class='flexContainer'>" +
            "<img src='" + items[i][3] + "' alt='" + items[i][1] + "' class='productImage'>" +
            "<div class='productItem'>" + items[i][1] + "</div>" +
            "<div class='productItem'>" + items[i][5] + "</div>" +
            "<div class='productItem'>" + (JSON.parse(items[i][4]) * JSON.parse(items[i][5])) + "</div>" +
            "</div>";
        finalPrice += JSON.parse(items[i][4]) * JSON.parse(items[i][5]);
		for(let j = 0; j < JSON.parse(items[i][5]); j++){
		productIDs+=items[i][0] + ", ";
		}
    }
	setCookie("id", productIDs, 1);
    let cont = document.getElementsByClassName("cartMain")[0]; //Made by myself
    cont.innerHTML += "<div class='container-button'><h2>The final price is " + finalPrice + "</h2><form method='post'><div id='buttonCentred'><input type='submit' name='sendOrder' value='Buy'></div></form></div>";
}
else{
    let cont = document.getElementsByClassName("cartMain")[0];//Made by myself
    cont.innerHTML += "<p>Your Cart is empty</p>";
}