<?php 

	//start up the session to once again get the values
	session_start();
	//kill it
	session_destroy();

	
	// include "header.php";

	print "<h1>LOGGED OUT</h1>";

	//saw on website for getting back to original page
	print '<script> window.location = "https://web.njit.edu/~ssd42/	" </script>';
?>