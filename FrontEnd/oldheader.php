<?php 
session_start();
if (!isset($_SESSION["TYPE"]))
	header('Location: https://web.njit.edu/~ssd42');
 ?>

 

<html>

<link rel="stylesheet" href="css/template.css">
<script src="js/functions.js"></script> 


<nav id="nav">
  <ul>
	<li class="active"><a href="https://web.njit.edu/~ssd42/user.php"><?php session_start(); echo $_SESSION["USERNAME"]; ?></a></li>
	<!-- <li><a href="#"><?php session_start(); echo $_SESSION["USERNAME"]; ?></a></li> -->
	<?php
	session_start();
	if($_SESSION['TYPE']=="teacher"){
		echo "<li><a href=\"questions.php\">Quiz</a></li>";
	    echo "<li><a href=\"grades.php\">Grades</a></li>";
	}
	elseif($_SESSION['TYPE']=="student"){
		echo "<li><a href=\"takeQuiz.php\">Quiz</a></li>";
	    echo "<li><a href=\"mygrades.php\">Grades</a></li>";
	}
    ?>
    <li><a href="logout.php">Logout</a></li>
  </ul>
  <br>
</nav>



</html>

