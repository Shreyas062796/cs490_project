<?php include "header.php" ?>

<?php 
	session_start();
	if($_SESSION["TYPE"]=="teacher"){
		include "templates/questions.html";
	}else{
		header('Location: https://web.njit.edu/~ssd42/user.php');
	}
 ?>
