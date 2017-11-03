<?php
	session_start(); // in case of sucessful i need to create a session

	// these are the values for debugging for now
	$username = $_POST['username'];	
	$password = $_POST['password'];
	// $type = $_POST['type'];

	// NOTE: This is pointless remove later on
	$field['username'] = $username;
	$field['password'] = $password;
	// $field['type'] = $type;
	$field['call'] = 'login'; // controller value to log in

	$middle = "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/login.php";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$middle);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	$output=curl_exec ($ch);
	curl_close ($ch);
	// echo(gettype($output));

	$output = json_decode($output);
	echo strtolower($output[0]);


	if(strtolower($output[0])=="successful"){
		$_SESSION['USERNAME'] = $username;
		$_SESSION['TYPE'] = strtolower($output[1]);
	}
?> 

