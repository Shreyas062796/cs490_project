<?php include "header.php" ?>


<?php
	if(count($_GET)<1){
		include "templates/loadQuizzes.html";
	}
	else if(count($_GET) > 0){
		include "templates/quiz.html";
	}
	
?>

