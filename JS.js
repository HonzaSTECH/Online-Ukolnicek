var recordCount = 0;
var recordPriority;
var recordColor;
var date;
var i;

window.onload = function ()
{
	var addRecord = document.getElementById("addRecord");
	
	document.getElementById("addRecord").onclick = function addRecord()
	{
		document.getElementById("form").style.display = "block";
	}
	
	document.getElementById("formCancel").onclick = function closeForm()
	{
		document.getElementById("form").style.display = "none";
	}
	
	document.getElementsByClassName("action1").onclick = function upvoteRecord(event)
	{
		console.log("Upvoted");
	}
	document.getElementsByClassName("action2")[0].onclick = function editRecord(event)
	{
		console.log("Editted");
	}
	document.getElementsByClassName("action3")[0].onclick = function removeRecord(event)
	{
		console.log("Deleted");
		
		var yCursor = event.pageY;
		yCursor -= "px";
		yCursor -= 60;
		yCursor /= 66;
		yCursor -= 1;
		document.getElementById("data").removeChild(document.getElementsByClassName("action1")[yCursor]);
	}
}

	function newRecord(evt){
		evt.preventDefault();
		recordCount++;
		document.getElementById("form").style.display = "none";
		document.getElementById("home").style.height = ((recordCount * 66) + 60) + "px";
		
		date = new Date();
		
		recordPriority = (document.querySelector('input[name="priority"]:checked').value);
		switch(recordPriority){
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
		
/*	D */var dateWork = document.getElementById("form1").value;
/*	A */
/*	T */var year;
/*	E */var month;
/*	  */var day;
/*	G */i=0;
/*	E */
/*	T */for(; dateWork[i] != "-"; i++){
/*	T */	if(year == undefined){year = dateWork[i];}
/*	I */	else{year += dateWork[i];}
/*	N */}
/*	G */i++;
/*	  */for(; dateWork[i] != "-"; i++){
/*	A */	if(month == undefined){month = dateWork[i];}
/*	N */	else{month += dateWork[i];}
/*	D */}
/*	  */i++;
/*	C */for(; dateWork[i] != "-" && dateWork[i] != undefined; i++){
/*	O */	if(day == undefined){day = dateWork[i];}
/*	N */	else{day += dateWork[i];}
/*	V */}
/*	E */dateWork = (day + ". " + month + ". " + year);
/*	R */
/*	T */var today = (date.getDate() + ". " + (date.getMonth()+1) + ". " + date.getFullYear());

		var records = document.getElementById("data");
		var rw = document.createElement("tr");
		var date = document.createElement("td");
		var dateText = document.createTextNode(dateWork);
		var subject = document.createElement("td");
		var subjectText = document.createTextNode(document.getElementById("form2").value);
		var description = document.createElement("td");
		var descriptionText = document.createTextNode(document.getElementById("form3").value);
		var author = document.createElement("td");
		var authorText = document.createTextNode(document.getElementById("form4").value);
		var dateOfAdding = document.createElement("td");
		var dateOfAddingText = document.createTextNode(today);
		var action = document.createElement("td");
		var actionButton1 = document.createElement("button");
		var actionButton1Text = document.createTextNode("Like");
		var actionButton2 = document.createElement("button");
		var actionButton2Text = document.createTextNode("Edit");
		var actionButton3 = document.createElement("button");
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
		action.appendChild(actionButton1);
		action.appendChild(actionButton2);
		action.appendChild(actionButton3);
		
		date.className = "column1";
		subject.className = "column2";
		description.className = "column3";
		author.className = "column4";
		dateOfAdding.className = "column5";
		action.className = "column6";
		
		date.style.backgroundColor = recordColor;
		subject.style.backgroundColor = recordColor;
		description.style.backgroundColor = recordColor;
		author.style.backgroundColor = recordColor;
		dateOfAdding.style.backgroundColor = recordColor;
		action.style.backgroundColor = recordColor;
		
		rw.appendChild(date);
		rw.appendChild(subject);
		rw.appendChild(description);
		rw.appendChild(author);
		rw.appendChild(dateOfAdding);
		rw.appendChild(action);
		
		records.appendChild(rw);
	}