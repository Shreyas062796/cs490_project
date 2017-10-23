<?php
$connection = mysqli_connect("sql2.njit.edu", "sr594","Baseball123", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

$Quizzes  = "Select * from Quizzes;";
$QuizQuest = mysqli_query($connection, $Quizzes);
$arr = array();

while($ob = mysqli_fetch_object($QuizQuest))
{
array_push($arr,$ob);
}

$jsonQuiz = json_encode($arr);
echo $jsonQuiz;
mysqli_close($connection);
?>