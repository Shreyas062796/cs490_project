<?php
$connection = mysqli_connect("sql2.njit.edu", "sr594", "//Password", "sr594");


if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}
$getAll = "select * from QuizQuestions;";
$questions = mysqli_query($connection, $getAll);
$arr = array();
while($quest = mysqli_fetch_object($questions))
{
   array_push($arr,$quest);
}

$q = json_encode($arr);

echo $q; 
mysqli_close($connection);
?>