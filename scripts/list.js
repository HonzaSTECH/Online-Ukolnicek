var row;

function newRecord(event)
{
	event.preventDefault();
	document.getElementById("form").style.display = "none";
	var i;
	
	//Getting priority of the new record
	var recordColor;
	switch(document.querySelector('input[name="priority"]:checked').value)
	{
		case "1":
			recordColor = "#FF8888";
			break;
		case "2":
			recordColor = "#FFCC88";
			break;
		case "3":
			recordColor = "#FFFF77";
			break;
		case "4":
			recordColor = "#88EE88";
			break;
		case "5":
			recordColor = "#9999FF";
			break;
		default:
			recordColor = "#FFFF77";
	}
	
	//Getting date of the new record
	var dateWork = document.getElementById("form1").value;
	
	var year = getDate(dateWork, "y");
	var month = getDate(dateWork, "m");
	var day = getDate(dateWork, "d");
	dateWork = formatDate(dateWork, "Y-M-D to D. M. Y");
	
	var date = new Date();
	var today = (date.getDate() + ". " + (date.getMonth()+1) + ". " + date.getFullYear());
	
	//Finding out if the new record is a duplicate
	var duplicate = false;
	if(document.getElementById("form").style.backgroundColor == "rgb(153, 254, 254)")
	{
		duplicate = true;
	}
	else 
	{
		for(i=1; i<=(document.getElementsByTagName("tr").length)-2; i++)
		{
			if(document.getElementsByClassName("column2")[i].innerText == document.getElementById("form2").value && document.getElementsByClassName("column1")[i].innerText == dateWork)
			{
				duplicate = true;
				row = document.getElementsByTagName("tr")[i + 1];
				break;
			}
		}
	}
	
	
	if(duplicate == false)		//Adding completly new record
	{	
		//Creating and styling elements
		var date = document.createElement("td");
		var subject = document.createElement("td");
		var description = document.createElement("td");
		var author = document.createElement("td");
		var dateOfAdding = document.createElement("td");
		var likes = document.createElement("td");
		var action = document.createElement("td");
		
		var actionButton2 = document.createElement("button");
		var actionButton3 = document.createElement("button");
		
		actionButton2.innerHTML = "Edit";
		actionButton2.setAttribute("class", "action2");
		actionButton2.setAttribute("onclick", "editRecord(event)");
		actionButton3.innerHTML = "Delete";
		actionButton3.setAttribute("class", "action3");
		actionButton3.setAttribute("onclick", "removeRecord(event)");
		
		date.innerHTML = dateWork;
		subject.innerHTML = document.getElementById("form2").value;
		description.innerHTML = document.getElementById("form3").value;
		author.innerHTML = "Vy";
		dateOfAdding.innerHTML = today;
		likes.innerHTML = "0";
		action.append(actionButton2, actionButton3);
		
		date.setAttribute("class","column1");
		subject.setAttribute("class","column2");
		description.setAttribute("class","column3");
		author.setAttribute("class","column4");
		dateOfAdding.setAttribute("class","column5");
		likes.setAttribute("class","column6");
		action.setAttribute("class","column7");
		date.setAttribute("bgcolor", recordColor);
		subject.setAttribute("bgcolor", recordColor);
		description.setAttribute("bgcolor", recordColor);
		author.setAttribute("bgcolor", recordColor);
		dateOfAdding.setAttribute("bgcolor", recordColor);
		likes.setAttribute("bgcolor", recordColor);
		action.setAttribute("bgcolor", recordColor);
		
		//Composing the row of styled and filled td elements
		var rw = document.createElement("tr");
		rw.append(date, subject, description, author, dateOfAdding, likes, action);
		
		//Finding out correct position of the new row (by date)
		var next;
		for(i = 1; i < document.getElementsByTagName("tr").length; i++)
		{
			next = document.getElementsByTagName("tr")[i]
			date = next.childNodes[1].innerHTML;
			
			var dateTemp = date;
			var yearT=undefined;
			var monthT=undefined;
			var dayT=undefined;
			i=0;
			
			for(; dateTemp[i] != "."; i++)
			{
				if(dayT == undefined){day = dateTemp[i];}
				else{dayT += dateTemp[i];}
			}
			i++; i++;
			for(; dateTemp[i] != "."; i++)
			{
				if(monthT == undefined){month = dateTemp[i];}
				else{monthT += dateTemp[i];}
			}
			i++; i++;
			for(; dateTemp[i] != "." && dateTemp[i] != undefined; i++)
			{
				if(yearT == undefined){year = dateTemp[i];}
				else{yearT += dateTemp[i];}
			}
			if(yearT > year || (monthT > month && yearT == year) || (dayT > day && monthT == month && yearT == year)){break;}
		}
		
		//Inserting the new row
		document.getElementsByTagName("tr")[0].parentNode.insertBefore(rw, next);
		
		//Saving cookies for AJAX script
		document.cookie = "date=" + document.getElementById("form1").value;
		document.cookie = "subject=" + document.getElementById("form2").value;
		document.cookie = "description=" + document.getElementById("form3").value;
		document.cookie = "priority=" + document.querySelector('input[name="priority"]:checked').value;
		
		getRequest("AJAXnewRecord.php", testFunc, testFunc);
	}
	else						//Edditing a duplicate
	{
		console.log("Duplicate");
		//alert("Ve Vámi zadaný den je již písemka z tohoto předmětu zadána. Daný záznam byl tedy upraven dle Vámi zadaných dat jakožto duplikát.");
		var mult = (row.childNodes.length == 7 ? 0:1);
		console.log(row.childNodes.length);
		console.log(mult);
		row.childNodes[0 + (1 * mult)].innerHTML = dateWork;
		row.childNodes[1 + (2 * mult)].innerHTML = document.getElementById("form2").value;
		row.childNodes[2 + (3 * mult)].innerHTML = document.getElementById("form3").value;
		row.childNodes[0 + (1 * mult)].setAttribute("bgColor", recordColor);
		row.childNodes[1 + (2 * mult)].setAttribute("bgColor", recordColor);
		row.childNodes[2 + (3 * mult)].setAttribute("bgColor", recordColor);
		row.childNodes[3 + (4 * mult)].setAttribute("bgColor", recordColor);
		row.childNodes[4 + (5 * mult)].setAttribute("bgColor", recordColor);
		row.childNodes[5 + (6 * mult)].setAttribute("bgColor", recordColor);
		row.childNodes[6 + (7 * mult)].setAttribute("bgColor", recordColor);
		
		document.cookie = "newDate=" + document.getElementById("form1").value;
		document.cookie = "newSubject=" + document.getElementById("form2").value;
		document.cookie = "newDescription=" + document.getElementById("form3").value;		//Saving new values into cookies so PHP can access it
		document.cookie = "newPriority=" + document.querySelector('input[name="priority"]:checked').value;
		document.cookie = "action=E";
	
		getRequest("AJAXactions.php", testFunc, testFunc);
	}
}

function addRecord()
{
        document.getElementById("form").style.display = "block";
	document.getElementById("form").style.backgroundColor = "#99FFFF";
	
	document.getElementById("form1").value = "";
	document.getElementById("form2").value = "";
	document.getElementById("form3").value = "";
	document.getElementById("priority1").childNodes[1].checked = false;
	document.getElementById("priority2").childNodes[1].checked = false;
	document.getElementById("priority3").childNodes[1].checked = true;
	document.getElementById("priority4").childNodes[1].checked = false;
	document.getElementById("priority5").childNodes[1].checked = false;
}

function closeForm()
{
	document.getElementById("form").style.display = "none";
}

function upvoteRecord(event)
{
	console.log("Upvote detected.");

	var date = event.target.parentNode.parentNode.childNodes[1].innerHTML;
	var subject = event.target.parentNode.parentNode.childNodes[3].innerHTML;
	var desc = event.target.parentNode.parentNode.childNodes[5].innerHTML;
	event.target.parentNode.parentNode.childNodes[11].innerHTML = (Number(event.target.parentNode.parentNode.childNodes[11].innerHTML )+ 1);

	document.cookie = "date=" + date;
	document.cookie = "subject=" + subject;		//Save date, subject and description value into cookie so PHP can acces it
	document.cookie = "description=" + desc;

	document.cookie = "action=L";

	getRequest("AJAXactions.php", testFunc, testFunc);
}

function editRecord(event)
{
	console.log("Edit detected.");
	var mult = (event.target.parentNode.parentNode.childNodes.length == 7 ? 0:1);
	var date = event.target.parentNode.parentNode.childNodes[0 + (1 * mult)].innerHTML;
	var subject = event.target.parentNode.parentNode.childNodes[1 + (2 * mult)].innerHTML;
	var desc = event.target.parentNode.parentNode.childNodes[2 + (3 * mult)].innerHTML;
	
	var dateTemp = date;

	dateTemp = formatDate(dateTemp, "D. M. Y to Y-M-D");
	//dateTemp = "2018-10-20";
	
	document.getElementById("form").style.display = "block";
	document.getElementById("form").style.backgroundColor = "#99FEFE";
	
	document.getElementById("form1").value = dateTemp;
	document.getElementById("form2").value = subject;
	document.getElementById("form3").value = desc;
	
	switch(event.target.parentNode.bgColor)
	{
		case "#FF8888":
			document.getElementById("priority1").childNodes[1].checked = true;
			break;
		case "#FFCC88":
			document.getElementById("priority2").childNodes[1].checked = true;
			break;
		case "#FFFF77":
			document.getElementById("priority3").childNodes[1].checked = true;
			break;
		case "#88EE88":
			document.getElementById("priority4").childNodes[1].checked = true;
			break;
		case "#9999FF":
			document.getElementById("priority5").childNodes[1].checked = true;
			break;
	}
	document.cookie = "date=" + date;
	document.cookie = "subject=" + subject;		//Save date, subject and description value into cookie so PHP can acces it
	document.cookie = "description=" + desc;
	
	row = event.target.parentNode.parentNode;
	//Form has been displayed. After submitting data will be processed in newRecord function
}

function removeRecord(event)
{
	console.log("Delete detected.");

	if(confirm("Opravdu chcete smazat tento záznam? Tato akce je nevratná!"))
	{
		var date = event.target.parentNode.parentNode.childNodes[1].innerHTML;
		var subject = event.target.parentNode.parentNode.childNodes[3].innerHTML;
		var desc = event.target.parentNode.parentNode.childNodes[5].innerHTML;
		event.target.parentNode.parentNode.parentNode.removeChild(event.target.parentNode.parentNode);

		document.cookie = "date=" + date;
		document.cookie = "subject=" + subject;		//Save date, subject and description value into cookie so PHP can acces it
		document.cookie = "description=" + desc;
		
		document.cookie = "action=D"
		
		getRequest("AJAXactions.php", testFunc, testFunc);
	}
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

function formatDate(date, direction)
{
	var year = undefined;
	var month = undefined;
	var day = undefined;
	var i = 0;
	
	
	switch(direction)
	{
		case "Y-M-D to D. M. Y":
			for(; date[i] != "-"; i++)
			{
				if(year == undefined){year = date[i];}
				else{year += date[i];}
			}
			i++;
			for(; date[i] != "-"; i++)
			{
				if(month == undefined){month = date[i];}
				else{month += date[i];}
			}
			i++;
			for(; date[i] != "-" && date[i] != undefined; i++)
			{
				if(day == undefined){day = date[i];}
				else{day += date[i];}
			}
			date = (day + ". " + month + ". " + year);
			break;
			
		case "D. M. Y to Y-M-D":
			for(; date[i] != "."; i++)
			{
				if(day == undefined){day = date[i];}
				else{day += date[i];}
			}
			i++; i++;
			for(; date[i] != "."; i++)
			{
				if(month == undefined){month = date[i];}
				else{month += date[i];}
			}
			i++; i++;
			for(; date[i] != "." && date[i] != undefined; i++)
			{
				if(year == undefined){year = date[i];}
				else{year += date[i];}
			}
			date = year + "-" + month + "-" + day;
			break;
			
		default:
			date = false;
	}
	
	return date;
}

function getDate(date, fraction)
{
	var i = 0;
	var result = undefined;
	
	switch(fraction)
	{
		case "y":
			for(i = 0; date[i] != "-"; i++)
			{
				if(result == undefined){result = date[i];}
				else{result += date[i];}
			}
			break;
		
		case "m":
			for(i = 5; date[i] != "-"; i++)
			{
				if(result == undefined){result = date[i];}
				else{result += date[i];}
			}
			break;
		
		case "d":
			for(i = 8; i < date.length; i++)
			{
				if(result == undefined){result = date[i];}
				else{result += date[i];}
			}
			break;
		
		default:
			return false;
	}
}

function testFunc(result){alert("Test succefull: " + result);}
