var recordCount = 0;

window.onload = function ()
{
	var addRecord = document.getElementById("addRecord");
	
	document.getElementById("addRecord").onclick = function addRecord()
	{
		document.getElementById("form").style.display = "block";
	}
}
	
	function newRecord(evt){
		evt.preventDefault();
		recordCount++;
		document.getElementById("form").style.display = "none";
		document.getElementById("home").style.height = ((recordCount * 56) + 60) + "px";
		
		var records = document.getElementById("data");
		var rw = document.createElement("tr");
		var date = document.createElement("td");
		var dateText = document.createTextNode(document.getElementById("form1").value);
		var subject = document.createElement("td");
		var subjectText = document.createTextNode(document.getElementById("form2").value);
		var description = document.createElement("td");
		var descriptionText = document.createTextNode(document.getElementById("form3").value);
		var author = document.createElement("td");
		var authorText = document.createTextNode("author");
		var dateOfAdding = document.createElement("td");
		var dateOfAddingText = document.createTextNode("adding");
		var action = document.createElement("td");
		var actionText = document.createTextNode("Edit");
	
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
		
		rw.appendChild(date);
		rw.appendChild(subject);
		rw.appendChild(description);
		rw.appendChild(author);
		rw.appendChild(dateOfAdding);
		rw.appendChild(action);
		
		records.appendChild(rw);
	}