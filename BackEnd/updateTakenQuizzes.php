<?php
$studentName = $_POST['StudentUsername'];
$Quiz = $_POST['QuizId'];
$output = $_POST['StudentOutput'];
$studentFunc = $_POST['StudentFunc'];

$connection = mysqli_connect("sql2.njit.edu", "sr594","Baseball123", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

$updateOutput = "UPDATE TakenQuizzes set StudentOutput = '$output' and StudentFunc = '$studentFunc' where username = '$studentName' and quiz_id = '$Quiz';";

mysqli_query($connection,$updateOutput);
mysqli_close($connection);
?>