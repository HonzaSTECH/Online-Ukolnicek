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
function hideForm(event){
	event.preventDefault();
	document.getElementById("subjectsForm").style.display = "none";
}
function accept(event){
	//Getting application details
	var nickname = event.target.parentNode.parentNode.childNodes[0].innerHTML;
	var message =  event.target.parentNode.parentNode.childNodes[3].childNodes[0].innerHTML;
	console.log(message);
	var applyClass = event.target.parentNode.parentNode.childNodes[5].innerHTML;
	
	var user = document.getElementById("username").innerHTML.split(" ");
	user = user[user.length - 1];
	
	//Removing the application from DOM
	event.target.parentNode.parentNode.parentNode.removeChild(event.target.parentNode.parentNode);
	
	//Save nickname, message and class value into cookie so PHP can access it
	document.cookie = "nickname=" + nickname;
	document.cookie = "message=" + encodeURIComponent(message);
	document.cookie = "class=" + applyClass;

	document.cookie = "admin=" + user;
	document.cookie = "action=a";
	
	//Opening AJAX request
	getRequest("AJAXmanagement.php", testFunc, testFunc);
}
function decline(){
	//Getting application details
	var nickname = event.target.parentNode.parentNode.childNodes[0].innerHTML;
	var message =  event.target.parentNode.parentNode.childNodes[3].childNodes[0].innerHTML;
	var applyClass = event.target.parentNode.parentNode.childNodes[5].innerHTML;
	
	var user = document.getElementById("username").innerHTML.split(" ");
	user = user[user.length - 1];
	
	//Removing the application from DOM
	event.target.parentNode.parentNode.parentNode.removeChild(event.target.parentNode.parentNode);
	
	//Save nickname, message and class value into cookie so PHP can access it
	document.cookie = "nickname=" + nickname;
	document.cookie = "message=" + message;
	document.cookie = "class=" + applyClass;

	document.cookie = "admin=" + user;
	document.cookie = "action=d";
	
	//Opening AJAX request
	getRequest("AJAXmanagement.php", testFunc, testFunc);
}
function getRequest(url, success, error)
{
	var req = false;
	//Creating request
	try
	{
		//Most broswers
		req = new XMLHttpRequest();
	} catch (e)
	{
		//Interned Explorer
		try
		{
			req = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e)
		{
			//Older version of IE
			try
			{
				req = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e)
			{
				return false;
			}
		}
	}
	
	//Checking request
	if (!req) return false;
	
	//Checking function parametrs and setting intial values in case they aren´t specified
	if (typeof success != 'function') success = function () {};
	if (typeof error!= 'function') error = function () {};
	
	//Waiting for server response
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
function testFunc(response){alert(response);}