<?php
include "header.php" ;
// NOTE: this is a controller of sort that will move around the user depending on which page he wants to go to
session_start();
if($_SESSION["TYPE"]=="teacher"){
	header("Location: teacher.php");
}
elseif($_SESSION['TYPE']=="student"){
	header("Location: student.php");
}
?> 