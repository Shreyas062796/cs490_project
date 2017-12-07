var pending = [];

function correctPending(){

	// var loc = "https://web.njit.edu/~aa944/download/490/TESTS/controller.php";
	var loc = "https://web.njit.edu/~aa944/download/490/TESTS/gradeQuizzes.php";
	xhttp = new XMLHttpRequest();
	xhttp.open("POST", loc, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	console.log(pending);

	// for usernames
	var pUsername = "";
	for(var i=0; i<pending.length;i++){
		pUsername+=pending[i].username +"-";
	}

	//for quiz ids
	var pQuizzes = "";
	for(var j=0; j<pending.length;j++){
		pQuizzes+=pending[j].quiz_id + "-";
	}



	var upstreamData = "call=gradeQuizzes&pendingUser="+pUsername.substring(0, pUsername.length-1)+"&pendingQuizzes="+pQuizzes.substring(0, pQuizzes.length-1);
	console.log(upstreamData);

	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			console.log(this.responseText);
			
			if(this.responseText.toLowerCase().slice(-2) == "ok"){
				console.log("last 2 characters array");
				var table = document.getElementById("releaseGrades");

				var tableBody = table.getElementsByTagName("tbody")[0];
				tableBody.innerHTML = "";
				document.getElementById("reply-from-pending").innerHTML = "All exams have been corrected.";
			
				// 	// this is for reloading the table adding the new grade
				// var table = document.getElementById("gotText");
				// console.log(table);
				// var tableBody = table.getElementsByTagName("tbody")[0];
				// tableBody.innerHTML = "";
				// console.log(tableBody.innerHTML);

				// var mid_controller = "https://web.njit.edu/~aa944/download/490/TESTS/controller.php"; 

				// var adiv = document.getElementById("gotText");
				// getHTML(mid_controller, adiv);
			}


		}
	}
	xhttp.send(upstreamData);
}




function getPending(loc, insertArea){
	xhttp = new XMLHttpRequest();

	var call = "call=getTakenQuizzes";

	xhttp.open("POST", loc, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			console.log(this.responseText);
			file = JSON.parse(this.responseText);
			// file.pop(file.length-1); // remove the null from the end
			console.log(file);
			pending = file;


			// begining of table loading
			var table = document.getElementById("releaseGrades");

			// var tableBody = table.getElementsByTagName("tbody")[0];
			var amount = file.length;

			// insertArea.innerHTML = '<button onclick="correctPending();" type="button" class="correct-quiz" id="correct-quiz">Correct Pending</button><br>';
			for(var i=0;i<amount;i++){

				// get the row you want to insert in
				var row = tableBody.insertRow(i);

				//get the cells you want to insert into the row
				var student = row.insertCell(0);
				var qzid = row.insertCell(1);

				student.innerHTML = file[i].username;
				qzid.innerHTML = file[i].quiz_id;

				// insertArea.innerHTML += file[i].username + " - "+ file[i].quiz_id  +"<br>";
			}
		}
	}
	xhttp.send(call);
}




function getHTML(loc, insertArea){
	xhttp = new XMLHttpRequest();

	var call = "call=getAllGrades"


	xhttp.open("POST", loc, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			file = JSON.parse(this.responseText);
			console.log(this.responseText);
			// file.pop(file.length-1); // remove the null from the end
			// wordbank = file;
			console.log(file);
			// insertArea.innerHTML = "";
			var table = document.getElementById("gotText");
			console.log(table);
			var tableBody = table.getElementsByTagName("tbody")[0];

			var amount = file.length;

			for(var i=0;i<amount;i++){

				// get the row you want to insert in
				var row = tableBody.insertRow(i);

				//get the cells you want to insert into the row
				var student = row.insertCell(0);
				var qzid = row.insertCell(1);
				var comment = row.insertCell(2);
				var agrade = row.insertCell(3)

				student.innerHTML = file[i].StudentUsername;
				qzid.innerHTML = file[i].Quiz;
				comment.innerHTML = file[i].Comment;
				agrade.innerHTML = file[i].Grade;


				// insertArea.innerHTML += file[i].StudentUsername + " - "+ file[i].Grade + " - " + file[i].Quiz +"<br>";
			}
			// refresh the grades table after that


		}
	}
	xhttp.send(call);
}


var sloc  = "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/checkStudentGrades.php";
var params = "QuizId=1234&StudentUsername=sr594";

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
	document.getElementById('getText').innerHTML = dtable;
}





window.onload = function getGrades(){
	var locationForAll =  "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/getAllGrades.php";
	var locationForPending = "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/getTakenQuizzes.php";

	var mid_controller = "https://web.njit.edu/~aa944/download/490/TESTS/controller.php"; 
	console.log(getQueryStrings());
	// insertInitial();

	var adiv = document.getElementById("gotText");
	getHTML(mid_controller, adiv);

	var bdiv = document.getElementById("releaseGrades");
	getPending(mid_controller, bdiv);



	ajax(sloc, 'POST' , function(){
		if(this.readyState==4 && this.status==200){
			// var tester = document.getElementById("tester");
			// tester.innerHTML = this.responseText;
	
			console.log(this.responseText);
		}
	}, params);

}	