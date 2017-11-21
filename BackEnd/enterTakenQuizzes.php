<?php
$StudentName = $_POST['StudentUsername'];
$QuizId = $_POST['QuizId'];
$Answer = $_POST['Answer'];
$QuestionId = $_POST['QuestionId'];
$output = $_POST['StudentOutput'];

$connection = mysqli_connect("sql2.njit.edu", "sr594","Baseball123", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

$TakenQuizzes = "INSERT INTO TakenQuizzes (username,quiz_id,question_id,StudentAnswer,StudentFunc,StudentOutput,Graded) VALUES ('$StudentName',$QuizId,$QuestionId,'$Answer',null,'$output',0);";
mysqli_query($connection, $TakenQuizzes);


mysqli_close($connection);
?>