
var questions = [
	{
		id: "12213",
		question: "Write a funciton that outputs even numbers in a range"
	},
	{
		id: "54324",
		question: "Use list compreehension"
	},
	{
		id: "33244",
		question: "another question"
	}

];

window.onload = function generateQuiz(){

	// create a new div
	var div = document.createElement('div');

	// and give it an empy string to hold()
	div.innerHTML = "";

	for(var i=0;i<questions.length;i++){

		// console.log(questions[i].question);
		// generate the question
		div.innerHTML +=  "<br>" + "Q" + (i+1)+ "    " + questions[i].question + "<br>";
		// auto generate ids for the textfields
		div.innerHTML += "<textarea autocomplete='off' placeholder='answer' rows='7' cols='40'" + "id='answer"+ (i+1)  + "'" + "></textarea>" + "<br>";
	}
	document.getElementById("something").appendChild(div);	
};

function submitQuiz(){

	the_answers = []

	// the_answers[0] should be the username of the person to save it into the database


	for(var i = 0; i < questions.length; i++){
		// generate the id for each answer
		var ans_id = "answer"+(i+1)
		//get the answer reply
		var an_answer = document.getElementById(ans_id).value;

		//generate the array that is to be returned to the middle

		//add username to this json so it can be saved under that person

		the_answers.push({id: questions[i].id, answer: an_answer});
	}
	// we now have an array with all of the answer and id's
	console.log(the_answers);

	//now turn to json
	var jsonAns = JSON.stringify(the_answers);
	console.log(jsonAns);

};





// console.log(questions);

// function onLoad(){
// 	const output = [];

// 	var htmlstuff = "";

// 	// console.log(questions[0].question);

// 	//for each question...
// 	questions.forEach( function(ques, qNum) {
// 		// statements
// 		// quizContainer.innerHTML += ques.question;
// 		console.log(questions[qNum].question);
// 		htmlstuff += '<input autocomplete="off" type="text" id="answer" placeholder="answer"/>'

// 	});
// 	document.getElementById("something").innerHTML = htmlstuff;
// };





// window.onload = function loadFrom(){

// 	var href = 'quizGen.html'

// 	var xmlhttp = new XMLHttpRequest();
// 	xmlhttp.open("GET", href, true);
// 	xmlhttp.send();



// 	document.getElementById('aquiz').innerHTML = xmlhttp.responseText;
// 	// return xmlhttp.responseText;
// };


// function startPost(){
  

//   var a = ['are?', 'asdasda?', '3324?'];

//   // for (i = 0; i < a.length; i++) { 
    
  

//   // };






//   var pass = document.getElementById('answer').value;
//   document.getElementById('abc').innerHTML = pass;




// }




// onLoad();




// function startUp(){
	
// 	var a = ['are?', 'asdasda?', '3324?'];

// 	// var table = document.createElement('table');


// }


