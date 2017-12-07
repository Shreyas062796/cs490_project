// NOTES:
//	For the data i will recieve array[0] info about the exam
// 	and array[1] contains an array of the questions data



//=============================================================
//	GLOBALS

var questions = []; // obj that will hold the questions and their order
var user; // initialize so the function can change
var userLoc = 'getUser.php' // location of file that will check the user session 
var midController =  "https://web.njit.edu/~aa944/download/490/TESTS/controller.php";


// =============================================================



// simple ajax request to get the current user since there is no way to easily do it in js
function getUser(changeVal){
	var username;
	ajax(userLoc, "POST", function(){
		if(this.readyState == 4 && this.status == 200){
			user =  this.responseText;
		}
	});
}


// creates a table and then adds it to a div
function createQHtml(contents, quizname, point_arr){
	var div = document.createElement("div");
	div.innerHTML = ""; // initialize the html portion

	// var quizname = contents[0].quiz_name;
	div.innerHTML += "<h1>" +  quizname + "</h1><br><br>"; // header in a sense

	for(var i=0; i<contents.length; i++){
				// generate the question
		div.innerHTML +=  "<br>" + "<h3>Q" + (i+1)+  "\t("+ point_arr[i] +" Points)" + "</h3> " + ' <p style="display:inline" class="theQues">' + contents[i].Question + "</p><br><br>";
		// auto generate ids for the textfields
		div.innerHTML += "<textarea autocomplete='off' placeholder='answer' rows='10' cols='80'" + "id='answer"+ (i+1)  + "'" + "></textarea>" + "<br>";
	}
	return div;
}

// function that will retrieve the array that will display the questions
function getQuestions(quizId){
	var postdata = "quizId="+quizId+"&call=getQuizzes"; //call variable needed to post to get quiz ids

	ajax(midController, "POST", function(){
		if(this.readyState == 4 && this.status == 200){
			console.log(this.responseText);
			file = JSON.parse(this.responseText);
			document.getElementById("something").appendChild(createQHtml(file[1], file[0].quiz_name, file[0].question_pts.split(" ")));
			questions = file; // set the global to the reply
		}
	}, postdata);
}

// sends student quiz to database this is the post action
function postQuiz(postdata){

	postdata+="&call=enterTakenQuizzes"
	// var corrected = postdata.replace('+', '%2B');
	var corrected = postdata;
	// corrected = encodeURIComponent(corrected);

	var backController = "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/enterTakenQuizzes.php"

	console.log(corrected);
	ajax(backController, "POST", function(){
		if(this.readyState == 4 && this.status == 200){
			console.log(this.responseText);
		}
	},corrected);
	var text = "<br><br><h3>Exam has been submitted</h3>";
	document.getElementById("submitted").innerHTML = text;
}


function rfc3986EncodeURIComponent (str) {  
	console.log(str);
    return encodeURIComponent(str).replace(/[!'()*+-/]/g, escape);  
}

// this is the generate action
// function that creates the form for when the user is done with his/her exam they can send the grades to be retrieved
function submitQuiz(){
	// console.log("User is ==> "+user);
	var exam_id = questions[0].quiz_id;
	the_answers = []

	// the_answers[0] should be the username of the person to save it into the database
	for(var i = 0; i < questions[1].length; i++){
		// generate the id for each answer
		var ans_id = "answer"+(i+1);
		//get the answer reply
		var an_answer = document.getElementById(ans_id).value;
		// console.log(an_answer);
		the_answers.push({question_id: parseInt(questions[1][i].QuestionId), answer: an_answer});
	}

	for(var i=0;i<questions[1].length;i++){
		var ans_id = "answer"+(i+1);
		var an_answer = document.getElementById(ans_id).value.toString();
	
		// setting up the post string
		var postReturn =  "StudentUsername="+user+"&QuizId="+exam_id+"&QuestionId="+questions[1][i].QuestionId+"&Answer="+rfc3986EncodeURIComponent(an_answer);

		// console.log(postReturn);
		//NOTE WHY AM I DOING THIS IN A FOR LOOP?
		postQuiz(postReturn); // sends to the next function that will send it 
	}
}

// when the page loads get the query string and get the questions for that exam
window.onload = function generateQuiz(){
	var querystr = getQueryStrings(); // get querystring from url
	getUser(user); // get the user on page load to make submitting the quizes easier
	getQuestions(querystr['exam_id']); // get the questions from the exam id, if if is in querystring
}