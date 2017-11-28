<?php
$Questions = $_POST['Questions'];
$QuizName = $_POST['quizname'];
$QuestionPts = $_POST['QuestionPts'];
$connection = mysqli_connect("sql2.njit.edu", "sr594", "Baseball123", "sr594");

if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}
$QuizId = rand(1,1000);
$exists = "Select COUNT(*) from Quizzes where quiz_id = $QuizId;";
$result = mysqli_query($connection,$exists);
$data = mysqli_fetch_assoc($result);
$x = $data['COUNT(*)'];
if($x == 0)
{
$EnterQuizzes = "INSERT INTO Quizzes (quiz_id, questions, question_pts, quiz_name) VALUES ($QuizId,'$Questions','$QuestionPts', '$QuizName');";
mysqli_query($connection,$EnterQuizzes);
echo "Ok";
}


//$EnterQuizzes = "INSERT INTO Quizzes (quiz_id, questions, quiz_name) VALUES ('$QuizId','$Questions', '$QuizName');";

//mysqli_query($connection,$EnterQuizzes);
mysqli_close($connection);
?>