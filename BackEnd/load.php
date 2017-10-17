<?php

$StudentArr = array("sr594" => "Poaster", "obc2" => "Coolstuff", "test" => "test123", "faster" => "games", "username" => "password");

$TeacherArr = array("teacher" => "password", "professor" => "mypass", "theo" => "cs490", "coo" => "elchimang", "cass" => "Jumble");

$connection = mysqli_connect("sql2.njit.edu", "sr594","//Password", "sr594");

if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

$StudentLogin = "CREATE TABLE StudentLogin (username VARCHAR(100), password VARCHAR(400))";
$TeacherLogin = "CREATE TABLE TeacherLogin (username VARCHAR(100), password VARCHAR(400))";
$createQuestion = "CREATE TABLE QuizQuestions (QuestionId INTEGER, Question TEXT, Answer TEXT, Keywords TEXT,  Difficulty VARCHAR(200))";
$Grades = "CREATE TABLE StudentGrades (StudentUsername VARCHAR(200), Quiz VARCHAR(200), Grade INTEGER)";
$Quizzes = "CREATE TABLE Quizzes (quiz_id INTEGER,questions INTEGER, quiz_name VARCHAR(200))";
$TakenQuizzes = "CREATE TABLE TakenQuizzes (username VARCHAR(100),quiz_id INTEGER,question_id INTEGER,StudentAnswer TEXT)";
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


mysqli_close($connection);
?>