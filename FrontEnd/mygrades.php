<?php
  session_start();
	if ($_SESSION["TYPE"]!="student"){
		header("Location: user.php");
	}
 ?>
<html>
<?php include "header.php";?>
	<head>
	<link rel=stylesheet href="css/grades.css">
	<link rel=stylesheet href="css/tables.css">

	<script src="js/gradeId.js"></script>
	</head>

	<body>

	<!-- <h3> Later Fix make the data into a table with no border/ keeps formatting neat </h1> -->

	<!-- <h3> grade - quiz <br></h3> -->

	<div id="gotText" style="float: center; margin: 18px;">
		<div class="table-title"><h3>My Grades</h3></div>
		<table border="1" id="gradeTable" class="table-fill">
			<thead>
				<tr>
				<th>Grade</th>
				<th>Quiz ID</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
	</body>
</html>