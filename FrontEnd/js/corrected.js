var exam = [];

function rfc3986EncodeURIComponent(str) {  
  // console.log(str);
  return encodeURIComponent(str).replace(/[!'()*]/g, escape);  
}

String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

// on grading and giving a comment
function submitExam(){

  function sendQuestion(i){

    var d = new Date();
    // console.log(d.getTime());

    studentoutput = "";
    points = "";
    var qobj = JSON.parse(exam[i][0]);
    questionid = qobj.questionid;
    console.log("Qid: "+questionid+"\ti is: "+i);      
    var testobj = exam[i][1]
    // console.log(testobj);
    // also get the code
    answer = qobj.code;

    var qpoints = parseFloat(document.getElementById("q"+i+"points").value);
    var qoverall = qobj.overall; 

    var functionName = qobj.givenFuncname;

    for(var a=0;a<testobj.length;a++){
        var tempcase = JSON.parse(testobj[a]);
        studentoutput += tempcase.gtc + ";;";
        points += tempcase.points + ";;";
    }
    studentoutput = studentoutput.slice(0, -2);
    studentoutput = studentoutput.replaceAll("'", '"');
    console.log("HEY HERE!!!!!!!!! ==>    " + studentoutput);

    points = points.slice(0, -2);
    console.log("studentoutput:" + studentoutput + "\npoints: " + points);

    var quesComment = "";
    console.log(document.getElementById('comment'+i).value);
    if(document.getElementById('comment'+i).value==""){
      quesComment = "No comment...";
    }else{
      quesComment = document.getElementById('comment'+i).value;
    }

    var temp1 = 5;
    var temp2 = 10;


    var locforbs = "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/updateTakenQuizzes.php"
    var morepost = "StudentUsername="+postname+"&QuizId="+parseInt(postquizid)+"&StudentOutput="+rfc3986EncodeURIComponent(studentoutput)+"&StudentFunc="+functionName+"&TestcasePoints="+points;
    morepost += "&StudentComment="+quesComment+"&QuestionPoints="+parseInt(qpoints)+"&QuestionId="+parseInt(questionid);
    // console.log("I got here");
    console.log(morepost);
    ajax(locforbs, "POST", function(){
      if(this.readyState == 4 && this.status == 200){
          console.log("Updating taken quizzes");
          console.log(this.responseText);
        }
    }, morepost);
    console.log(Math.round((new Date()).getTime() / 1000));
  }



    var loctosub = "";

    var postname = getQueryStrings()["pendingUser"][0];
    var postquizid = getQueryStrings()["pendingQuizzes"][0];
    var overallgrade = document.getElementById("grade-overall").value;
    var questionid = "";
    var studentoutput = "";
    var points = "";

    var answer = "";
    // for(var i=1;i<)

    var comment = "No comment...";

    if(document.getElementById("comment").value!=""){
      comment = document.getElementById("comment").value;
    }


    // this is for getting the grades of the questions and updating the overall grade
    var totalpt = 0;
    var totaloutof = 0;
    for (var i=1;i<exam.length;i++){
      var qobj = JSON.parse(exam[i][0]);
      totalpt += parseFloat(document.getElementById("q"+i+"points").value);
      totaloutof += qobj.overall;
    }
    // console.log(totalpt);
    // console.log(totaloutof);
    overallgrade = Math.round((totalpt/totaloutof)*100);
    // console.log(overallgrade);


    // console.log(exam.length);
    var timewait = 0;
    for (var i=1;i<exam.length;i++){
      setTimeout(sendQuestion, timewait, i);
      timewait+=1000;  
      // sendQuestion(i);      
    }

    var entergradesloc = "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/enterGrades.php";
    var enter_post = "StudentUsername="+postname+"&QuizId="+postquizid+"&Score="+overallgrade+"&Comment="+comment;
    console.log(enter_post);    
    ajax(entergradesloc, "POST", function(){
      if(this.readyState == 4 && this.status == 200){
        console.log("Sent to enter post grades.");
      }
    }, enter_post);
    
}


window.onload = function(){

  var bUser = getQueryStrings()["pendingUser"][0];
  var bId = getQueryStrings()["pendingQuizzes"][0];

  var mypostdata = "pendingUser="+bUser+"&pendingQuizzes="+bId;

  var m2idcorrect = "https://web.njit.edu/~aa944/download/490/TESTS/gradeQuizzes.php";
  // var midcorrect = "https://web.njit.edu/~aa944/download/490/TESTS/json.php";
  var midcorrect = "https://web.njit.edu/~aa944/download/490/TESTS/gradeQuizzes.php";

  ajax(midcorrect, "POST", function(){
    if(this.readyState == 4 && this.status == 200){
      // console.log(JSON.parse(this.responseText));
      // console.log(this.responseText);
      exam = JSON.parse(this.responseText);
      console.log(exam);
      var maindata  = JSON.parse(exam[0]);
      console.log(maindata);
      // console.log("\'"+exam.substring(1,exam[0]-1)+"\'")


      document.getElementById("exFuncname").innerHTML = maindata.examname;
      document.getElementById("studentName").innerHTML = maindata.studentname;

      // this is useless
      // then remove it
      // im afraid it will break something eventhough im not calling it anywhere
      var question = document.getElementById("q1");

      var fieldset = document.getElementById("questions");
      for (var j=1;j<exam.length;j++){
        // load each individual item as an obj
        var qobj = JSON.parse(exam[j][0]);

        var funcPoints = 0;
        var funcsym = "";
        if (qobj.exFuncname == qobj.givenFuncname){
          funcPoints = 1;
          funcsym =  "<span style='color:green'>&#10004;</span>";
        }else{
            funcsym = "<span style='color:red'>&#10006;</span>";
        }
        // console.log(qobj.code.split("\n").join("<br>"));
        var aQuestion = `
            <div id="qData"><br>
            <b style="font-weight:bold;">Question <span>`+j+`.</b>` + qobj.text+ `</span><br>
              <div id="info"  style="padding-left:25px;">
              <fieldset style="border:2px solid grey;border-radius:2px;width:50%;">
              <h4>Your code: </h4><span id="yourcode" style="padding-left:15px;white-space: pre-wrap;">`+qobj.code.split("\n").join("<br>")+`</span><br>
              <div class="titles"><h4>Function Name:</h4></div>
              <div style="padding-left:25px;">
              `+funcsym+` Expected <span id="expFunc">`+qobj.exFuncname+`</span> and 
              you wrote <span id="yourFunc">`+qobj.givenFuncname+`</span>. <br>
              <span style='color:transparent'>&#10006;</span> Earned <span id="earned">`+funcPoints+`</span> out of <span id="qtotal">`
              +1+`</span> points.
              </div>
              </fieldset>
              </div>
              <div id="q1"></div> 
            </div>
            
            <br>
      `;
        var tcCount = 1;
      
        var testobj = exam[j][1]

        aQuestion += '<div border:2px ;border-radius:12px;"><h4>TestCases:</h4>';
        
        // generate table head
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
        aQuestion+= tablehead;

        // this generates each question
        for(var i=0;i<testobj.length;i++){

          var tempcase = JSON.parse(testobj[i]);

          var rightwrong = tempcase.points==tempcase.outof;
          var symbol = "";
          // getting the writght / wrong symbol right
          if(rightwrong){
            symbol =  "<span style='color:green'>&#10004;</span>";
          }else{
            symbol = "<span style='color:red'>&#10006;</span>";
          }

          var arow = `
            <tr>
              <td> ` + tempcase.tc + `</td>
              <td> ` + tempcase.gtc + `</td>
              <td> ` + tempcase.ans + `</td>
              <td> ` + tempcase.points + "/" + tempcase.outof + `</td>
              <td> ` + symbol + ` </td
            </tr>
          `;

          // var text = symbol + " We've passed in values <span>" + tempcase.tc + "</span> and got <span>" + tempcase.gtc + "</span> with the answer being  <span>" + tempcase.ans + "</span> giving you <span>" + tempcase.points + "</span> points out of <span>" + tempcase.outof +"</span><br>";
          // aQuestion+=text;       
          aQuestion+=arow;    
        }
        aQuestion+="</tbody></table>";
        // aQuestion+="</div>";


        var qgrade = 5;
        var outofg = 10;

        var qpoints = qobj.given;
        var qoverall = qobj.overall;

        var qGrade = `<br><div>
        <h3>
        Question Grade:   <span>`+'<input type="text" class="qpoints" name="qpoints" id="q'+j+'points" value="'+Math.floor(qpoints)+'">' +`</span>/`+qoverall+`
        </h3>
        </div>
        `;

        aQuestion += qGrade;
        fieldset.innerHTML+=aQuestion;
        fieldset.innerHTML+= `<br><textarea placeholder="Leave feedback." rows="10" cols="85" id="comment`+j+`" name="comment" style="resize:none;overflow: auto;"></textarea>`; 
      }
      var totapt = 0;
      var totaoutof = 0;
      for (var i=1;i<exam.length;i++){
        var qobjj = JSON.parse(exam[i][0]);
        totapt += parseFloat(document.getElementById("q"+i+"points").value);
        totaoutof += qobjj.overall;
        // console.log(totapt);
      }
      var tempoverall = Math.round((totapt/totaoutof)*100);
      document.getElementById("overall-grade-span").innerHTML = 'Overall Grade <input type="text" name="grade-overall" id="grade-overall" value="'+tempoverall+'"">';
    }
  }, mypostdata);  
  console.log(mypostdata);
}
