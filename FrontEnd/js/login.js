/*
Going out in post form
username -> the persons username
password -> the persons password
type -> whether it is a student or an instructor     (REMOVE AT A LATER POINT)

NOTE: The 'call' post value for (the backend) is being generated in the login.php file
// this is exclusive to the login page
*/


//=============================================================
//	GLOBALS

var myback = 'login.php';  // this is exclusivly for the login page
var mainpage = 'user.php'; // this is the page that redirects to the specific user
var sess_check = 'session.php'; // variable that checks if a session has been created

//=============================================================

// checks the type the user has chose for it to be checked againts the DB
function checkType(){
	if(document.getElementById("amTeacher").checked){
		return "teacher";
	}else return "student";
}

// what happens when you click the login button
function startPost(){
	//reset the reply so you get a blank area to update
	document.getElementById("reply1").innerHTML = '';
	// getters
	var username = document.getElementById("Username").value;
	var password = document.getElementById("Password").value;
	// var type = checkType();

	// generate the POST reply
	var reply = "username="+username+"&password="+password+"&type=0"+"&cmd=login";

	// function to execute on post request
	var todo = function(){
		//if there is a reply
		if(this.readyState==4 && this.status==200){
			dPrint(this.responseText);
			var return_data = this.responseText;
	        // var reply = this.responseText.substring(0, return_data.length-3)
	        var reply = return_data.trim();

	        if (reply.toLowerCase() == "successful"){
	        	// code that loads to the session.php and loads the main page
	        	window.location.href="user.php";
	        }
	        else if (reply.toLowerCase() == "failed") {
	        	document.getElementById("reply1").innerHTML = "Incorrect username password combination"
	        }else if(username=="" || password==""){
	        	// this should not be shown, that means the backend isnt properly handling it
	        	document.getElementById("reply1").innerHTML = "One or more fields are missing parameters"
	        }else{
				document.getElementById("reply1").innerHTML = "Username Password combo does not exist";	        	
	        }
		}
	};
	ajax(myback, "POST", todo, reply);
}

// on load checks if in the login page and if a session has started redirect to main page
window.addEventListener('load', function(){
	ajax(sess_check, "POST", function(){
		// if a session has been created redirect to the main page
		if(this.readyState == 4 && this.status == 200) {
	    	if(this.responseText=="set"){
    			window.location.href=mainpage;
	    	}
	    }
	});
})