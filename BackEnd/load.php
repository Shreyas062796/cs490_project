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
$NewCreateQuestions = "CREATE TABLE Questions (QuestionId INTEGER primary key auto_increment, Question TEXT,FuncName VARCHAR(100), Difficulty INTEGER,QuestionType VARCHAR(200),Testcases TEXT)";
$Grades = "CREATE TABLE StudentGrades (StudentUsername VARCHAR(200), Quiz INTEGER, Grade INTEGER, Comment TEXT)";
$Quizzes = "CREATE TABLE Quizzes (quiz_id INTEGER,questions VARCHAR(200), question_pts VARCHAR(200), quiz_name VARCHAR(200))";
$TakenQuizzes = "CREATE TABLE TakenQuizzes (username VARCHAR(100),quiz_id INTEGER,question_id INTEGER,StudentAnswer TEXT,StudentFunc VARCHAR(200),StudentOutput VARCHAR(200),QuestionPoints INTEGER, TestCasePoints VARCHAR(200),QuestionComment TEXT, Graded INTEGER)";
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
$Quest2 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function iterate that takes 1 parameter a which is the equal to the counter that prints hi while the counter is less than 12 then it breaks. Increment the counter after everytime through the loop.','iterate',2,'while loop','10-hihi;;9-hihihi;;8-hihihihi');";
$Quest3 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function HowOld that takes 1 parameter a  and uses if statements to say if a is less than than 18 then print child, otherwise print adult','HowOld',3,'if/else statement','1-child;;18-adult;;16-child;;30-adult');";
$Quest4 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function printNum that takes 1 parameter a  and uses a for loop to print it out 5 times','printNum',2,'for loop','1-11111;;4-44444;;3-33333;;6-66666');";
$Quest5 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function iterate that takes 1 parameter a which is the equal to the counter that prints hi while the counter is less than 12 then it breaks. Increment the counter after everytime through the loop.','iterate',1,'while loop','10-hihi;;9-hihihi;;8-hihihihi');";
$Quest6 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function HowOld that takes 1 parameter a  and uses if statements to say if a is less than than 18 then print child, otherwise print adult','HowOld',1,'if/else statement','1-child;;18-adult;;16-child;;30-adult');";
$Quest7 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function pizza that takes 1 arguement and prints out how many slices of pizza are in a pie','pizza',1,'if/else statement','1-8;;4-8;;3-8;;6-8');";
$Quest8 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function called increment that takes one arguement and increments it by 2.','increment',2,'if/else statement','10-12;;9-11;;8-10');";
$Quest9 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function subtractTwo that takes a parameter and subtracts 2','subtractTwo',3,'if/else statement','3-1;;18-16;;16-12;;30-28');";
$Quest10 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function good that takes 1 parameter and iterates through it 4 times and adds 1 every time.','good',2,'for loop','1-2345;;4-5678;;3-4567;;6-78910');";
$Quest11 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function jump that takes two parameters and increments the first one by the second one 3 times.','jump',1,'for loop','10 2-121416;;9 1-101112;;8 3-111417');";
$Quest12 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function facts that takes 1 parameter and says facts the number of times that is the parameter','facts',1,'for loop','1-facts;;3-factsfactsfacts;;2-factsfacts;;4-factsfactsfactsfacts');";
$Quest13 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function printNum that takes 1 parameter a  and uses a for loop to print it out 5 times','printNum',1,'for loop','1-11111;;4-44444;;3-33333;;6-66666');";
$Quest14 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function iterate that takes 1 parameter a which is the equal to the counter that prints hi while the counter is less than 12 then it breaks. Increment the counter after everytime through the loop.','iterate',2,'while loop','10-hihi;;9-hihihi;;8-hihihihi');";
$Quest15 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function HowOld that takes 1 parameter a  and uses if statements to say if a is less than than 18 then print child, otherwise print adult','HowOld',3,'if/else statement','1-child;;18-adult;;16-child;;30-adult');";
$Quest16 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function printNum that takes 1 parameter a  and uses a for loop to print it out 5 times','printNum',2,'for loop','1-11111;;4-44444;;3-33333;;6-66666');";
$Quest17 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function iterate that takes 1 parameter a which is the equal to the counter that prints hi while the counter is less than 12 then it breaks. Increment the counter after everytime through the loop.','iterate',1,'while loop','10-hihi;;9-hihihi;;8-hihihihi');";
$Quest18 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function HowOld that takes 1 parameter a  and uses if statements to say if a is less than than 18 then print child, otherwise print adult','HowOld',1,'if/else statement','1-child;;18-adult;;16-child;;30-adult');";
$Quest19 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function pizza that takes 1 arguement and prints out how many slices of pizza are in a pie','pizza',1,'if/else statement','1-8;;4-8;;3-8;;6-8');";
$Quest20 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function called increment that takes one arguement and increments it by 2.','increment',2,'if/else statement','10-12;;9-11;;8-10');";
$Quest21 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function subtractTwo that takes a parameter and subtracts 2','subtractTwo',3,'if/else statement','3-1;;18-16;;16-12;;30-28');";
$Quest22 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function good that takes 1 parameter and iterates through it 4 times and adds 1 every time.','good',2,'for loop','1-2345;;4-5678;;3-4567;;6-78910');";
$Quest23 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function jump that takes two parameters and increments the first one by the second one 3 times.','jump',1,'for loop','10 2-121416;;9 1-101112;;8 3-111417');";
$Quest24 = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('Write a function facts that takes 1 parameter and says facts the number of times that is the parameter','facts',1,'for loop','1-facts;;3-factsfactsfacts;;2-factsfacts;;4-factsfactsfactsfacts');";
$Quiz1 = "INSERT INTO Quizzes (quiz_id,questions,question_pts,quiz_name) VALUES (1234,'1 2 3','10 20 30','Quiz1');";
$Quiz2 = "INSERT INTO Quizzes (quiz_id,questions,question_pts,quiz_name) VALUES (4351,'2 3 4','20 10 30','Quiz2');";
$Grade1 = "INSERT INTO StudentGrades (StudentUsername, Quiz, Grade, Comment) VALUES ('obc2',1234,72,'very good job but work on for loops');";
$Grade2 = "INSERT INTO StudentGrades (StudentUsername, Quiz, Grade, Comment) VALUES ('sr594',1234,83,'Not a very good job on this exam');";
$Grade3 = "INSERT INTO StudentGrades (StudentUsername, Quiz, Grade, Comment) VALUES ('faster',1234,76,'Study harder next time and focus on for loops');";
//$Grade4 = "INSERT INTO StudentGrades (StudentUsername, Quiz, Grade, QuestionGrades, Comment) VALUES ('username',1234,84);";
$Grade5 = "INSERT INTO StudentGrades (StudentUsername, Quiz, Grade, QuestionGrades, Comment) VALUES ('sr594',4351,67,'1 3 5 3 1','You are an idiot what are you doing with ur life');";

$Taken1 = "INSERT INTO TakenQuizzes (username,quiz_id,question_id,StudentAnswer,StudentFunc,StudentOutput,QuestionPoints,TestCasePoints,QuestionComment,Graded) VALUES ('sr594',1234,1,'def add(a,x): return(a+b)','add','112112',20,'2 3 2 1','ticks are cool',0);";
//$Taken2 = "INSERT INTO TakenQuizzes (username,quiz_id,question_id,StudentAnswer,StudentFunc,Graded) VALUES ('sr594',1234,2,'def subtract(a,b):\n return(a-b)','subtract',0);";
//$Taken3 = "INSERT INTO TakenQuizzes (username,quiz_id,question_id,StudentAnswer,StudentFunc,Graded) VALUES ('sr594',1234,3,'def Square(a): return(a**2)','Square',0);";

//$Taken4 = "INSERT INTO TakenQuizzes (username,quiz_id,question_id,StudentAnswer,StudentFunc,Graded) VALUES ('sr594',4351,1,'def add(a,x): return(a+b)','add',0);";
//$Taken5 = "INSERT INTO TakenQuizzes (username,quiz_id,question_id,StudentAnswer,StudentFunc,Graded) VALUES ('sr594',4351,2,'def subtract(a,b): return(a-b)','subtract',0);";
//$Taken6 = "INSERT INTO TakenQuizzes (username,quiz_id,question_id,StudentAnswer,StudentFunc,Graded) VALUES ('sr594',4351,3,'def Square(a): return(a**2)','Square',0);";

mysqli_query($connection,"Truncate table StudentGrades;");
mysqli_query($connection,"Truncate table Quizzes;");
mysqli_query($connection,"Truncate table Questions;");
mysqli_query($connection,"Truncate table TakenQuizzes;");
mysqli_query($connection,$Quest1);
mysqli_query($connection,$Quest2);
mysqli_query($connection,$Quest3);
mysqli_query($connection,$Quest4);
mysqli_query($connection,$Quest5);
mysqli_query($connection,$Quest6);
mysqli_query($connection,$Quest7);
mysqli_query($connection,$Quest8);
mysqli_query($connection,$Quest9);
mysqli_query($connection,$Quest10);
mysqli_query($connection,$Quest11);
mysqli_query($connection,$Quest12);
mysqli_query($connection,$Quest13);
mysqli_query($connection,$Quest14);
mysqli_query($connection,$Quest15);
mysqli_query($connection,$Quest16);
mysqli_query($connection,$Quest17);
mysqli_query($connection,$Quest18);
mysqli_query($connection,$Quest19);
mysqli_query($connection,$Quest20);
mysqli_query($connection,$Quest21);
mysqli_query($connection,$Quest22);
mysqli_query($connection,$Quest23);
mysqli_query($connection,$Quest24);
mysqli_query($connection,$Quiz1);
mysqli_query($connection,$Quiz2);
mysqli_query($connection,$Grade1);
mysqli_query($connection,$Grade2);
mysqli_query($connection,$Grade3);
//mysqli_query($connection,$Grade4);
mysqli_query($connection,$Grade5);
mysqli_query($connection,$Taken1);
//mysqli_query($connection,$Taken2);
//mysqli_query($connection,$Taken3);
//mysqli_query($connection,$Taken4);
//mysqli_query($connection,$Taken5);
//mysqli_query($connection,$Taken6);
mysqli_close($connection);
?>