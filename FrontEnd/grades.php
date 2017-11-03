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
	<script src="js/grades.js"></script>
	</head>

	<body>

	<!-- <h3> Later Fix make the data into a table with no border/ keeps formatting neat </h1> -->

	<!-- <h3> Student - grade - quiz <br></h3> -->
	<div id="gotText" style="float: left; margin: 18px;">
		<div class="table-title"><h3>Student Grades</h3></div>
		<table border="1" id="gradeTable" class="table-fill">
			<thead>
				<tr>
				<th>Student</th>
				<th>Quiz</th>
				<th>Grade</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>


	
	<div id="releaseGrades" style="float: right; margin-right: 28px;">
		
		<div class="table-title"><h3>Pending Grades</h3></div>
		<table border="1" id="pendingTable" class="table-fill">
			<thead>
				<tr>
				<th>Student</th>
				<th>Quiz ID</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
	<div id="button-pending" style="float:right"><button onclick="correctPending();" type="button" class="correct-quiz" id="correct-quiz">Correct Pending</button>
	<p class="pending-message" style="color: red;"></p>

	</div>
	<div id="reply-from-pending"></div>
	<!-- this is for when you get a reply from the pending exams -->
	</body>




</html>