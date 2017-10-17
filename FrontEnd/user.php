

<html>
<link rel="stylesheet" href="testcases/navbar.css">

<?php include "header.php" ?>
<h1>
Hello 
<?php
session_start();
echo $_SESSION['USERNAME'];

?> 
</h1>


<body>
<p>
You are a:
<?php
session_start();
echo $_SESSION['TYPE'];
?>
</p>


<?php 
session_start();
if ($_SESSION['type']=="student"){
	echo "<p> Code that proves you are a student </p>";
}


 ?>


</body>






</html>