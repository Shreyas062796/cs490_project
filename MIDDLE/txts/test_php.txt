<?PHP
	ini_set('display_errors',1);
	
	//this script will only work with a certain user and quiz_id
	
	$user = $_POST['pendingUser'];
	$id = $_POST['pendingQuiz'];
	
	//get the taken quizes
		$takenQuizesURL = 'https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/getAllTakenQuizzes.php';
		
		// initialization BS
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$takenQuizesURL);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		$outputTakenQuizes=curl_exec ($ch);
		curl_close ($ch);	
		$jobjTakenQuizes = json_decode($outputTakenQuizes, True);
		
		//echo "$outputTakenQuizes<br><br>";
		
		
	//get the the test cases
		$questionsURL = 'https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/getQuestions.php';
		
		// initialization BS
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$questionsURL);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		$outputQuestions=curl_exec ($ch);
		curl_close ($ch);	
		$jobjQuestions = json_decode($outputQuestions, True);
	
		//echo "$outputQuestions";
	
	//for each response in the table, save the answer
		$tabs = "&nbsp &nbsp &nbsp";
		$score = 0;
		$potential_score = 0;
		$found = FALSE;
		//echo "GRADING USER: ". $user . " QUIZ_ID: " . $id . "<br>";
		
		for($x = 0; $x < count($jobjTakenQuizes); $x += 1){
			
			$question_id = $jobjTakenQuizes[$x]['question_id'];
			$username = $jobjTakenQuizes[$x]['username'];
			$quiz_id = $jobjTakenQuizes[$x]['quiz_id'];			
			
			if($username != $user || $quiz_id != $id){				
				continue;
			}
			$found = TRUE;	
			
			//echo "$x)<br>";
			
			//echo "question_id: " . $question_id . "<br>";
			
			
			
			$studentAnswer = $jobjTakenQuizes[$x]['StudentAnswer'];
			$studentAnswer = str_replace("\n", "", $studentAnswer);
			
			if(!empty($studentAnswer)){
				$funcName = $jobjQuestions[$question_id - 1]["FuncName"];
				//echo $studentAnswer . "<br><br>";
				//read keywords, like function name	
				$studentAnswerv = explode(" ", $studentAnswer);
				
				
				for($k = 0; $k < count($studentAnswerv); $k += 1){
					if ($studentAnswerv[$k] == "def"){
						$function_name = $studentAnswerv[$k + 1];						
						$paren_index = strrpos($function_name, "(");
						$function_name = substr($function_name, 0, $paren_index);

						if($function_name == $funcName){							
							$score += 1;							
							$potential_score += 1;
						}else{
							$potential_score += 1;
						}
					}
				}
				
				//echo "<br><br>FUCNTION NAME IS $function_name";		
				
				
				$studentAnswer = str_replace(" ", "_", $studentAnswer);
				$studentAnswer = str_replace("(", "[", $studentAnswer);
				$studentAnswer = str_replace(")", "]", $studentAnswer);
				
				//echo "STUDENT ANSWER $studentAnswer";
				
				//for each test case
				for($i = 1; $i < 4; $i += 1){	
					//get test case parameters
					$tcp_query = "tc" . strval($i);
					$tca_query = "tca" . strval($i);
					
					$tcp = explode(" ", $jobjQuestions[$question_id - 1]["$tcp_query"]);
					$tca = $jobjQuestions[$question_id - 1]["$tca_query"];
					$tca = intval($tca);
					
					
					$parameter_size = count($tcp);
					
					//generate python command
					$py_command = "python /afs/cad/u/a/a/aa944/public_html/download/490/TESTS/test.py";
					$py_command .= " $function_name";
					$py_command .= " $studentAnswer";
					//$py_command .= " $studentAnswer";
					for($j = 0 ; $j < $parameter_size; $j += 1){
						$parameter = intval($tcp[$j]);
						$py_command .= " $parameter";
					}
					/*
					
					$tcp2 = intval($tcp[1]);
					*/
					
					//echo "<br>$py_command<br><br>";
					
					//execute the the temp_student_answer file with test cases
					//echo $py_command . "<br>";
					$answer = shell_exec($py_command);
					
					$answer = intval($answer);
					
					if($answer == $tca){
						$grade = "pass";
						$score += 1;
					}
					else
						$grade = "fail";
					
					$potential_score += 1;					
					echo $tcp_query . ": " . $grade ."<br>";
				}			
				//call curl to send grades to the database
			}else{				
				$potential_score += 1;
			}
			
		}
		
		if($potential_score != 0)
			$overall_score = $score / $potential_score * 100;
		else
			$overall_score = 0;
		
		echo "GRADE " . $overall_score;
		
		//echo "SCORE: " . $overall_score . "<br>";
		
		//get the grade for student
		$getGradesURL = 'https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/getStudentGrade.php';
		$field['StudentUserName'] = 'sr594';
		// initialization BS
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$getGradesURL);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		$outputGetGrades=curl_exec ($ch);
		curl_close ($ch);	
		$jobjGetGrades = json_decode($outputGetGrades, True);
		
		//print($outputGetGrades);		
		
		//send the grade for student
		//echo "Grade Entered!";
		if($found){
			$enterGradesURL = 'https://web.njit.edu/~sr594/cs490Project/Backend/BackEnd/enterGrades.php';
			$field['StudentName'] = $user;
			$field['QuizId'] = $id;
			$field['Score'] = $overall_score;
			// initialization BS
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$enterGradesURL);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
			$outputEnterGrades=curl_exec ($ch);
			curl_close ($ch);	
			//echo "QUIZ NAME: $outputEnterGrades";
			$jobjEnterGrades = json_decode($outputEnterGrades, True);		
		}
?>