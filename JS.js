var recordCount = 0;
var recordPriority;
var recordColor;
var date;

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
}
	
	function newRecord(evt){
		evt.preventDefault();
		recordCount++;
		document.getElementById("form").style.display = "none";
		document.getElementById("home").style.height = ((recordCount * 56) + 60) + "px";
		
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
		}
		
		var records = document.getElementById("data");
		var rw = document.createElement("tr");
		var date = document.createElement("td");
		var dateText = document.createTextNode(document.getElementById("form1").value);
		var subject = document.createElement("td");
		var subjectText = document.createTextNode(document.getElementById("form2").value);
		var description = document.createElement("td");
		var descriptionText = document.createTextNode(document.getElementById("form3").value);
		var author = document.createElement("td");
		var authorText = document.createTextNode(document.getElementById("form4").value);
		var dateOfAdding = document.createElement("td");
		var dateOfAddingText = document.createTextNode(date.getDate);
		var action = document.createElement("td");
		var actionText = document.createTextNode("Upvote Edit Delete");
	
		date.appendChild(dateText);
		subject.appendChild(subjectText);
		description.appendChild(descriptionText);
		author.appendChild(authorText);
		dateOfAdding.appendChild(dateOfAddingText);
		action.appendChild(actionText);
		
		date.id = "column1";
		subject.id = "column2";
		description.id = "column3";
		author.id = "column4";
		dateOfAdding.id = "column5";
		action.id = "column6";
		
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