<?php
$connection = mysqli_connect("sql2.njit.edu", "sr594","Baseball123", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}
$TakenQuizzes = "Select * from TakenQuizzes where Graded = 0 order by question_id;";
$AllQuizzes = mysqli_query($connection, $TakenQuizzes);
$arr = array();
while($y = mysqli_fetch_object($AllQuizzes))
{
   	array_push($arr,$y);
}
$q = json_encode($arr);
echo $q; 
mysqli_close($connection);
?>