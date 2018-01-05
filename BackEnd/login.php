<?php
//This is the backend that connects to the database and test when the login has 1;95;0cpassed or failed
$username = $_POST['username'];
$password = $_POST['password'];


$connection = mysqli_connect("sql2.njit.edu", "sr594", "//password", "sr594");
if (!$connection){
die("Connection failed: " . mysqli_connect_error());
}
$arr = array();

$result = mysqli_query($connection,"select COUNT(*) from Login where username = '$username';");
$data = mysqli_fetch_assoc($result);
$output = $data['COUNT(*)'];

if($output = 1)
{
$query="select * from Login where username = '$username';";
$x= mysqli_query($connection,$query);
while($a = mysqli_fetch_assoc($x))
{
$verify = password_verify($password,$a["password"]);
if($verify){
$login = "Successful";
array_push($arr,$login);
array_push($arr,$a["userType"]);
}
else{
$login = "Failed";
}
}
}
$json = json_encode($arr);
echo $json;
mysqli_close($connection);
?>
