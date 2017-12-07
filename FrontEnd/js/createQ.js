
//====================================================
// GLOBALS
testcaseNum=1;

var testcaseLoc = "templates/testcase.html";
var backController = "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/AddQuestions.php"; //REMOVE THIS WORK WITH MIDDLE CONTROLLER WHEN GIVEN THE CHANCE

//====================================================

// general functions overwrittten to easily remove divs

Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for(var i = this.length - 1; i >= 0; i--) {
        if(this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
}

function addTestCase(){
	ajax(testcaseLoc, "GET", function(){
		var testId = document.getElementById("testcases");
		if(this.readyState==4&&this.status==200){
			var reply = this.responseText;

			// now give it it's own unique id
			reply = reply.split("{}").join(testcaseNum);
			// console.log(reply);
			testId.innerHTML+=reply;
			testcaseNum+=1;
		}
	});
}

function removeTestcase(anId){
	console.log(anId);

	var theDiv = "tc"+anId;

	var toRemove = document.getElementById(theDiv);


	toRemove.remove();

}

function submitQuestion(){
	var funcName = document.getElementById("newQues").value;
	if (!funcName){
		var noti = document.getElementById("submit-notice");
		noti.innerHTML='<p style="color:Black">Please add a title.</p>';

	}else{
		submitQuestionExtra();
	}
}


function changeDiff(adiff){
	var vals = ["easy", "medium", "hard"];
	var count = 0;
	for(var i=0;i<vals.length;i++){
		console.log("The selected diff is: "+adiff);
		if(adiff==vals[i]){
			return (i+1);
		}
	}
	return 1;
}

console.log("starting up");

function submitQuestionExtra(){

	var call = "newQuestion"
	var funcName = document.getElementById("newQues").value;
	var argNum = document.getElementById("argsAmount").value;

	var newExplanation = "";
	newExplanation = "Write a function named " + funcName + " that takes in " + argNum + " arguments, and " + document.getElementById("newExplanation").value + ".";

	var qdifficulty = document.getElementById("question-dif").value;	
	var qtype = document.getElementById("question-type").value;	

	// var qd = qdifficulty.options[qdifficulty.selectedIndex].value;

	// now get all of the testcases
	var testcases = "";
	var answer = "";
	var final = "";
	for (var i=1; i<(testcaseNum+1);i++){
		try{
			testcases= document.getElementById("testcase"+i).value;
			answer= document.getElementById("answer"+i).value;
			final += testcases+"-"+answer+";;";
			// console.log(document.getElementById("testcase"+i).value);
			// console.log(document.getElementById("answer"+i).value);
		}catch(e){
			continue;
		}
	}
	// testcases = testcases.slice(0,-1);
	// answer = answer.slice(0,-2);

	console.log(final)
	final = final.slice(0,-2);


	// console.log(testcases);
	// console.log(answer);

	var quizpost = "call="+call+"&FunctionName="+funcName+"&Question="+newExplanation+"&Testcases="+final;
	quizpost += "&Difficulty="+changeDiff(qdifficulty.toLowerCase())+"&QuestionType="+qtype;

	console.log(quizpost);

	ajax(backController, "POST", function() {
		if (this.readyState == 4 && this.status == 200) {
			// display message
			var noti = document.getElementById("submit-notice");
			noti.innerHTML='<p style="color:Black">Question has been added to the DB</p>';
			console.log(this.responseText);
		}
	}, quizpost);
	loadQuestions();
}

