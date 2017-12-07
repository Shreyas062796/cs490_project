var username;


// this is repeated clean up later
function getUser(){
	var loc = 'getUser.php'
	ajax(loc, 'POST', function(){
		if(this.readyState == 4 && this.status == 200){
			console.log(this.responseText);
			username =  this.responseText;
		}
	});
}

function checkUsername(){
	if(typeof(username) == 'undefined') return;
	clearInterval(username);
}


function getTableData(loc, insertArea, aUser){
	var postdata = "StudentUserName="+aUser+"&call=getStudentGrade";
	console.log(postdata)

	ajax(loc, 'POST', function(){
		if(this.readyState == 4 && this.status == 200){
			file = JSON.parse(this.responseText);
			console.log(this.responseText);
			// file.pop(file.length-1); // remove the null from the end
			// wordbank = file;
			console.log(file.length);
			// insertArea.innerHTML = "";

			var table = document.getElementById("gotText");
			var tableBody = table.getElementsByTagName("tbody")[0];
			var amount = file.length;

			for(var i=0;i<amount;i++){

				var row = tableBody.insertRow(i);

				var grade = row.insertCell(0);
				var qzid = row.insertCell(1);
				var data = row.insertCell(2);
				grade.innerHTML = file[i].Grade;
				qzid.innerHTML = file[i].Quiz;

				var newbutton = '<button id="correctButton"  type="button" onclick="correctExam(this.value);" value='+file[i].Quiz+'>More Info</button>'

				data.innerHTML = newbutton;
			}
		}
	}, postdata);
}

function correctExam(anId){

	var backloc = "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/checkStudentGrades.php";
	var postdata = "QuizId="+anId+"&StudentUsername="+username;

	var page = window.location.href;
	var qstrings = "?quizid="+anId+"&user="+username;

	window.location.href = page+qstrings;
}

// gets the table in
function insertInitial(){
	var dtable = `
	<div class="table-title"><h3>My Grades</h3></div>
		<table border="1" id="gradeTable" class="table-fill">
			<thead>
				<tr>
				<th>Grade</th>
				<th>Quiz ID</th>
				<th></th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	`
	document.getElementById('gotText').innerHTML = dtable;
}

// loads the more info data to insert into 
function loadTemplate(some_div){
	var stdCor = "templates/studentCorrected.html";
	ajax(stdCor, "GET", function(){
		if(this.readyState == 4 && this.status == 200){
			some_div.innerHTML = this.responseText;
		}
	})
}

// generate a quiz for the student to check from post data
function getTaken(some_user, some_id, some_div){
	var sloc  = "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/checkStudentGrades.php";
	var params = "QuizId="+some_id+"&StudentUsername="+some_user;

	ajax(sloc, "POST", function(){
		if(this.readyState == 4 && this.status == 200){
			// ok so you get the json object now parse it
			// and say what you're doing

			var json_exam = JSON.parse(this.responseText);
			// for learning what to call
			for(var i=0; i<json_exam.length; i++){
				console.log(json_exam[i]); 
			}

			// start up the static data
			document.getElementById("exFuncname").innerHTML = json_exam[1].quiz_name;
			document.getElementById("studentName").innerHTML = json_exam[0].StudentUsername;
			document.getElementById("comment").innerHTML = json_exam[0].Comment;
			document.getElementById("overall-grade-span").innerHTML = 'Overall Grade: ' + json_exam[0].Grade;

			// data from arra 1
			var quesiton_points = json_exam[1].question_pts.split(" ");

			// for each question 
			var fieldset = document.getElementById("questions");
			for (var j=0;j<json_exam[2].length;j++){
		
			  	//question info
			  	var funcname = json_exam[2][j].FuncName;
			  	// var qpoints = question_points[3][j];
			  	var qtext = json_exam[2][j].Question;

			  	//student quesiton info
			  	var student_ans = json_exam[3][j].StudentAnswer;
			  	var student_func = json_exam[3][j].StudentFunc;
			  	var studentoutput = json_exam[3][j].StudentOutput;
			  	var question_points = json_exam[3][j].QuestionPoints;

			  	var funcsym = "x";

			  	var truepoints = json_exam[2][j].StudentFunc==json_exam[2][j].FuncName;
			  	var points = 0;
			  	if(truepoints){
			  		points=5
			  	}

			  	var funcPoints = 0;
		        var funcsym = "";
		        if (student_func == funcname){
		          funcPoints = 1;
		          funcsym =  "<span style='color:green'>&#10004;</span>";
		        }else{
		            funcsym = "<span style='color:red'>&#10006;</span>";
		        }



			  	// console.log(json_exam[2][j].StudentAnswer);

// +json_exam[3][j].StudentAnswer

				var aQuestion = `
					<div id="qData"><br>
					<b style="font-weight:bold;">Question <span>`+(j+1)+`.</b>` + qtext+ `</span><br>
					  <div id="info"  style="padding-left:25px;">
					  <fieldset style="border:2px solid grey;border-radius:2px;width:50%;">
					  <h4>Your code: </h4><span id="yourcode" style="white-space: pre-wrap;">`+student_ans.split("\n").join("<br>")+`</span><br>
					  <div class="titles"><h4>Function Name:</h4></div>
					  <div style="padding-left:25px;">
					  `+funcsym+` Expected <span id="expFunc">`+funcname+`</span> and 
					  you wrote <span id="yourFunc">`+student_func+`</span>. <br>
					  <span style='color:transparent'>&#10006;</span> Earned <span id="earned">`+funcPoints+`</span> out of <span id="qtotal">`
					  +1+`</span> points.
					  </div>
					  </fieldset>
					  </div>
					  <div id="q1"></div> 
					</div>
					<br>
					`;

			 //  	var aQuestion = `
			 //      <div id="qData"><br>
			 //      Question `+(j+1)+`.<br> 
			 //        Question: ` + json_exam[2][j].Question + ` <br>
			 //        Your code: <span id="yourcode">`+`</span><br>
			 //        Expected Function name <span id="expFunc">`+json_exam[2][j].FuncName+`</span> |
			 //        Your Function name <span id="yourFunc">`+json_exam[3][j].StudentFunc+`</span> |
			 //        Earned <span id="earned">`+points+`</span> out of <span id="qtotal">`
			 //        +4+`</span> possible points.
			 //        <br>
			 //        <div id="q1"></div> 
			        
			 //      <div>
			      
			 //      <br>
				// `;


				var mymobj = json_exam[2][j];
				// console.log(mymobj);

				// this loop through this later
				var testcases = json_exam[2][j].Testcases;
				console.log(testcases);

				var firstTc = testcases.split(";;");
				// console.log(firstTc.split("-"));

				var cases = []
				var anss = []

				for(var i=0; i<firstTc.length;i++){
					var base = firstTc[i].split("-")
					cases.push(base[0]);
					anss.push(base[1]);
					// console.log(cases);
					// console.log(anss);	
				}				

				console.log("testcasepoints: " + json_exam[3][j].TestCasePoints + "  testcaseoutput: " + json_exam[2][j].Testcases);

				var testcasepoints = json_exam[3][j].TestCasePoints.split(";;");
				var testcaseoutput = json_exam[2][j].Testcases.split(";;")

				var studentoutput = json_exam[3][j].StudentOutput.split(";;");

				var tablehead = `
			        <table border="1" id="testcasetbl" class="table-fill" style="margin:inherit";>
			        <thead>
			          <tr>
			            <th> Input  </th>
			            <th> Your Output </th>
			            <th> Answer </th>
			            <th> Points </th>
			            <th> Marked </th>
			        </thead>
			        <tbody>
			        `;

			    aQuestion+=tablehead;


				for(var k=0; k< firstTc.length; k++){

					var symbol = "";
					var an_output = testcaseoutput[k].split('-')[1];
					// getting the writght / wrong symbol right
					if(an_output==studentoutput[k]){
						symbol =  "<span style='color:green'>&#10004;</span>";
					}else{
						symbol = "<span style='color:red'>&#10006;</span>";
					}
					var ppoins = 0;
					if(truepoints){
						ppoins=5;
					}

					var arow = `
			            <tr>
			              <td> ` + cases[k] + `</td>
			              <td> ` + studentoutput[k] + `</td>
			              <td> ` + anss[k] + `</td>
			              <td> ` + testcasepoints[k] + "/" + "1" + `</td>
			              <td> ` + symbol + ` </td
			            </tr>
			          `
			        aQuestion+=arow;
					// var text = symbol + " We've passed in values <span>" + cases[k] + "</span> and got <span>" + studentoutput[k] + "</span> with the answer being  <span>" + anss[k] + "</span> giving you <span>" + testcasepoints[k] + "</span> points out of <span>1</span><br>";
					// aQuestion+=text;  
				}
				aQuestion+="</tbody></table><br>";

			  	var question_comment = json_exam[3][j].QuestionComment;
			  	if(question_comment==null){
			  		question_comment="No comment...";
			  	}

			  	var comment_area = `
					<div>
					<h4>Question`+(j+1)+` comment: </h4>
					`+question_comment+`<br>

			  	`
			  	aQuestion+= comment_area;

			  	var hispoints = json_exam[1].question_pts.split(" ");
			  	// console.log(hispoints);
				var ovQgrade = json_exam[3][j].Graded;
				var qGrade = `<br><div>
					<h3>
						Question `+(j+1)+` Grade:   <span>`+ json_exam[3][j].QuestionPoints +`</span>/`+hispoints[j]+`
					</h3>
					</div>
					
					<br>`;
				aQuestion+=qGrade;

				document.getElementById("questions").innerHTML += aQuestion;
			}
			// some_div.innerHTML += this.responseText;
		}
	} ,params);
}


window.onload = function getMyGrades(){
	var location = "https://web.njit.edu/~aa944/download/490/TESTS/controller.php";
	// var location =  "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/getStudentGrade.php";

	var has_query = getQueryStrings()['quizid']==undefined;
	var adiv = document.getElementById("gotText");

	// page handling
	if(has_query){
		insertInitial();
		
		username = getUser();
		setTimeout(function(){
			getTableData(location, adiv, username);
		}, 200)
	}
	else if (!has_query) {	
		
		loadTemplate(adiv);

		var Buser = getQueryStrings()['user'][0];
		var Bquizid = getQueryStrings()['quizid'][0];

		setTimeout(getTaken, 150, Buser, Bquizid, adiv);

		// getTaken(Buser, Bquizid, adiv);

		// adiv.innerHTML="<h1>Ya done fucked up mate</h1>";
	}
}