<?php
$studentName = $_POST['StudentName'];
$Quiz = $_POST['QuizId'];
$Grade = $_POST['Grade'];
$Comment = $_POST['Comment'];

$connection = mysqli_connect("sql2.njit.edu", "sr594","Baseball123", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

$updateGrades = "UPDATE StudentGrades set Grade = $Grade, Comment = $Comment where StudentUsername = '$studentName' and Quiz = $Quiz;";

mysqli_query($connection,$updateGrades);
mysqli_close($connection);
?>