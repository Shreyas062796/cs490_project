<?php
$Question = $_POST['Question'];
$Answer = $_POST['Answer'];
$Diff = $_POST['Difficulty'];

$connection = mysqli_connect("sql2.njit.edu", "sr594", "Baseball123", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

$InsertQuestion = "INSERT INTO QuizQuestions (Question, Answer,Difficulty) VALUES ('$Question', '$Answer', '$Diff')";

mysqli_query($connection,$InsertQuestion);

mysqli_close($connection);
?>