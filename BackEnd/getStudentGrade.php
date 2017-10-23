<?php
$Student = $_POST['StudentUserName'];

$connection = mysqli_connect("sql2.njit.edu", "sr594","Baseball123", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

$getAllGrades  = "Select * from StudentGrades where StudentUsername = '$Student';";
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