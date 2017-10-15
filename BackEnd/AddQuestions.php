<?php

$contents = file_get_contents('php://input');
$data = json_decode($contents);

$Question = $data->Question;
$Answer = $data->Answer;
$keywords = $data->KeyWords;
$Diff = $data->Difficulty;
$connection = mysqli_connect("sql2.njit.edu", "sr594", "Baseball123", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

$InsertQuestion = "INSERT INTO QuizQuestions (Question, Answer, KeyWords, Difficulty) VALUES ('$Question', '$Answer', '$keywords', '$Diff')";

mysqli_query($connection,$InsertQuestion);

mysqli_close($connection);
?>