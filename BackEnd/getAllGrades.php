<?php
$connection = mysqli_connect("sql2.njit.edu", "sr594","//password", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

$getAllGrades  = "Select * from StudentGrades;";
$grades = mysqli_query($connection,$getAllGrades);
$arr = array();
//$da = "Delete from StudentGrades where grade=0;";
//$a = mysqli_query($connection,$da);
while($quest = mysqli_fetch_object($grades))
{
   	array_push($arr,$quest);
}
$jsonGrades = json_encode($arr);

echo $jsonGrades;
//echo $arr;
mysqli_close($connection);
?>