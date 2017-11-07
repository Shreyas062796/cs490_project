<?php
$studentName = $_POST['StudentName'];
$Quiz = $_POST['QuizId'];
$QuizScore = $_POST['Score'];
$QuestionGrades = $_POST['QuestionGrades'];
$Comment = $_POST['Comment'];
$connection = mysqli_connect("sql2.njit.edu", "sr594", "Baseball123", "sr594");

if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}


$GradesInsert = "INSERT INTO StudentGrades (StudentUsername, Quiz, Grade, QuestionGrades, Comment) VALUES ('$studentName',$Quiz,$QuizScore,'$QuestionGrades','$Comment');";


$updateTakenQuizzes = "UPDATE TakenQuizzes set Graded = 1 where username = '$studentName' and quiz_id = $Quiz;";
mysqli_query($connection,$GradesInsert);
mysqli_query($connection,$updateTakenQuizzes);
mysqli_close($connection);
?>