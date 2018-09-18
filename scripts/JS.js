var recordCount = 0;
var recordPriority;
var recordColor;
var recordUpvotes = new Array(0);
var date;
var i;
var yCursor;

function newRecord(event)
{
	event.preventDefault();
	document.getElementById("form").style.display = "none";
	
	recordPriority = (document.querySelector('input[name="priority"]:checked').value);
	switch(recordPriority)
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
	
	var duplicate = false;
	
/*	    */date = new Date();
/*    D */var dateWork = document.getElementById("form1").value;
/*    A */
/*    T */var year;
/*    E */var month;
/*      */var day;
/*    G */i=0;
/*    E */
/*    T */for(; dateWork[i] != "-"; i++){
/*    T */    if(year == undefined){year = dateWork[i];}
/*    I */    else{year += dateWork[i];}
/*    N */}
/*    G */i++;
/*      */for(; dateWork[i] != "-"; i++){
/*    A */    if(month == undefined){month = dateWork[i];}
/*    N */    else{month += dateWork[i];}
/*    D */}
/*      */i++;
/*    C */for(; dateWork[i] != "-" && dateWork[i] != undefined; i++){
/*    O */    if(day == undefined){day = dateWork[i];}
/*    N */    else{day += dateWork[i];}
/*    V */}
/*    E */dateWork = (day + ". " + month + ". " + year);
/*    R */
/*	  */
/*    T */var today = (date.getDate() + ". " + (date.getMonth()+1) + ". " + date.getFullYear());
	
	if(document.getElementById("form").style.backgroundColor == "rgb(153, 254, 254)")
	{
		duplicate = true;
	}
	else 
	{
		for(i=1; i<=recordCount; i++)
		{
			if(document.getElementsByClassName("column2")[i].innerText == document.getElementById("form2").value && document.getElementsByClassName("column1")[i].innerText == dateWork)
			{
				duplicate = true;
				yCursor = i;
				break;
			}
		}
	}
    if(duplicate == false)
	{
		var records = document.getElementById("data");
		
		var rw = document.createElement("tr");
		var date = document.createElement("td");
		var subject = document.createElement("td");
		var description = document.createElement("td");
		var author = document.createElement("td");
		var dateOfAdding = document.createElement("td");
		var likes = document.createElement("td");
		var action = document.createElement("td");
		var actionButton1 = document.createElement("button");
		var actionButton2 = document.createElement("button");
		var actionButton3 = document.createElement("button");
		
		var dateText = document.createTextNode(dateWork);
		var subjectText = document.createTextNode(document.getElementById("form2").value);
		var descriptionText = document.createTextNode(document.getElementById("form3").value);
		var authorText = document.createTextNode(document.getElementById("form4").value);
		var dateOfAddingText = document.createTextNode(today);
		var likesText = document.createTextNode("0");
		var actionButton1Text = document.createTextNode("Like");
		var actionButton2Text = document.createTextNode("Edit");
		var actionButton3Text = document.createTextNode("Delete");
	
		actionButton1.appendChild(actionButton1Text);
		actionButton1.className = "action1";
		actionButton2.appendChild(actionButton2Text);
		actionButton2.className = "action2";
		actionButton3.appendChild(actionButton3Text);
		actionButton3.className = "action3";
		
		date.appendChild(dateText);
		subject.appendChild(subjectText);
		description.appendChild(descriptionText);
		author.appendChild(authorText);
		dateOfAdding.appendChild(dateOfAddingText);
		likes.appendChild(likesText);
		action.appendChild(actionButton1);
		action.appendChild(actionButton2);
		action.appendChild(actionButton3);
		
		date.className = "column1";
		subject.className = "column2";
		description.className = "column3";
		author.className = "column4";
		dateOfAdding.className = "column5";
		likes.className = "column6";
		action.className = "column7";
		
		date.style.backgroundColor = recordColor;
		subject.style.backgroundColor = recordColor;
		description.style.backgroundColor = recordColor;
		author.style.backgroundColor = recordColor;
		dateOfAdding.style.backgroundColor = recordColor;
		likes.style.backgroundColor = recordColor;
		action.style.backgroundColor = recordColor;
		
		rw.appendChild(date);
		rw.appendChild(subject);
		rw.appendChild(description);
		rw.appendChild(author);
		rw.appendChild(dateOfAdding);
		rw.appendChild(likes);
		rw.appendChild(action);
		
		var next;
		for(i = 0; i < records.childNodes.length; i++)
		{
			next = records.childNodes[i];
			date = next.childNodes[1].innerHTML;
			
			var dateTemp = date;
			var yearT=undefined;
			var monthT=undefined;
			var dayT=undefined;
			i=0;
			
			for(; dateTemp[i] != "."; i++)
			{
				if(day == undefined){day = dateTemp[i];}
				else{day += dateTemp[i];}
			}
			i++; i++;
			for(; dateTemp[i] != "."; i++)
			{
				if(month == undefined){month = dateTemp[i];}
				else{month += dateTemp[i];}
			}
			i++; i++;
			for(; dateTemp[i] != "." && dateTemp[i] != undefined; i++)
			{
				if(year == undefined){year = dateTemp[i];}
				else{year += dateTemp[i];}
			}
			if(yearT < year || (monthT < month && yearT == year) || (dayT < day && monthT == month && yearT == year)){break;}
		}
		
		records.insertBefore(rw, next);
		//records.appendChild(rw);
		
		document.getElementsByClassName("action1")[recordCount].onclick = upvoteRecord;
		document.getElementsByClassName("action2")[recordCount].onclick = editRecord;
		document.getElementsByClassName("action3")[recordCount].onclick = removeRecord;
		
		recordUpvotes[recordCount]=0;
		
		if(recordCount == 0){document.getElementById("noRecord").style.display = "none";}
		recordCount++;
		
		//TODO
		getRequest("AJAXnewRecord.php", testFunc, testFunc);
	}
	else
	{
		console.log("Duplicate");
		//alert("Ve Vámi zadaný den je již písemka z tohoto předmětu zadána. Daný záznam byl tedy upraven dle Vámi zadaných dat jakožto duplikát.");
		document.getElementsByTagName("tr")[yCursor ].childNodes[1].innerHTML = dateWork;
		document.getElementsByTagName("tr")[yCursor ].childNodes[3].innerHTML = document.getElementById("form2").value;
		document.getElementsByTagName("tr")[yCursor ].childNodes[5].innerHTML = document.getElementById("form3").value;
		document.getElementsByTagName("tr")[yCursor ].childNodes[1].style.backgroundColor = recordColor;
		document.getElementsByTagName("tr")[yCursor ].childNodes[3].style.backgroundColor = recordColor;
		document.getElementsByTagName("tr")[yCursor ].childNodes[5].style.backgroundColor = recordColor;
		document.getElementsByTagName("tr")[yCursor ].childNodes[7].style.backgroundColor = recordColor;
		document.getElementsByTagName("tr")[yCursor ].childNodes[9].style.backgroundColor = recordColor;
		document.getElementsByTagName("tr")[yCursor ].childNodes[11].style.backgroundColor = recordColor;
		document.getElementsByTagName("tr")[yCursor ].childNodes[13].style.backgroundColor = recordColor;
		
		document.cookie = "newDate=" + document.getElementById("form1").value;
		document.cookie = "newSubject=" + document.getElementById("form2").value;
		document.cookie = "newDescription=" + document.getElementById("form3").value;		//Saving new values into cookies so PHP can access it
		document.cookie = "newPriority=" + recordPriority;
		document.cookie = "action=E";

		getRequest("AJAXphp.php", testFunc, testFunc);
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
	var VH = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
	yCursor = event.pageY;
	yCursor -= 0.123 * VH;				//Substract header
	yCursor /= 0.102 * VH;				//Get record position
	yCursor = Math.floor(yCursor);		//Round the result down

	var date = document.getElementsByTagName("tr")[yCursor].childNodes[1].innerHTML;
	var subject = document.getElementsByTagName("tr")[yCursor].childNodes[3].innerHTML;
	var desc = document.getElementsByTagName("tr")[yCursor].childNodes[5].innerHTML;
	document.getElementsByTagName("tr")[yCursor].childNodes[11].innerHTML = (Number(document.getElementsByTagName("tr")[yCursor].childNodes[11].innerHTML )+ 1);
	//TODO

	document.cookie = "date=" + date;
	document.cookie = "subject=" + subject;		//Save date, subject and description value into cookie so PHP can acces it
	document.cookie = "description=" + desc;

	document.cookie = "action=L";

	getRequest("AJAXphp.php", testFunc, testFunc);
}

function editRecord(event)
{
	console.log("Edit detected.");
	var VH = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
	yCursor = event.pageY;
	yCursor -= 0.123 * VH;				//Substract header
	yCursor /= 0.102 * VH;				//Get record position
	yCursor = Math.floor(yCursor);		//Round the result down
	
	var date = document.getElementsByTagName("tr")[yCursor].childNodes[1].innerHTML;
	var subject = document.getElementsByTagName("tr")[yCursor].childNodes[3].innerHTML;
	var desc = document.getElementsByTagName("tr")[yCursor].childNodes[5].innerHTML;
	
	var dateTemp = date;
	var year=undefined;
	var month=undefined;
	var day=undefined;
	i=0;
	
	for(; dateTemp[i] != "."; i++)
	{
		if(day == undefined){day = dateTemp[i];}
		else{day += dateTemp[i];}
	}
	i++; i++;
	for(; dateTemp[i] != "."; i++)
	{
		if(month == undefined){month = dateTemp[i];}
		else{month += dateTemp[i];}
	}
	i++; i++;
	for(; dateTemp[i] != "." && dateTemp[i] != undefined; i++)
	{
		if(year == undefined){year = dateTemp[i];}
		else{year += dateTemp[i];}
	}
	dateTemp = year + "-" + month + "-" + day;
	
	document.getElementById("form").style.display = "block";
	document.getElementById("form").style.backgroundColor = "#99FEFE";
	
	document.getElementById("form1").value = dateTemp;
	document.getElementById("form2").value = subject;
	document.getElementById("form3").value = desc;
	
	switch(document.getElementsByTagName("tr")[yCursor].childNodes[1].bgColor)
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
	
	//Form has been displayed. After submitting data will be processed in newRecord function
}

function removeRecord(event)
{
	console.log("Delete detected.");

	if(confirm("Opravdu chcete smazat tento záznam? Tato akce je nevratná!"))
	{
		var VH = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
		yCursor = event.pageY;
		yCursor -= 0.123 * VH;				//Substract header
		yCursor /= 0.102 * VH;				//Get record position
		yCursor = Math.floor(yCursor);		//Round the result down

		var date = document.getElementsByTagName("tr")[yCursor].childNodes[1].innerHTML;
		var subject = document.getElementsByTagName("tr")[yCursor].childNodes[3].innerHTML;
		var desc = document.getElementsByTagName("tr")[yCursor].childNodes[5].innerHTML;
		document.getElementsByTagName("tr")[yCursor].parentNode.removeChild(document.getElementsByTagName("tr")[yCursor]);
		//TODO

		document.cookie = "date=" + date;
		document.cookie = "subject=" + subject;		//Save date, subject and description value into cookie so PHP can acces it
		document.cookie = "description=" + desc;
		
		document.cookie = "action=D"
		
		getRequest("AJAXphp.php", testFunc, testFunc);
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

function testFunc(result){alert("Test succefull: " + result);}