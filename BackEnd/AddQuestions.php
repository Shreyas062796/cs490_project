<?php
$Question = $_POST['Question'];
$Func = $_POST['FunctionName'];
$tc1 = $_POST['Testcase1'];
$type1 = $_POST['Type1'];
$tca1 = $_POST['Answer1'];
$tc2 = $_POST['Testcase2'];
$type2 = $_POST['Type2'];
$tca2 = $_POST['Answer2'];
$tc3 = $_POST['Testcase3'];
$type3 = $_POST['Type3'];
$tca3 = $_POST['Answer3'];

$connection = mysqli_connect("sql2.njit.edu", "sr594", "Baseball123", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}
$QuestId = rand(1,1000);
$exists = "Select COUNT(*) from QuizQuestions where QuestionId = $QuestId;";
$result = mysqli_query($connection,$exists);
$data = mysqli_fetch_assoc($result);
$x = $data['COUNT(*)'];
if($x == 0)
{
$InsertQuestion = "INSERT INTO QuizQuestions (QuestionId,Question,FuncName,tc1,type1,tca1,tc2,type2,tca2,tc3,type3,tca3) VALUES ($QuestId,'$Question','$Func','$tc1','$type1','$tca1','$tc2','$type2','$tca2','$tc3','$type3','$tca3');";

mysqli_query($connection,$InsertQuestion);
echo $QuestId;
}
mysqli_close($connection);
?>