<?php
//This is the backend that connects to the database and test when the login has 1;95;0cpassed or failed
$username = $_POST['username'];
$password = $_POST['password'];
$check = $_POST['type'];

$connection = mysqli_connect("sql2.njit.edu", "sr594", "Baseball123", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

if($check == "student")
{
$result = mysqli_query($connection,"select COUNT(*) from StudentLogin where username = '$username';");
$data = mysqli_fetch_assoc($result);
$output = $data['COUNT(*)'];

if($output = 1)
{
$Studentlogin = "";
$query="select * from StudentLogin where username = '$username';";
$x= mysqli_query($connection,$query);
while($a = mysqli_fetch_assoc($x))
{
$verify = password_verify($password,$a["password"]);
if($verify){
$Studentlogin = "Successful";
}
else{
$Studentlogin = "Failed";
}
}
}
echo $Studentlogin;
}
if($check == "teacher")
{
$result = mysqli_query($connection,"select COUNT(*) from TeacherLogin where username = '$username';");
$data = mysqli_fetch_assoc($result);
$output = $data['COUNT(*)'];

if($output = 1)
{
$login = "";
$query="select * from TeacherLogin where username = '$username';";
$x= mysqli_query($connection,$query);
while($a = mysqli_fetch_assoc($x))
{
$verify = password_verify($password,$a["password"]);
if($verify){
$login = "Successful";
}
else{
$login = "Failed";
}
}
}
else{
$login = "The username doesn't exist";
}
echo $login;
}

mysqli_close($connection);
?>
