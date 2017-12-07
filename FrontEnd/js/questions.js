// Steven Dias for the generate quiz page
// GLOBALS
questionNum=1; // for the index of grabbing questions and putting them in quiz

//=============================================================
//	GLOBALS
var midController = "https://web.njit.edu/~aa944/download/490/TESTS/controller.php";
var backController = "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/AddQuestions.php"; //REMOVE THIS WORK WITH MIDDLE CONTROLLER WHEN GIVEN THE CHANCE
var filterQ = "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/filterQuestions.php"; //REMOVE THIS WORK WITH MIDDLE CONTROLLER WHEN GIVEN THE CHANCE
var questHtml = "templates/createQ.html";
var wordbank = [];
var examField =[];
// =============================================================

for(var a=0;a<wordbank.length;a++){
	console.log(wordbank[a]);
}


//====TABLE CONTROLS=====
var tableStart=0; //index of where to start readding questions
var incAmount = 5; // amount to increment

function emptyTable(){

	// console.log("tableStart:"+tableStart+"  incAmount:"+incAmount);

	var dtable = document.getElementById("qTable");
	var tableBody = dtable.getElementsByTagName("tbody")[0];
	tableBody.innerHTML = inputinto();
	// console.log("got here");
	// tableBody = inputinto();
}

function inputinto(atable){
	var out = "";

	console.log(wordbank);
	for(var i=tableStart;i<tableStart+incAmount;i++){
		// generates an entry for every item in the table
		try{
			var addition = `
			<tr>
			<td>`+wordbank[i].QuestionId+`</td>
    		<td>`+wordbank[i].Question+`</td>
    		<td>`+difficulty(wordbank[i].Difficulty)+`</td>
    		<td>`+wordbank[i].QuestionType+`
  			</tr>
  			`;
			out+=addition;
		}
		catch(e){
			continue;
		}
	}
	return out
}


function moveLeft(){
	var banksize = wordbank.length;
	// console.log(banksize);
	// catch if you cant go any more to the left
	if(tableStart==0){
		return;
	}

	tableStart-=5
	emptyTable();
}

function moveRight(){
	var banksize = wordbank.length;
	// console.log(banksize);
	if(tableStart+5 > banksize){
		return;
	}


	tableStart+=5;
	emptyTable();
}



//=============================
//		SORTING

var numdiff = "all";
var atype = "all";


function sortAll(){
	var call = "call=loadAllQuestions";
	ajax(midController, "POST", function() {
		if (this.readyState == 4 && this.status == 200) {
			wordbank = JSON.parse(this.responseText);		
			emptyTable();
		}
	}, call);
}


function sortDiff(diffy){
	console.log(diffy);
	// emptyTable();
	// var dtable = document.getElementById("qTable");
	// var tableBody = dtable.getElementsByTagName("tbody")[0];
	// tableBody.innerHTML = "";

	numdiff = diffy.toLowerCase();

	if(numdiff=="all"&&atype=="all"){
		sortAll();
		return;
	}

	var pdata;
	if(numdiff=="all"){
		pdata = "QuestionType="+atype;
	}else{
		numdiff = reverseDiff(diffy);

		pdata = "Difficulty="+numdiff;

		if(atype!="all"){
			pdata += "&QuestionType="+atype;
		}
	}

	

	ajax(filterQ, "POST", function(){
		if(this.readyState == 4 && this.status == 200){
			console.log(pdata);
			console.log(this.responseText);

			wordbank = JSON.parse(this.responseText)
			emptyTable();
		}
	},pdata);
}

function sortType(intype){
	console.log(intype);

	atype = intype;

	if(numdiff=="all"&&atype=="all"){
		sortAll();
		return;
	}

	var pdata;
	if(intype=="all"){
		pdata="Difficulty="+numdiff;

	}else{
		pdata = "QuestionType="+atype;

		if(numdiff!="all"){
			pdata += "&Difficulty="+numdiff;
		}
	}

	ajax(filterQ, "POST", function(){
		if(this.readyState == 4 && this.status == 200){
			console.log(pdata);
			console.log(this.responseText);

			wordbank = JSON.parse(this.responseText)
			emptyTable();
		}
	},pdata);

}





// ============================



//=======================


// difficulty checker
function difficulty(anum){
	var difficulty = ["Easy", "Medium", "Hard"];
	return difficulty[anum-1];
}

function reverseDiff(adiff){
	var val = 0;
	var difficulty = ["Easy", "Medium", "Hard"];
	for(var i=0;i<difficulty.length;i++){
		if (adiff==difficulty[i]){
			return (i+1);
		}
	}
}






//=========================

// loads initial table into an empty table
function loadQuestions(){
	// table header for the tables being loaded from the db	
	// i really need to fix this
	var table = `
		<div class="table-title"><h3>Question Bank</hr></div>
		<table border="1" id="qTable" class="table-fill">
		<thead>
		<tr>
		<th>id</th>
		<th>Question</th>
		<th>Difficulty</th>
		<th>Type</th>
		</tr>
		</thead>
		<tbody>
	`;
	var all = wordbank.lenth;
	var mount = 5;

	table += inputinto();
	table+= "</tbody></table>";

	// the the buttons that allow you to move
	table+=`
	<div id="change-button" style="float: right;">
		<button onclick="moveLeft();" type="button" class="moveleft" id="moveleft"> \<\< </button>
		<button onclick="moveRight();" type="button" class="moveright" id="moveright"> \>\> </button>
	</div>
	<br>
	`;

	return table;
}


//===JOINT=====
function leave(){
	document.getElementById("workArea").innerHTML="";
}

function check_if_in_db(a_id){
	for(var i=0;i<wordbank.length;i++){
		if(wordbank[i].QuestionId==a_id){return true;}
	}
	return false;
}

// what actually adds to the table
function tableAdd(table, id){
	// find the item that matches the id
	// parse and get the id and the question string
	// add it to the obj that is created when this page is created

	var item;

	// find the item
	for(var i=0;i<wordbank.length;i++){
		if(wordbank[i].QuestionId == id){
			item = wordbank[i];
			break;
		}
	}

	var tableBody = table.getElementsByTagName("tbody")[0];

	var row = tableBody.insertRow(questionNum-1);
	
	var q_num = row.insertCell(0);
	var q_id = row.insertCell(1);
	var q_str = row.insertCell(2);
	var q_points = row.insertCell(3);
	
	q_num.innerHTML = questionNum;
	q_id.innerHTML = item.QuestionId;
	q_str.innerHTML = item.Question;
	q_points.innerHTML = '<input type="text" id="' + item.QuestionId+'points" style="width:30px;">';

	// console.log(item.QuestionId);
	// console.log(item.Question);


	questionNum++;
}



//function will add to the table to be displayed and will add to the obj as well
// this is all done based on question id
function addToTable(){
		//work on

	var notice = document.getElementById("workarea-notice");
	var area = document.getElementById("workArea");
	var questionId = document.getElementById("questionID");
	var exam = document.getElementById("theExam");

	// reset values
	notice.innerHTML = "";

	// check if user passed anything and add it to table if it exists
	if(questionId && questionId.value){
		//code that inputs it into the table
		// check if it is in the table before failing it
		if(check_if_in_db(questionId.value)){ 
			tableAdd(exam, questionId.value);
			
		}else{
			document.getElementById("workarea-notice");
			notice.innerHTML = "<p style='color:red;'>Could not find ID, try another</p>";
		}
	}
	else{
		document.getElementById("workarea-notice");
		notice.innerHTML = "<p style='color:red;'>Please enter a valid number</p>";
	}

}


function addQuestionId(){

	var RWMode = 0; //read/write mode

	var textSpace = `
	<fieldset>
	<label for="QuestionId">ID</label>
	<input autocomplete="off" type="text" id="questionID" placeholder="question ID here" size="20">
	<button onclick="addToTable();" type="button" id="addToExam">Add</button>
	<button onclick="leave();" type="button" id="leave">Leave</button>
	<div id="workarea-notice"></div>
	</fieldset>
	`
	//ADD CODE THAT ADDS IT TO THE TABLE

	

	var area = document.getElementById("workArea");

	area.innerHTML= textSpace;

}
//===ENDJOINT====


//===========JOIN FOR ORIGINAL QUESTION ====================

function addAQuestion(){
	var area = document.getElementById("workArea");
	getHTML(questHtml, area);
}




//===========END JOINT =====================================


// will grab the questions that were generated and post them to the controller to be then
// sent to the middle to go to the back and there it will be stored in the db
function createQuiz(){
	// loop through tbody and get all of the ids,
	// send it to php where i grab the session username, and there
	// send it to back to be stored as a exam everyone can take

	var qids = [];
	var qpoints = [];

	var quiztable = document.getElementById("theExam");
	console.log(quiztable)
	var rowLength = quiztable.rows.length;

	for(var i=1;i<rowLength; i++) {

		var tCells = quiztable.rows.item(i).cells;
		var cellLength = tCells.length-1;
		for (var j = 1; j<cellLength; j++) {
			// console.log(tCells.item(j).innerHTML);
			qids.push(tCells.item(j).innerHTML);
			document.getElementById(tCells.item(j).innerHTML);
			tCells.item(j).innerHTML
		}  
	}
	console.log(qids);

	var qzname= document.getElementById("quizname").value;
	var strar = "";
	var pointStr = ""
	for(var k=0; k<qids.length; k+=2){
		strar+= qids[k] + " ";
		
		pointStr+= document.getElementById(qids[k]+"points").value + " "; 
	}
	strar = strar.slice(0, -1);
	pointStr = pointStr.slice(0, -1);

	
	var newquiz = "call=createQuizzes&quizname="+qzname+"&Questions="+strar+"&QuestionPts="+pointStr;
	console.log(newquiz);
	// AJAX 
	ajax(midController, "POST", function() {
		if (this.readyState == 4 && this.status == 200) {
			console.log(this.responseText);
			var noti = document.getElementById("submit-notice");
			noti.innerHTML='<p style="color:Black">Quiz has been created</p>'; // this shouldn't be created here
		}
	}, newquiz);

	console.log(qzname);
	console.log(strar);
}

// whole function is messed up right now
function addQuestion(){

	var tempdata = [];
  	for(var i=1;i<questionNum+1;i++){
    	var item = "q"+i;
    	tempdata[i-1] = "" + document.getElementById(item).value;
    	console.log(document.getElementById(item).value);
	}

	var exam = document.getElementById("examQ"); //examlist
	questionNum+=1; // increment the quesiton count
	var newline = '<br><br><label>Q'+questionNum+'.  </label><input autocomplete="off" type="text" id="q'+questionNum+'" placeholder="Question"/>'

	exam.innerHTML+= newline;
	// go to all the ones before and 
	for(var j=1;j<questionNum;j++){
    	// console.log(tempdata[j-1]);
    	var item = "q"+j;
    	document.getElementById(item).value = ""+tempdata[j-1];    		
    	if(document.getElementById(item).value){
	    	// document.getElementById(item).value = ""+tempdata[j-1];   
	    	console.log("it has a value"); 		
    	}else{
	    	document.getElementById(item).placeholder="Question";

    	}
	}

}
// function will ad a question to the db and reply a id
function submitQuestion(){

	var call = "newQuestion"
	var funcName = document.getElementById("newQues").value;
	var argNum = document.getElementById("argsAmount").value;
	// argNum = argNum.options[argNum.selectedIndex].text

	var newExplanation = "";
	newExplanation = "Write a function named " + funcName + " that takes in " + argNum + " arguments, and " + document.getElementById("newExplanation").value + ".";
	// newExplanation = newExplanation.replace('+', '%2B'); temp leave out check if lib works

	newExplanation = preparePost(newExplanation);

	// getters
	var tc1 = document.getElementById("testcase1").value;
	var tc2 = document.getElementById("testcase2").value;
	var tc3 = document.getElementById("testcase3").value;

	var type1 = document.getElementById("testcase1-inType").value;
	var type2 = document.getElementById("testcase2-inType").value;
	var type3 = document.getElementById("testcase3-inType").value;

	var a1 = document.getElementById("answer1").value;
	var a2 = document.getElementById("answer2").value;
	var a3 = document.getElementById("answer3").value;

	// POSTDATA
	var quizpost = "call="+call+"&FunctionName="+funcName+"&Question="+newExplanation+"&Testcase1="+tc1+"&Testcase2="+tc2+"&Testcase3="+tc3+"&Type1="+type1+"&Type2="+type2+"&Type3="+type3+"&Answer1="+a1+"&Answer2="+a2+"&Answer3="+a3;

// 	THIS IS AJAX NOW
	ajax(backController, "POST", function() {
		if (this.readyState == 4 && this.status == 200) {
			// display message
			var noti = document.getElementById("submit-notice");
			noti.innerHTML='<p style="color:Black">Question has been added to the DB</p>';
			console.log(this.responseText);
		}
	}, quizpost);
}

function done(){
	var area = document.getElementById("workArea");
	area.innerHTML= "";	
}

function createQuestion(){

	ajax("templates/createQ.html", "GET", function(){
		if (this.readyState == 4 && this.status == 200) {

			var area = document.getElementById("workArea");
			area.innerHTML= this.responseText;	
		}
	});
}

// on page load it gets the questions from the question bank in the db
window.onload = function loadData(){
	// call requestion to get questions for the teacher
	var call = "call=loadAllQuestions";

	ajax(midController, "POST", function() {
		var wordbankhtml = document.getElementById("qBank")
		if (this.readyState == 4 && this.status == 200) {
			// console.log(this.responseText);
			var file = JSON.parse(this.responseText);
			wordbank = file; // set the global
			wordbankhtml.innerHTML=loadQuestions();
		}
	}, call);
}
