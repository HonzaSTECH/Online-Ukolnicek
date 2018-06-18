window.onload = function (){
	var addRecord = document.getElementById("addRecord");
	
    addRecord.onclick = function addRecord(){
		var records = document.getElementById("data");
		var rw = document.createElement("tr");
		var date = document.createElement("td");
		var dateText = document.createTextNode("date");
		var subject = document.createElement("td");
		var subjectText = document.createTextNode("subject");
		var description = document.createElement("td");
		var descriptionText = document.createTextNode("description");
		var author = document.createElement("td");
		var authorText = document.createTextNode("author");
		var dateOfAdding = document.createElement("td");
		var dateOfAddingText = document.createTextNode("adding");
		var action = document.createElement("td");
		var actionText = document.createTextNode("Upvote Downvote Edit");
	
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
			
		records.appendChild(rw);
	}
}