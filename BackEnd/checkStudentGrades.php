<?php 
$QuizId = $_POST['QuizId'];
$StudentName = $_POST['StudentUsername'];

$connection = mysqli_connect("sql2.njit.edu", "sr594","Baseball123", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}


$SelectTaken = "Select * from StudentGrades where StudentUsername = '$StudentName' and Quiz = '$QuizId';";
$Taken = mysqli_query($connection, $SelectTaken);
$arr = array();
$inner = array();
$TakenArray = array();
while($b = mysqli_fetch_object($Taken))
{
array_push($arr,$b);
}
$Quizzes  = "Select * from Quizzes where quiz_id = '$QuizId';";
$QuizQuest = mysqli_query($connection, $Quizzes);

while($ob = mysqli_fetch_object($QuizQuest))
{
$v = split(' ',$ob->questions);
array_push($arr,$ob);
}

for( $i = 0; $i < count($v); $i++)
{
$getQuestions = "Select * from Questions where QuestionId = '$v[$i]';";
$q = mysqli_query($connection,$getQuestions);
while($x = mysqli_fetch_object($q))
{
array_push($inner,$x);
}
}
$cool = "Select * from TakenQuizzes where username = '$StudentName' and quiz_id = '$QuizId';";
$j = mysqli_query($connection,$cool);
while($v = mysqli_fetch_object($j))
{
array_push($TakenArray,$v);
}

array_push($arr,$inner);
array_push($arr,$TakenArray);

$q = json_encode($arr);
echo $q;

mysqli_close($connection);
?>