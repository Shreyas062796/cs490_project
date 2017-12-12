<?php
	//$call = $_POST['call'];
	$data = $_POST;
	$call = $_POST['call'];
	
	$url = array(
		"loadAllQuestions" => "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/getQuestions.php",
		"getQuizzes" => "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/getQuizzes.php",
		"login" => "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/login.php",
		"getAllGrades" => "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/getAllGrades.php",
		"getTakenQuizzes" => "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/getTakenQuizzes.php",
		"getStudentGrade" => "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/getStudentGrade.php",
		"createQuizzes" => "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/createQuizzes.php",
		"enterTakenQuizzes" => "https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/enterTakenQuizzes.php",
		"gradeQuizzes" => "https://web.njit.edu/~aa944/download/490/TESTS/gradeQuizzes.php"
	);
	
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);	
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	
	
	curl_setopt($ch, CURLOPT_URL,$url["$call"]);
	$output=curl_exec($ch);
	echo $output;
	
	curl_close ($ch);
?>