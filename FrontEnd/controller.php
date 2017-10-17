<?php 
	ob_start();
	ob_clean()
;	session_start();
	// just some preset usefull funciton
	function sendPost($address, $data_array){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$adress);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_array);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		$output=curl_exec ($ch);
		curl_close ($ch);
		return $output;
	}

	// function loadPage($page){
	// 	ob_end_clean();
	// 	header('Location: tester.php');
	// 	exit;
	// 	ob_end_clean();
	// }

	$_SESSION["USERNAME"] = "johnnyB";
	$_SESSION["TYPE"] = "teacher";
	loadPage("index.php");



	// if(isset($_POST)){

	// 	$middle = 'https://web.njit.edu/~aa944/download/490/MIDDLE.php'; // login page that calls back
	// 	$command = $_POST['cmd'];
	// 	// print(command);

	// 	if($command=='login'){
	// 		$username = $_POST['username'];	
	// 		$password = $_POST['password'];

	// 		// use this to get the right variables
	// 		$logForm['username'] = $username;
	// 		$logForm['password'] = $password;
	// 		$logForm['type'] = $type;


	// 		$reply = sendPost($middle, $logForm);
	// 		echo $reply; //send it back to ajax

	// 		if(strtolower($reply)=="successful"){

				
	// 			$_SESSION["USERNAME"] = $username;
	// 			$_SESSION["TYPE"] = $type;
	// 			loadPage("index.php");
	// 		}
	// 	}
	// }
 ?>
