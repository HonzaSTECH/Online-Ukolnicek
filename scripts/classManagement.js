function firstTab(){
	document.getElementById("tab2").style.display = "none";
	document.getElementById("tab3").style.display = "none";
	document.getElementById("tab4").style.display = "none";
	
	document.getElementById("tab1").style.display = "block";
}
function secondTab(){
	document.getElementById("tab1").style.display = "none";
	document.getElementById("tab3").style.display = "none";
	document.getElementById("tab4").style.display = "none";
	
	document.getElementById("tab2").style.display = "block";
}
function thirdTab(){
	document.getElementById("tab1").style.display = "none";
	document.getElementById("tab2").style.display = "none";
	document.getElementById("tab4").style.display = "none";
	
	document.getElementById("tab3").style.display = "block";
}
function fourthTab(){
	document.getElementById("tab1").style.display = "none";
	document.getElementById("tab2").style.display = "none";
	document.getElementById("tab3").style.display = "none";
	
	document.getElementById("tab4").style.display = "block";
}
function changeSubjects(){
	document.getElementById("subjectsForm").style.display = "block";
}
function hideForm(){
	document.getElementById("subjectsForm").style.display = "none";
}
function accept(event){
	var nickname = event.target.parentNode.parentNode.childNodes[0].innerHTML;
	var message =  event.target.parentNode.parentNode.childNodes[3].childNodes[0].innerHTML;
	var applyClass = event.target.parentNode.parentNode.childNodes[5].innerHTML;
	
	var user = document.getElementById("username").innerHTML.split(" ");
	user = user[user.length - 1];
	
	
	event.target.parentNode.parentNode.parentNode.removeChild(event.target.parentNode.parentNode);
	
	document.cookie = "nickname=" + nickname;
	document.cookie = "message=" + message;		//Save nickname, message and class value into cookie so PHP can acces it
	document.cookie = "class=" + applyClass;

	document.cookie = "admin=" + user;
	document.cookie = "action=a";

	getRequest("AJAXmanagement.php", testFunc, testFunc);
}
function decline(){
	var nickname = event.target.parentNode.parentNode.childNodes[0].innerHTML;
	var message =  event.target.parentNode.parentNode.childNodes[3].childNodes[0].innerHTML;
	var applyClass = event.target.parentNode.parentNode.childNodes[5].innerHTML;
	
	var user = document.getElementById("username").innerHTML.split(" ");
	user = user[user.length - 1];
	
	event.target.parentNode.parentNode.parentNode.removeChild(event.target.parentNode.parentNode);
	
	document.cookie = "nickname=" + nickname;
	document.cookie = "message=" + message;		//Save nickname, message and class value into cookie so PHP can acces it
	document.cookie = "class=" + applyClass;

	document.cookie = "admin=" + user;
	document.cookie = "action=d";

	getRequest("AJAXmanagement.php", testFunc, testFunc);
}
function getRequest(url, success, error)
{
	var req = false;
	try //Creating request
	{
		// most browsers
		req = new XMLHttpRequest();
	} catch (e)
	{
		// IE
		try
		{
			req = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e)
		{
			// try an older version
			try
			{
				req = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e)
			{
				return false;
			}
		}
	}
	if (!req) return false;	//Checking request
	if (typeof success != 'function') success = function () {};	//Checking function parametrs and setting intial values in case they aren´t specified
	if (typeof error!= 'function') error = function () {};
	req.onreadystatechange = function()
	{
		if(req.readyState == 4)
		{
			return req.status === 200 ? success(req.responseText) : error(req.status);
		}
	}
	req.open("GET", url, true);
	req.send(null);
	return req;
}
function testFunc(response){
	alert(response);
}