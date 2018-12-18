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
function changeClassName(originalValue){
	document.getElementById("className").removeAttribute("disabled");
	document.getElementById("changeClassName").innerHTML = "Save";
	document.getElementById("changeClassName").setAttribute("onclick","saveClassName('" + originalValue + "')");
	document.getElementById("cancelNameChange").style.display = "inline";
}
function saveClassName(originalValue){
	document.getElementById("className").setAttribute("disabled", "1");
	document.getElementById("changeClassName").innerHTML = "Change";
	document.getElementById("changeClassName").setAttribute("onclick","changeClassName()");
	document.getElementById("cancelNameChange").style.display = "none";
	
	var newName = document.getElementById("className").value;
	document.cookie = "nickname=" + originalValue;
	document.cookie = "class=" + newName;
	document.cookie = "action=n"
	
	getRequest("AJAXmanagement.php", testFunc, testFunc);
}
function cancelNameChange(originalValue){
	document.getElementById("className").setAttribute("disabled", "1");
	document.getElementById("className").innerHTML = originalValue;
	document.getElementById("changeClassName").innerHTML = "Change";
	document.getElementById("changeClassName").setAttribute("onclick","changeClassName()");
	document.getElementById("cancelNameChange").style.display = "none";
}
function changeClassStatus(originalValue, classNm, classId){
	var action;
	if(originalValue == true){action = "close";}
	else{action = "open"}
	
	var newButtonValue = (action == "open") ? "Lock the class" : "Open the class";
	var newValue = (action == "open") ? 1 : 0;
	var newText = (action == "open") ? "Opened - applications for admission are turned on" : "Locked - users can't apply for admission to the class";
	
	document.getElementById("changeClassStatus").innerHTML = newButtonValue;
	document.getElementById("changeClassStatus").setAttribute("onclick", "changeClassStatus(" + newValue + ",'" + classNm +"'," + classId +")");
	document.getElementById("classStatus").innerHTML = newText;
	
	document.cookie = "nickname=" + classNm;
	document.cookie = "action=" + action.charAt(0);		//c or o
	
	getRequest("AJAXmanagement.php", testFunc, testFunc);
	
	if(action == "close")
	{
		var clearApplications = confirm("The class was locked. Do you want to reject and remove all pending applications for admission to the class?");
		if(clearApplications == true)
		{
			document.cookie = "nickname=" + classNm;
			document.cookie = "class=" + classId;
			document.cookie = "action=r";
	
			getRequest("AJAXmanagement.php", testFunc, testFunc);
		}
	}
}
function deleteClass(username){
    var adminPass = prompt("K tomuto kroku je potřeba znovu zadat vaše administrátorské heslo.\nZadejte heslo a pokračujte zvolením OK.");
    //TODO - verificate the password
	document.cookie = "nickname=" + username;
	document.cookie = "admin=" + adminPass;
	document.cookie = "action=e";
	getRequest("AJAXmanagement.php", deleteClass2, testFunc, username, adminPass);
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
	var applyClass = event.target.parentNode.parentNode.childNodes[5].innerHTML;
	
	var user = document.getElementById("username").innerHTML.split(" ");
	user = user[user.length - 1];
	
	//Removing the application from DOM
	event.target.parentNode.parentNode.parentNode.removeChild(event.target.parentNode.parentNode);
	
	message = message.replace(/\r\n/g, '<br>').replace(/[\r\n]/g, '<br>');
	
	//Save nickname, message and class value into cookie so PHP can access it
	document.cookie = "nickname=" + nickname;
	document.cookie = "message=" + encodeURIComponent(message);
	document.cookie = "class=" + applyClass;

	document.cookie = "admin=" + user;
	document.cookie = "action=a";
	
	//Opening AJAX request
	getRequest("AJAXmanagement.php", testFunc, testFunc);
}
function decline(event){
	//Getting application details
	var nickname = event.target.parentNode.parentNode.childNodes[0].innerHTML;
	var message =  event.target.parentNode.parentNode.childNodes[3].childNodes[0].innerHTML;
	var applyClass = event.target.parentNode.parentNode.childNodes[5].innerHTML;
	
	var user = document.getElementById("username").innerHTML.split(" ");
	user = user[user.length - 1];
	
	//Removing the application from DOM
	event.target.parentNode.parentNode.parentNode.removeChild(event.target.parentNode.parentNode);
	
	message = message.replace(/\r\n/g, '<br>').replace(/[\r\n]/g, '<br>');
	
	//Save nickname, message and class value into cookie so PHP can access it
	document.cookie = "nickname=" + nickname;
	document.cookie = "message=" + encodeURIComponent(message);
	document.cookie = "class=" + applyClass;

	document.cookie = "admin=" + user;
	document.cookie = "action=d";
	
	//Opening AJAX request
	getRequest("AJAXmanagement.php", testFunc, testFunc);
}
function getRequest(url, success, error, user=null, password=null){
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
	if (typeof error!= 'function') error = function () {};
	
	//Waiting for server response
	req.onreadystatechange = function()
	{
		if(req.readyState == 4)
		{
			return req.status === 200 ? success(req.responseText) : error(req.status);
		}
	}
	req.open("GET", url, true, user, password);
	req.send();
	return req;
}
function deleteClass2(response){
	if(response != "Confirmed")
	{
		alert("Špatné heslo");
	}
	else
	{
		var confirmation = confirm("Tato akce je nevratná! Vaše třída bude trvale odstraněna z databáze.\nProces odstranění třídy bude možné zastavit na této stránce v průběhu následujících 24 hodin.");
		if(confirmation == true)
		{
			document.cookie = "nickname=" + username;
			document.cookie = "action=E";
			getRequest("AJAXmanagement.php", testFunc, testFunc);
		}
		//TODO - set the deletion time
	}
}
function testFunc(response){alert(response);}