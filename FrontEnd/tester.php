
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
<p>
You are a:
<?php
session_start();
echo $_SESSION['TYPE'];
?>
</p>


</html>