<?php
$request = file_get_contents('php://input');
$quizinfo = json_decode($request);

$studentName = $quizinfo->studentUsername;
$QuizScore = $quizinfo->score;
$QuizName = $quizinfo->name;

$connection = mysqli_connect("sql2.njit.edu", "sr594", "Baseball123", "sr594");

if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

$GradesInsert = "INSERT INTO StudentGrades (StudentUsername, Quiz, Grade) VALUES ('$studentName','$QuizName','$QuizScore');";

mysqli_query($connection,$GradesInsert);
mysqli_close($connection);



?>