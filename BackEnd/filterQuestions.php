<?php
$Difficult = $_POST['Difficulty'];
$Type = $_POST['QuestionType'];
$connection = mysqli_connect("sql2.njit.edu", "sr594","Baseball123", "sr594");

if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

$query = "Select * from Questions where Difficulty = $Difficult and QuestionType = '$Type';";
$filterQuestions = mysqli_query($connection,$query);
$arr = array();

while($quest = mysqli_fetch_object($filterQuestions))
{
        array_push($arr,$quest);
}
$jsonQuestions = json_encode($arr);

echo $jsonQuestions;

mysqli_close($connection);
?>