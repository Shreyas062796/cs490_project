<?php
//This is the backend that connects to the database and test when the login has passed or failed
$data = file_get_contents('php://input');
$jsondata = json_decode($data);

$username = $jsondata->Username;
$password = $jsondata->Password;
//$njitauth = $jsondata->njitAuth;
$check = $jsondata->Check;

$connection = mysqli_connect("sql2.njit.edu", "sr594", "Baseball123", "sr594");

if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}

if($check == 'student')
{
$result = mysqli_query($connection,"select COUNT(*) from StudentLogin where username = '$username';");
$data = mysqli_fetch_assoc($result);
$output = $data['COUNT(*)'];

if($output = 1)
{
$login = "";
$query="select * from StudentLogin where username = '$username';";
$x= mysqli_query($connection,$query);
while($a = mysqli_fetch_assoc($x))
{
$verify = password_verify($password,$a["password"]);
if($verify){
$login = "Backend Database Login Successful";
}
else{
$login = "Backend Database Login Failed";
}
}
}
else{
$login = "The username doesn't exist";
}
}
elseif($check == 'teacher')
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
$login = "Backend Database Login Successful";
}
else{
$login = "Backend Database Login Failed";
}
}
}
else{
$login = "The username doesn't exist";
}
}
mysqli_close($connection);

$send = array('DBResponse' => $login); 
echo $login."<br>".$njitauth;


?>
