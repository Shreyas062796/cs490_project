// COMMON FUNCTION LIBRARY TO REDUCE THE AMOUNT OF CODE NEEDED IN THE OTHER JS FILES


// General function for ajax post/get requests 
/*
location -> is the location of the file you are sending it to
sentType -> which for now will be just POST/GET
toDoFunc -> will be the code to be executed once a reply is received
postData -> the post array as a string to be send, also with the call for the controller
*/


// Function just outputs a message if in DEBUG mode
DEBUG = true;
function dPrint(outmsg){
	if(DEBUG==true){
		console.log(outmsg);
	}
}


function ajax(location, sendType, toDoFunc, postData=null){
	// initialization
	xhttp = new XMLHttpRequest();
	xhttp.open(sendType, location, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.onreadystatechange = toDoFunc; // the function to execute on getting a reply

	if(postData!=null){
		xhttp.send(postData);
	}else{
		xhttp.send();
	}
}



// retrieves query strign from the url for ajax to then use to query exam id to get the questions
function getQueryStrings(){
  var queryString = window.location.search || '';
  var keyValPairs = [];
  var params      = {};
  queryString     = queryString.substr(1);

  if (queryString.length){
  keyValPairs = queryString.split('&');
   for (pairNum in keyValPairs){
      var key = keyValPairs[pairNum].split('=')[0];
      if (!key.length) continue;
      if (typeof params[key] === 'undefined')
         params[key] = [];
      params[key].push(keyValPairs[pairNum].split('=')[1]);
    }
  }
  return params;
}



// function is to properly parse through the post string and 
// save it to the db, for now only '+' has an error more will come
function preparePost(poststring){
	var plusFix = poststring.replace('+', '%2B'); // post doesnt allow plus

	// there is more NOTE: READ ABOUT IT

	return plusFix;
}
	// this could be an alternative
	// an_answer = an_answer.replace(/\r?\n/gm, '<br/>');

// function will insert data using a get requestion into a location
// try to use it as a template
function getHTML(loc, insertArea){
	ajax(loc, "GET",  function(){
		if(this.readyState == 4 && this.status == 200){
			// console.log(this.responseText);
			insertArea.innerHTML = this.responseText;
		}
	});
}


// Need a function that will update tables work on that later






