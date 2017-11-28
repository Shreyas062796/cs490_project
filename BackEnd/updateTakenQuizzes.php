<?php
$studentName = $_POST['StudentUsername'];
$Quiz = $_POST['QuizId'];
$StudentOutput = $_POST['StudentOutput'];
$Question = $_POST['QuestionId'];
$studentFunc = $_POST['StudentFunc'];
$studentPoints = $_POST['QuestionPoints'];
$studentComment = $_POST['StudentComment'];
$testcasepoints = $_POST['TestcasePoints'];
$connection = mysqli_connect("sql2.njit.edu", "sr594","Baseball123", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}


$query = "select * from TakenQuizzes where username = '$studentName' and quiz_id = '$Quiz';";
$x = mysqli_query($connection,$query);

while($a = mysqli_fetch_object($x))
{
$updateOutput = "UPDATE TakenQuizzes set StudentFunc = '$studentFunc' and QuestionPoints = '$studentPoints' where question_id = '$a->question_id'";
$updateOut = "UPDATE TakenQuizzes set StudentOutput = '$StudentOutput' and TestCasePoints = '$testcasepoints' where question_id = '$a->question_id'";
//$update =  "UPDATE TakenQuizzes set QuestionPoints = '$studentPoints' where question_id = '$a->question_id'";
//$up =  "UPDATE TakenQuizzes set TestCasePoints = '$testcasepoints' where question_id = '$a->question_id'";
$u =  "UPDATE TakenQuizzes set QuestionComment = '$studentComment' where question_id = '$a->question_id'";
mysqli_query($connection,$updateOutput);
mysqli_query($connection,$updateOut);
//mysqli_query($connection,$update);
//mysqli_query($connection,$up);
mysqli_query($connection,$u);
}

mysqli_close($connection);
?>