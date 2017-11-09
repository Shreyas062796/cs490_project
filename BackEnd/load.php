<?php

$StudentArr = array("sr594" => "Poaster", "obc2" => "Coolstuff", "test" => "test123", "faster" => "games", "username" => "password");

$TeacherArr = array("teacher" => "password", "professor" => "mypass", "theo" => "cs490", "coo" => "elchimang", "cass" => "Jumble");

$connection = mysqli_connect("sql2.njit.edu", "sr594","Baseball123", "sr594");

if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

//$StudentLogin = "CREATE TABLE StudentLogin (username VARCHAR(100), password VARCHAR(400))";
//$TeacherLogin = "CREATE TABLE TeacherLogin (username VARCHAR(100), password VARCHAR(400))";
$Login = "CREATE TABLE Login (username VARCHAR(100), password VARCHAR(400), userType VARCHAR(300))";
$createQuestion = "CREATE TABLE QuizQuestions (QuestionId INTEGER primary key auto_increment, Question TEXT,FuncName VARCHAR(100), tc1 VARCHAR(30), type1 VARCHAR(30),tca1 VARCHAR(30),tc2 VARCHAR(30), type2 VARCHAR(30),tca2 VARCHAR(30), tc3 VARCHAR(30), type3 VARCHAR(30),tca3 VARCHAR(30))";
$NewCreateQuestions = "CREATE TABLE Questions (QuestionId INTEGER primary key auto_increment, Question TEXT,FuncName VARCHAR(100), Difficulty INTEGER, QuestionType VARCHAR(200),Testcases TEXT)";
$Grades = "CREATE TABLE StudentGrades (StudentUsername VARCHAR(200), Quiz INTEGER, Grade INTEGER, QuestionGrades TEXT, Comment TEXT)";
$Quizzes = "CREATE TABLE Quizzes (quiz_id INTEGER,questions VARCHAR(200), quiz_name VARCHAR(200))";
$TakenQuizzes = "CREATE TABLE TakenQuizzes (username VARCHAR(100),quiz_id INTEGER,question_id INTEGER,StudentAnswer TEXT,Graded INTEGER)";
mysqli_query($connection,$Login);
mysqli_query($connection,$createQuestion);
mysqli_query($connection,$NewCreateQuestions);
mysqli_query($connection,$Grades);
mysqli_query($connection,$Quizzes);
mysqli_query($connection,$TakenQuizzes);

mysqli_query($connection,"Truncate table Login;");
foreach($StudentArr as $x => $v)
{
$v = password_hash($v,PASSWORD_BCRYPT);
$sql = "INSERT INTO Login (username, password,userType) VALUES ('$x','$v','Student');";
if(mysqli_query($connection,$sql))
{
echo "Record created";
}
else
{
echo "Error: " . mysqli_error($connection). "<br>";
}
}

foreach($TeacherArr as $a => $b)
{
$b = password_hash($b,PASSWORD_BCRYPT);
$asql = "INSERT INTO Login (username, password,userType) VALUES ('$a','$b', 'Teacher');";
if(mysqli_query($connection,$asql))
{
echo "Record created";
}
else
{
echo "Error: " . mysqli_error($connection). "<br>";
}
}
$Quest1 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function printNum that takes 1 parameter a  and uses a for loop to print it out 5 times','printNum',1,'for loop','1-11111;;4-44444;;3-33333;;6-66666');";
$Quest2 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function iterate that takes 1 parameter a which is the equal to the counter that prints hi while the counter is less than 12 then it breaks. Increment the counter after everytime through the loop.','iterate',1,'while loop','10-hihi;;9-hihihi;;8-hihihihi');";
$Quest3 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function HowOld that takes 1 parameter a  and uses if statements to say if a is less than than 18 then print child, otherwise print adult','HowOld',1,'if/else statement','1-child;;18-adult;;16-child;;30-adult');";
$Quest4 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function printNum that takes 1 parameter a  and uses a for loop to print it out 5 times','printNum',
1,'for loop','1-11111;;4-44444;;3-33333;;6-66666');";
$Quest5 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function iterate that takes 1 parameter a which is the equal to the counter that prints hi while the
 counter is less than 12 then it breaks. Increment the counter after everytime through the loop.','iterate',1,'while loop','10-hihi;;9-hihihi;;8-hihihihi');";
$Quest6 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function HowOld that takes 1 parameter a  and uses if statements to say if a is less than than 18 th
en print child, otherwise print adult','HowOld',1,'if/else statement','1-child;;18-adult;;16-child;;30-adult');";
$Q1 = "INSERT INTO QuizQuestions (Question,FuncName,tc1,type1,tca1,tc2,type2,tca2,tc3,type3,tca3) VALUES ('Write a function add that takes two parameters a and b and returns the addition of the numbers?','add','1 2','int','3','5 6','int','11','1 6','int','7');";
$Q2 = "INSERT INTO QuizQuestions (Question,FuncName,tc1,type1,tca1,tc2,type2,tca2,tc3,type3,tca3) VALUES ('Write a function subtract that takes two parameters a and b and returns the subtraction of the numbers?','subtract','1 2','int','-1','10 6','int','4','9 6','int','3');";
$Q3 = "INSERT INTO QuizQuestions (Question,FuncName,tc1,type1,tca1,tc2,type2,tca2,tc3,type3,tca3) VALUES ('Write a function Square that takes one parameter a and returns the square of that number?','Square','1','int','1','3','int','9','2','int','4');";
$Q4 = "INSERT INTO QuizQuestions (Question,FuncName,tc1,type1,tca1,tc2,type2,tca2,tc3,type3,tca3) VALUES ('Write a function isEven that takes one parameter a and returns true?','isEven','2','int','true','3','int','false','6','int','true');";
$Quiz1 = "INSERT INTO Quizzes (quiz_id,questions,quiz_name) VALUES (1234,'1 2 3','Quiz1');";
$Quiz2 = "INSERT INTO Quizzes (quiz_id,questions,quiz_name) VALUES (4351,'2 3 4','Quiz2');";
$Grade1 = "INSERT INTO StudentGrades (StudentUsername, Quiz, Grade, QuestionGrades, Comment) VALUES ('obc2',1234,72,'4 4 1 4', 'very good job but work on for loops');";
$Grade2 = "INSERT INTO StudentGrades (StudentUsername, Quiz, Grade, QuestionGrades, Comment) VALUES ('sr594',1234,83,'2 3 4 1 2','Not a very good job on this exam');";
$Grade3 = "INSERT INTO StudentGrades (StudentUsername, Quiz, Grade, QuestionGrades, Comment) VALUES ('faster',1234,76,'1 3 4 2 1','Study harder next time and focus on for loops');";
//$Grade4 = "INSERT INTO StudentGrades (StudentUsername, Quiz, Grade, QuestionGrades, Comment) VALUES ('username',1234,84);";
//$Grade5 = "INSERT INTO StudentGrades (StudentUsername, Quiz, Grade, QuestionGrades, Comment) VALUES ('sr594',4351,67);";

//$Taken1 = "INSERT INTO TakenQuizzes (username,quiz_id,question_id,StudentAnswer,Graded) VALUES ('sr594',1234,1,'def add(a,x): return(a+b)',0);";
//$Taken2 = "INSERT INTO TakenQuizzes (username,quiz_id,question_id,StudentAnswer,Graded) VALUES ('sr594',1234,2,'def subtract(a,b):\n return(a-b)',0);";
//$Taken3 = "INSERT INTO TakenQuizzes (username,quiz_id,question_id,StudentAnswer,Graded) VALUES ('sr594',1234,3,'def Square(a): return(a**2)',0);";

//$Taken4 = "INSERT INTO TakenQuizzes (username,quiz_id,question_id,StudentAnswer,Graded) VALUES ('sr594',4351,1,'def add(a,x): return(a+b)',0);";
//$Taken5 = "INSERT INTO TakenQuizzes (username,quiz_id,question_id,StudentAnswer,Graded) VALUES ('sr594',4351,2,'def subtract(a,b): return(a-b)',0);";
//$Taken6 = "INSERT INTO TakenQuizzes (username,quiz_id,question_id,StudentAnswer,Graded) VALUES ('sr594',4351,3,'def Square(a): return(a**2)',0);";

mysqli_query($connection,"Truncate table StudentGrades;");
mysqli_query($connection,"Truncate table Quizzes;");
mysqli_query($connection,"Truncate table Questions;");
mysqli_query($connection,"Truncate table TakenQuizzes;");
mysqli_query($connection,$Q1);
mysqli_query($connection,$Q2);
mysqli_query($connection,$Q3);
mysqli_query($connection,$Q4);
mysqli_query($connection,$Quest1);
mysqli_query($connection,$Quest2);
mysqli_query($connection,$Quest3);
mysqli_query($connection,$Quest4);
mysqli_query($connection,$Quest5);
mysqli_query($connection,$Quest6);
mysqli_query($connection,$Quiz1);
mysqli_query($connection,$Quiz2);
mysqli_query($connection,$Grade1);
mysqli_query($connection,$Grade2);
mysqli_query($connection,$Grade3);
//mysqli_query($connection,$Grade4);
//mysqli_query($connection,$Grade5);
//mysqli_query($connection,$Taken1);
//mysqli_query($connection,$Taken2);
//mysqli_query($connection,$Taken3);
//mysqli_query($connection,$Taken4);
//mysqli_query($connection,$Taken5);
//mysqli_query($connection,$Taken6);
mysqli_close($connection);
?>