function delThings()
{
		document.getElementById("deleteData").remove();
}
function checkExistance(){
	if(localStorage.getItem("clientName") !== "null" && localStorage.getItem("clientName") !== null)
	{
		document.getElementById("login").innerText = localStorage.getItem("clientName");
	}
	else{
		document.getElementById("login").innerText = "Log in";
	}
}
function addData(userName)
{
	localStorage.clientName = userName;
}
function deleteElement()
{
	localStorage.clientName = null;
}
setInterval(checkExistance, 1000);

function setCookie(cname, cvalue, exdays) {//https://www.w3schools.com/js/js_cookies.asp
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {//https://www.w3schools.com/js/js_cookies.asp
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}