<?PHP	
	
	$userv = explode("-", $_POST["pendingUser"]);
	$idv = explode("-", $_POST["pendingQuizzes"]);
	
	/*
	$userv = array('sr594', 'sr594', 'sr594');
	$idv = array('1234', '4351', '971');
	*/
	
	// initialization BS
	$test_url = "https://web.njit.edu/~aa944/download/490/TESTS/test.php";
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$test_url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	
	$number = count($userv);
	
	for($i = 0; $i < $number; $i += 1){		
		$field['pendingUser'] = $userv[$i];
		$field['pendingQuiz'] = $idv[$i];
			
		curl_setopt($ch, CURLOPT_POSTFIELDS, $field);	
		$outputTest=curl_exec ($ch);
		$jobjTest = json_decode($outputTest, True);
		echo $outputTest . "<br><br>";
	}
	
	curl_close ($ch);	
	
	echo "ok";
?>