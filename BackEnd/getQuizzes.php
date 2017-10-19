<?php
$QuizName = $_POST['quizname'];
$connection = mysqli_connect("sql2.njit.edu", "sr594","Baseball123", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

$Quizzes  = "Select questions from Quizzes where quiz_name = '$QuizName';";
$QuizQuest = mysqli_query($connection, $Quizzes);
$arr = array();

while($questions = mysqli_fetch_object($QuizQuest))
{
$v = split(',',$questions->questions);
}
foreach($v as $question)
{
$getQuestions = "Select * from QuizQuestions where QuestionId = '$question';";
$q = mysqli_query($connection,$getQuestions);
while($x = mysqli_fetch_object($q))
{
array_push($arr,$x);
}
}

$jsonQuiz = json_encode($arr);

echo $jsonQuiz;
mysqli_close($connection);
?>