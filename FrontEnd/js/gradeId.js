var username;



function getUser(){

	var loc = 'getUser.php'
	xhttp = new XMLHttpRequest();
	xhttp.open("POST", loc, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			console.log(this.responseText);
			username =  this.responseText;
		}
	}
	xhttp.send();


}

function checkUsername(){
	if(typeof(username) == 'undefined') return;
	clearInterval(username);
}


function getHTML(loc, insertArea, aUser){
	xhttp = new XMLHttpRequest();

	xhttp.open("POST", loc, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


	// var postdata = "Type=getByID&StudentUserName="+getUser();
	
	var postdata = "StudentUserName="+aUser+"&call=getStudentGrade";
	console.log(postdata)

	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			file = JSON.parse(this.responseText);
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

				grade.innerHTML = file[i].Grade;
				qzid.innerHTML = file[i].Quiz;


				// insertArea.innerHTML +=  file[i].Grade + " "+ file[i].Quiz + "<br>";
			}
		}
	}
	xhttp.send(postdata);
}

function getfunc(){

}

window.onload = function getMyGrades(){
	var location = "https://web.njit.edu/~aa944/download/490/TESTS/controller.php";
	// var location =  "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/getStudentGrade.php";
	var adiv = document.getElementById("gotText");
	username = getUser();
	setTimeout(function(){
		getHTML(location, adiv, username);
	}, 200)
}