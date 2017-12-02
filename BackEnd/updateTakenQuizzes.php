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

$update =  "UPDATE TakenQuizzes set QuestionPoints = '$studentPoints',StudentFunc = '$studentFunc',QuestionComment = '$studentComment', TestCasePoints = '$testcasepoints',StudentOutput = '$StudentOutput' where question_id = '$Question'";

mysqli_query($connection,$update);

mysqli_close($connection);
?>