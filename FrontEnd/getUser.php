<?php
	session_start();
	if (isset($_SESSION["USERNAME"])){
		echo $_SESSION["USERNAME"];
	}
?>