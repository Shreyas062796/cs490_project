<?php
$connection = mysqli_connect("sql2.njit.edu", "sr594","//password", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}
$TakenQuizzes = "Select Distinct quiz_id,username from TakenQuizzes where Graded = 0;";
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

