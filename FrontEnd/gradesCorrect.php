<?php
  session_start();
	if ($_SESSION["TYPE"]!="teacher"){
		header("Location: user.php");
	}
 ?>
<html>
<?php include "header.php";?>
	<head>
	<link rel=stylesheet href="css/grades.css">
	<link rel=stylesheet href="css/tables.css">
	<script src="js/functions.js"></script>
	<script src="js/gradesCorrect.js"></script>

	</head>

	<div id="releaseGrades" style="margin: 18px;">
		<div class="table-title"><h3>Student Grades</h3></div>
		<table border="1" id="gradeTable" class="table-fill">
			<thead>
				<tr>
				<th>Student</th>
				<th>Quiz</th>
				<th>Correct</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>

	<p class="pending-message" style="color: red;"></p>

	</div>
	<div id="reply-from-pending"></div>
	<div id="tester"></div>

	</body>
</html>