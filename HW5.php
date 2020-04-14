<html>
	<head><title>Final Project</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
	<body>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

		<h1>Caroline Gschwend & Gillian Dirkson Final Project</h1>
		<form role="form" action="HW5.php" method="post">
			<label for="inputName"class="col-sm-2 col-form-label">Name: </label>
			<input type="text" id="inputName" placeholder="Name" name="name"><br>
   			 <input name="submit" type="submit" class="btn btn-primary">
		</form>
		<h2>Use the following 6 functions to manipulate the Student, Course, and Enrollment databases.</h2>
		<ul>
			<li><a href="option1.php">Add a student to the Student table.</a></li>
			<li><a href="option2.php">Add a course to the Course table.</a></li>
			<li><a href="option3.php">Add an application to the Enrollment table.</a></li>
			<li><a href="option4.php">View all students (display all attributes in the table for each student)</a></li>
			<li><a href="option5.php">View all courses from a given department (display all attributes in the Course table for each course)</a></li>
			<li><a href="option6.php">View all courses for a given student (given the StudentID, display all attributes in the Course table for each course)</a></li>
		</ul>
	</body>
</html>
<?php
if (isset($_POST['submit']))
{
    // replace ' ' with '\ ' in the strings so they are treated as single command line args
    $name = escapeshellarg($_POST[name]);

    $command = 'java hello  ' . $name;

    // remove dangerous characters from command to protect web server
    $command = escapeshellcmd($command);
    echo "<p>command: $command <p>";

    // run jdbc_insert_restaurant.exe
    system($command);
}
?>
