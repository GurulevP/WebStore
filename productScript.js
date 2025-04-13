function find(val, array)
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
let item = JSON.parse(sessionStorage.getItem("selectedItema"));//Made by myself
setCookie("id", item[0], 1);
let container = document.getElementsByClassName("containerForProd")[0];
container.innerHTML += "<img src='"+item[3]+"'><h1>"+item[1]+"</h1><p>"+item[2]+"</p><h1>"+item[4]+"</h1><button onclick='addToCart("+JSON.stringify(item)+")'>add to cart</button>"