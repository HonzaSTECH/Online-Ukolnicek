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
function reloadDeletionTime(){
	//Saving action into cookie, so PHP can access it
	document.cookie = "action=t";
	
	//Opening AJAX request
	getRequest("AJAXmanagement.php", updateDeletionTime, testFunc);
}
function changeSubjects(){
	document.getElementById("subjectsForm").style.display = "block";
}
function hideForm(event){
	event.preventDefault();
	document.getElementById("subjectsForm").style.display = "none";
}
function getRequest(url, success, error){
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
	
	//Checking function parameters and setting intial values in case they aren´t specified
	if (typeof success != 'function') success = function () {};
	if (typeof error != 'function') error = function () {};
	
	//Waiting for server response
	req.onreadystatechange = function()
	{
		if(req.readyState == 4)
		{
			return req.status === 200 ? success(req.responseText) : error(req.status);
		}
	}
	req.open("GET", url, true);
	req.send();
	return req;
}
function testFunc(response){/*alert(response);*/}
