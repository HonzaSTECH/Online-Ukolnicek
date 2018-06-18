window.onload = function (){
	var addRecord = document.getElementById("addRecord");
	var formSubmit = document.getElementById("formSubmit");
	
    addRecord.onclick = function addRecord(){
		document.getElementById("form").style.display = "block";
	}
}
function newRecord(){
	alert("Success!");
	document.getElementById("form").style.display = "none";
	
	let records = document.getElementById("data");
	let rw = document.createElement("tr");
	let date = document.createElement("td");
	let dateText = document.createTextNode("0.0.0000");//document.getElementById("form1").innerHTML
	let subject = document.createElement("td");
	let subjectText = document.createTextNode("VV");//document.getElementById("form2").innerHTML
	let description = document.createElement("td");
	let descriptionText = document.createTextNode("Desc");//document.getElementById("form3").innerHTML
	let author = document.createElement("td");
	let authorText = document.createTextNode("author");
	let dateOfAdding = document.createElement("td");
	let dateOfAddingText = document.createTextNode("adding");
	let action = document.createElement("td");
	let actionText = document.createTextNode("Upvote Downvote Edit");

	date.appendChild(dateText);
	subject.appendChild(subjectText);
	description.appendChild(descriptionText);
	author.appendChild(authorText);
	dateOfAdding.appendChild(dateOfAddingText);
	action.appendChild(actionText);
	
	rw.appendChild(date);
	rw.appendChild(subject);
	rw.appendChild(description);
	rw.appendChild(author);
	rw.appendChild(dateOfAdding);
	rw.appendChild(action);
	
	records.tbody.appendChild(rw);
	
	}
