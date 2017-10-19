<?php
$connection = mysqli_connect("sql2.njit.edu", "sr594","Baseball123", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}


$TakenQuizzes = "Select * from TakenQuizzes;";
$AllQuizzes = mysqli_query($connection, $TakenQuizzes);
$arr = array();


$x = mysqli_query($connection, $AllQuizzes);
while($y = mysqli_fetch_object($x))
{
   	array_push($arr,$y);
}

$q = json_encode($arr);

echo $q; 
mysqli_close($connection);

?>