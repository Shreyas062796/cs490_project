/* vanilla js is allowed here... yeah work with it */

// document.getElementById("login-button").addEventListener("onclick", function(){
//   console.log("asadasan");
// 	// document.getElementById("status").textContent='Login status is';
// 	// document.getElementById("#login-message").innerHTML = "<br> <p>Login status</p>";
// 	var cred = getCredentials();
// });
// var xhr = new XMLHttpRequest();


// function getCredentials(){
//   const user = {
//     username: document.querySelector("#username").value
//   };
  
//   console.log(user.username);
//   return user;
// };

// ignore this for now this was just a test function.
// function welcome(){
// 	var username = document.getElementById("Username").value;
// 	var password = document.getElementById("Password").value;
// 	console.log(username);
// 	console.log(password);

// 	document.getElementById("Username").value="";
// 	document.getElementById("Password").value=""	;

// 	document.getElementById("login-message").innerHTML="<br> <p>Awaiting to log in</p>";
// }


function checkType(){
	if(document.getElementById("amTeacher").checked){
		return "teacher";
	}else return "student";
}


function startPost(){

	//reset it 
	document.getElementById("reply1").innerHTML = '';
	// document.getElementById("reply2").innerHTML = '';

	var httpR = new XMLHttpRequest();

	var form = 'index.php';

	var username = document.getElementById("Username").value;
	var password = document.getElementById("Password").value;
	var type = checkType();

	// console.log(type);

	// console.log(username+":"+password);

	// var reply = "username="+username+"&password="+password+"&type="+type+"&cmd=login";
	var reply = "username="+username+"&password="+password+"&type="+type+"&cmd=login";

	httpR.open("POST", form, true);
	httpR.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	
	httpR.onreadystatechange = function() {
    	// console.log(httpR);

	    if(httpR.readyState == 4 && httpR.status == 200) {
	        var return_data = httpR.responseText;
	        console.log(httpR.responseText);
	        var reply = httpR.responseText.substring(0, return_data.length-2)
	        console.log(reply);
	        // console.log(reply+":"+"successful");

	        if (reply.toLowerCase() == "successful"){
	        	// code that loads to the session.php and loads the main page
	        	document.getElementById("reply1").innerHTML = "You're in";
	        	window.location.href="user.php";

	        }
	        else if (reply.toLowerCase() == "failed") {
	        	document.getElementById("reply1").innerHTML = "Incorrect username password combination"
	        }else{
	        	// this should not be shown, that means the backend isnt properly handling it
	        	document.getElementById("reply1").innerHTML = "One or more fields are missing parameters"
	        }





	        // document.getElementById("login-message").innerHTML = return_data;

	        //new code

	        // var unpacked = return_data;
	  //       var json_array = return_data.split("-");


	        
			
			

			// // console.log(unpacked);
			// // console.log(d_json);
			
			// var back = JSON.parse(json_array[0]);
			// var middle = JSON.parse(json_array[1])




	  //       if(back['name'] == 'NJIT'){
		 //        if(back['reply'] == '1'){
			// 	    document.getElementById("reply2").innerHTML = 'Password for NJIT is correct';
			// 	    document.getElementById("reply2").style.color = 'green';
			// 	}else if (back['reply'] == '0') {
			// 	    document.getElementById("reply2").innerHTML = 'Password for NJIT is incorrect';
			// 	    document.getElementById("reply2").style.color = 'red';
			// 	}	        
			// }

	  //       //end of new node
	  //       if(middle['name'] == 'backend'){
		 //        if(middle['reply'] == '1'){
			// 	    document.getElementById("reply1").innerHTML = 'Password for DB is correct';
			// 	    document.getElementById("reply1").style.color = 'green';
			// 	}else if (middle['reply'] == '0') {
			// 	    document.getElementById("reply1").innerHTML = 'Password for DB is incorrect';
			// 	    document.getElementById("reply1").style.color = 'red';
			// 	}	        
			// }


			// document.getElementById("reply2").innerHTML = 'Password for NJIT is wrong';
		 //    document.getElementById("reply2").style.color = 'red';







		    // console.log(unpacked);

	    }
	}

	httpR.send(reply);
	// document.getElementById("login-message").innerHTML="<br> <p> Trying </p>";
}














// document.getElementById("login-button").addEventListener("onclick", function(){
  

// 	// document.getElementById("status").textContent='Login status is';
// 	// document.getElementById("#login-message").innerHTML = "<br> <p>Login status</p>";
	
// });