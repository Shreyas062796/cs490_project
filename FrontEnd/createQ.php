<?php
	include "header.php";


	session_start();

	if($_SESSION["TYPE"]=="teacher"){
		include "templates/createQ.html";

	}else{
		header('Location: https://web.njit.edu/~ssd42/user.php');
	}

?>
