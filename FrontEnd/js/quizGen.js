// WORK ON: This needs a post request to get the quiz out of the DB

window.onload = function generateQuiz(){

	// create a new div
	var div = document.createElement('div');

	// and give it an empy string to hold()
	div.innerHTML = "";

	for(var i=0;i<questions.length;i++){

		console.log(questions[i].question);
		// generate the question
		div.innerHTML +=  "<br>" + "Q" + (i+1)+ "    " + questions[i].question + "<br>";
		// auto generate ids for the textfields
		div.innerHTML += "<textarea autocomplete='off' placeholder='answer' rows='7' cols='40'" + "id='answer"+ (i+1)  + "'" + "></textarea>" + "<br>";
	}
	document.getElementById("something").appendChild(div);	
};
