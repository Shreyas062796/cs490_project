<?php
	session_start();
	if (isset($_SESSION["USERNAME"])){
		echo "set";
	}
	else{
		echo "notset";
	}
?>