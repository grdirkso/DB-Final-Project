<html>
	<head><title>Final Project</title></head>
	<body>
		<h1>Caroline Gschwend & Gillian Dirkson Final Project</h1>
		<form action="HW5.php" method="post">
    			Name: <input type="text" name="name"><br>
   			 <input name="submit" type="submit" >
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
