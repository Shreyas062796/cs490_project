<?php 
session_start();
if (!isset($_SESSION["TYPE"]))
	header('Location: https://web.njit.edu/~ssd42');
 ?>



<link rel="stylesheet" href="css/newbar.css">
<script src="js/functions.js"></script> 

<div id="nav-container">
<nav id="nav" role="navigation"> <a href="<?php echo $_SERVER['REQUEST_URI'];?>/#nav" title="Show navigation">Show navigation</a> <a href="#" title="Hide navigation">Hide navigation</a>
      <ul class="clearfix">
    <li><a href="https://web.njit.edu/~ssd42/user.php"><?php session_start(); echo $_SESSION["USERNAME"]; ?></a></li>

    <!-- everything below if php -->
    
    <?php 
    session_start();
    if($_SESSION['TYPE']=="teacher"){
      echo '<li> <a href="questions.php"><span>Quiz</span></a>
            <ul>
          <li><a href="">Create Quiz</a></li>
          <li><a href="">Lookup Questions</a></li>
          <li><a href="">Create Questions</a></li>
        </ul>
          </li>
      <li> <a href="grades.php"><span>Grades</span></a>
            <ul>
          <li><a href="">Lookup Grades</a></li>
          <li><a href="">Grade Exams</a></li>
        </ul>
          </li>';
    }elseif($_SESSION['TYPE']=="student"){
      echo '<li> <a href="takeQuiz.php"><span>Quiz</span></a>
            <ul>
          <li><a href="">Take a Quiz</a></li>
        </ul>
          </li>
      <li> <a href="mygrades.php"><span>Grades</span></a>
            <ul>
          <li><a href="">Lookup Grades</a></li>
        </ul>
          </li>';
    }
    ?>
    <!-- end of the php statements -->
    <li><a href="logout.php">Logout</a></li>
  </ul>
</nav>
</div>

