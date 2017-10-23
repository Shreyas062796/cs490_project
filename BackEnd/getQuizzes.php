<?php
$QuizId = $_POST['quizId'];
$connection = mysqli_connect("sql2.njit.edu", "sr594","Baseball123", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

$Quizzes  = "Select * from Quizzes where quiz_id = '$QuizId';";
$QuizQuest = mysqli_query($connection, $Quizzes);
$arr = array();
$inner = array();

while($ob = mysqli_fetch_object($QuizQuest))
{
$v = split(' ',$ob->questions);
array_push($arr,$ob);
}


for( $i = 0; $i < count($v); $i++)
{
$getQuestions = "Select * from QuizQuestions where QuestionId = '$v[$i]';";
$q = mysqli_query($connection,$getQuestions);
while($x = mysqli_fetch_object($q))
{
array_push($inner,$x);
}
}
array_push($arr,$inner);
$jsonQuiz = json_encode($arr);
echo $jsonQuiz;
mysqli_close($connection);
?>