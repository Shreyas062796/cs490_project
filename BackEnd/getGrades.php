<?php

$contents = file_get_contents('php://input');
$data = json_decode($contents);

$Student = $data->Student;
$Quiz = $data->Quiz;
$Grade = $data->Grade;

$connection = mysqli_connect("sql2.njit.edu", "sr594","//Password", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

$getAllGrades  = "Select * from StudentGrades;"
$grades = mysqli_query($connection,$getAllGrades);
$arr = array();

while($quest = mysqli_fetch_object($grades))
{
   array_push($arr,$quest);
}
$jsonGrades = json_encode($arr);

echo $jsonGrades;

mysqli_close($connection);
?>