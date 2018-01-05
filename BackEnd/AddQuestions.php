<?php
$Question = $_POST['Question'];
$Func = $_POST['FunctionName'];
$Difficulty = $_POST['Difficulty'];
$Type = $_POST['QuestionType'];
$Testcases = $_POST['Testcases'];


$connection = mysqli_connect("sql2.njit.edu", "sr594", "//password", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}
$InsertQuestion = "INSERT INTO Questions (Question,FuncName,Difficulty,QuestionType,Testcases) VALUES ('$Question','$Func',$Difficulty,'$Type','$Testcases');";
mysqli_query($connection,$InsertQuestion);
mysqli_close($connection);
?>