<?php
	session_start();
	// for if sucsessful
	// include "/php/session.php";

	// these are the values for debugging for now
	$username = $_POST['username'];	
	$password = $_POST['password'];
	$type = $_POST['type'];

	// NOTE: This is pointless remove later on
	$field['username'] = $username;
	$field['password'] = $password;
	$field['type'] = $type;


	$middle = 'https://web.njit.edu/~aa944/download/490/MIDDLE.php';

	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$middle);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	$output=curl_exec ($ch);
	curl_close ($ch);
	echo $output;

	$_SESSION['USERNAME'] = $username;
	$_SESSION['TYPE'] = $type;


?> 
