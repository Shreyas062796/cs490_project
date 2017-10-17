<?php
$contents = file_get_contents('php://input');
$data = json_decode($contents);
$QuizName = $data->quiz_name;

$connection = mysqli_connect("sql2.njit.edu", "sr594","//Password", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

$Quizzes  = "Select questions from Quizzes where quiz_name = '$QuizName';"
$QuizQuest = mysqli_query($connection, $Quizzes);
$arr = array();

while($quest = mysqli_fetch_object($QuizQuest))
{
$quest = split(',',$quest);

$getQuestions = "Select * from QuizQuestions where 
 
}


?>