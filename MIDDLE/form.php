<?php
	$var = $_POST["textInput"];
	$anothervar = $_POST["moreInput"];
	echo "The first variable is $var, the second variable is $anothervar!";
	
	if (empty($anothervar))
		print("<br><br>It's empty, this will not work!");
?>