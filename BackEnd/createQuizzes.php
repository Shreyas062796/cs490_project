<?php
$QuizId = $_POST['quiz_id'];
$Questions = $_POST['Questions'];
$QuizName = $_POST['quizname'];

$connection = mysqli_connect("sql2.njit.edu", "sr594", "Baseball123", "sr594");

if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

$EnterQuizzes = "INSERT INTO Quizzes (quiz_id, questions, quiz_name) VALUES ('$QuizId','$Questions', '$QuizName');";

mysqli_query($connection,$EnterQuizzes);
mysqli_close($connection);
?>