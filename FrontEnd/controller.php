<?php

session_start();
if (isset($_SESSION["USERNAME"]) && $_SESSION["TYPE"]=="teacher"){
	header('Location: https://web.njit.edu/~ssd42/teacher.php');
}

 ?>
