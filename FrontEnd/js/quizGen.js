/*
JSON reply from server
type array (each entry)
quiz_id: 112
questions: 1 2 3 4
quiz_name: Quiz1
*/

//LINK OF THE FOLLOWING GLOBALS


//=============================================================
//	GLOBALS
var getQ =  "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/getAllQuizzes.php";
// ============================================================

// functions that go into the url and get all query strings and their repective value
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

function getHTML(loc){
	ajax(loc, "POST", function(){
		if(this.readyState == 4 && this.status == 200){
			var qList = document.getElementById("loadedQuizzes");
			console.log(this.responseText)
			file = JSON.parse(this.responseText);
			for(var i=0;i<file.length;i++){
				// generate a page that will redirect to the respective quiz you click on
				qList.innerHTML+= '<a href="https://web.njit.edu/~ssd42/takeQuiz.php?exam_id=' + file[i].quiz_id + '">' + file[i].quiz_name + '</a><br>'; 				
			}
		}
	})
}

function getExam(){
	console.log("script running");
	console.log(getQueryStrings())
	getHTML(getQ);
}

window.addEventListener('load', function(){
	getExam();
})
