<?php
$studentName = $_POST['StudentName'];
$QuizName = $_POST['QuizName'];
$QuizScore = $_POST['Score'];

$connection = mysqli_connect("sql2.njit.edu", "sr594", "Baseball123", "sr594");

if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

$GradesInsert = "INSERT INTO StudentGrades (StudentUsername, Quiz, Grade) VALUES ('$studentName',$QuizName,$QuizScore);";


$updateTakenQuizzes = "UPDATE TakenQuizzes set Graded = 1 where username = '$studentName' and quiz_id = $QuizName;";
mysqli_query($connection,$GradesInsert);
mysqli_query($connection,$updateTakenQuizzes);
mysqli_close($connection);



?>