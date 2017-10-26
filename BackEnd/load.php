<?php

$StudentArr = array("sr594" => "Poaster", "obc2" => "Coolstuff", "test" => "test123", "faster" => "games", "username" => "password");

$TeacherArr = array("teacher" => "password", "professor" => "mypass", "theo" => "cs490", "coo" => "elchimang", "cass" => "Jumble");

$connection = mysqli_connect("sql2.njit.edu", "sr594","Baseball123", "sr594");

if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

$StudentLogin = "CREATE TABLE StudentLogin (username VARCHAR(100), password VARCHAR(400))";
$TeacherLogin = "CREATE TABLE TeacherLogin (username VARCHAR(100), password VARCHAR(400))";
$createQuestion = "CREATE TABLE QuizQuestions (QuestionId INTEGER primary key auto_increment, Question TEXT,FuncName VARCHAR(100), tc1 VARCHAR(30), type1 VARCHAR(30),tca1 VARCHAR(30),tc2 VARCHAR(30), type2 VARCHAR(30),tca2 VARCHAR(30), tc3 VARCHAR(30), type3 VARCHAR(30),tca3 VARCHAR(30))";
$Grades = "CREATE TABLE StudentGrades (StudentUsername VARCHAR(200), Quiz INTEGER, Grade INTEGER)";
$Quizzes = "CREATE TABLE Quizzes (quiz_id INTEGER,questions VARCHAR(200), quiz_name VARCHAR(200))";
$TakenQuizzes = "CREATE TABLE TakenQuizzes (username VARCHAR(100),quiz_id INTEGER,question_id INTEGER,StudentAnswer TEXT,Graded INTEGER)";
mysqli_query($connection,$StudentLogin);
mysqli_query($connection,$TeacherLogin);
mysqli_query($connection,$createQuestion);
mysqli_query($connection,$Grades);
mysqli_query($connection,$Quizzes);
mysqli_query($connection,$TakenQuizzes);

mysqli_query($connection,"Truncate table StudentLogin;");
foreach($StudentArr as $x => $v)
{
$v = password_hash($v,PASSWORD_BCRYPT);
$sql = "INSERT INTO StudentLogin (username, password) VALUES ('$x','$v');";
if(mysqli_query($connection,$sql))
{
echo "Record created";
}
else
{
echo "Error: " . mysqli_error($connection). "<br>";
}
}

mysqli_query($connection,"Truncate table TeacherLogin;");
foreach($TeacherArr as $a => $b)
{
$b = password_hash($b,PASSWORD_BCRYPT);
$asql = "INSERT INTO TeacherLogin (username, password) VALUES ('$a','$b');";
if(mysqli_query($connection,$asql))
{
echo "Record created";
}
else
{
echo "Error: " . mysqli_error($connection). "<br>";
}
}
$Q1 = "INSERT INTO QuizQuestions (Question,FuncName,tc1,type1,tca1,tc2,type2,tca2,tc3,type3,tca3) VALUES ('Write a function add that takes two parameters a and b and returns the addition of the numbers?','add','1 2','int','3','5 6','int','11','1 6','int','7');";
$Q2 = "INSERT INTO QuizQuestions (Question,FuncName,tc1,type1,tca1,tc2,type2,tca2,tc3,type3,tca3) VALUES ('Write a function subtract that takes two parameters a and b and returns the subtraction of the numbers?','subtract','1 2','int','-1','10 6','int','4','9 6','int','3');";
$Q3 = "INSERT INTO QuizQuestions (Question,FuncName,tc1,type1,tca1,tc2,type2,tca2,tc3,type3,tca3) VALUES ('Write a function Square that takes one parameter a and returns the square of that number?','Square','1','int','1','3','int','9','2','int','4');";
$Q4 = "INSERT INTO QuizQuestions (Question,FuncName,tc1,type1,tca1,tc2,type2,tca2,tc3,type3,tca3) VALUES ('Write a function isEven that takes one parameter a and returns true?','isEven','2','int','true','3','int','false','6','int','true');";
$Quiz1 = "INSERT INTO Quizzes (quiz_id,questions,quiz_name) VALUES (1234,'1 2 3','Quiz1');";
$Quiz2 = "INSERT INTO Quizzes (quiz_id,questions,quiz_name) VALUES (4351,'2 3 4','Quiz2');";
$Grade1 = "INSERT INTO StudentGrades (StudentUsername, Quiz, Grade) VALUES ('obc2',1234,72);";
$Grade2 = "INSERT INTO StudentGrades (StudentUsername, Quiz, Grade) VALUES ('sr594',1234,83);";
$Grade3 = "INSERT INTO StudentGrades (StudentUsername, Quiz, Grade) VALUES ('faster',1234,76);";
$Grade4 = "INSERT INTO StudentGrades (StudentUsername, Quiz, Grade) VALUES ('username',1234,84);";
//$Grade5 = "INSERT INTO StudentGrades (StudentUsername, Quiz, Grade) VALUES ('sr594',4351,67);";

//$Taken1 = "INSERT INTO TakenQuizzes (username,quiz_id,question_id,StudentAnswer,Graded) VALUES ('sr594',1234,1,'def add(a,x): return(a+b)',0);";
//$Taken2 = "INSERT INTO TakenQuizzes (username,quiz_id,question_id,StudentAnswer,Graded) VALUES ('sr594',1234,2,'def subtract(a,b):\n return(a-b)',0);";
//$Taken3 = "INSERT INTO TakenQuizzes (username,quiz_id,question_id,StudentAnswer,Graded) VALUES ('sr594',1234,3,'def Square(a): return(a**2)',0);";

//$Taken4 = "INSERT INTO TakenQuizzes (username,quiz_id,question_id,StudentAnswer,Graded) VALUES ('sr594',4351,1,'def add(a,x): return(a+b)',0);";
//$Taken5 = "INSERT INTO TakenQuizzes (username,quiz_id,question_id,StudentAnswer,Graded) VALUES ('sr594',4351,2,'def subtract(a,b): return(a-b)',0);";
//$Taken6 = "INSERT INTO TakenQuizzes (username,quiz_id,question_id,StudentAnswer,Graded) VALUES ('sr594',4351,3,'def Square(a): return(a**2)',0);";

mysqli_query($connection,"Truncate table StudentGrades;");
mysqli_query($connection,"Truncate table Quizzes;");
mysqli_query($connection,"Truncate table QuizQuestions;");
mysqli_query($connection,"Truncate table TakenQuizzes;");
mysqli_query($connection,$Q1);
mysqli_query($connection,$Q2);
mysqli_query($connection,$Q3);
mysqli_query($connection,$Q4);
mysqli_query($connection,$Quiz1);
mysqli_query($connection,$Quiz2);
mysqli_query($connection,$Grade1);
mysqli_query($connection,$Grade2);
mysqli_query($connection,$Grade3);
mysqli_query($connection,$Grade4);
//mysqli_query($connection,$Grade5);
//mysqli_query($connection,$Taken1);
//mysqli_query($connection,$Taken2);
//mysqli_query($connection,$Taken3);
//mysqli_query($connection,$Taken4);
//mysqli_query($connection,$Taken5);
//mysqli_query($connection,$Taken6);
mysqli_close($connection);
?>