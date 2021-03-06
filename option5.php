<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>  
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<?php
    // variable used
    $dep= escapeshellarg($_POST['dep']);
    // error handling
    if(isset($_POST['submit'])) {
      if(empty($_POST['dep'])) {
        $errDep= 'Please enter the department';
      } else {
        // command to run the java and supplies the java with parameters
	echo " The form has been submitted ";
     	$command = 'java -cp .:mysql-connector-java-5.1.40-bin.jar HW5 ' .'viewCourses' . ' '.$dep;
	system($command);
      }
    }
  ?>
<h1>View all courses from a given department (display all attributes in the Course table for each course)</h1>
<!-- Back button -->
<form action="http://www.csce.uark.edu/~cggschwe/DB-Final-Project/HW5.php">
<input type="submit" value="Go Back" class="btn btn-primary"/> </form>
<div class="container col-md-6">
<!-- Form to get user input -->
<!-- includes error handling, incase the field is empty -->	
<form action="option5.php" method="post" role="form">
		<label for="dep" class="col-sm-8 col-form-label">Department:</label> 
		 <input class="form-control"type="text" name = "dep">
		<?php echo $errDep; ?>
		<input name="submit" type = "submit"class="btn btn-primary">
	</form>
  <?php
    $dep= escapeshellarg($_POST['dep']);
    if(isset($_POST['submit'])) {
      if(empty($_POST['dep'])) {
        $errDep= 'Please enter the department';
      } else {
	echo " The form has been submitted. ";
     
     	$command = 'java -cp .:mysql-connector-java-5.1.40-bin.jar HW5 ' .'viewCourses' . ' '.$dep;
	system($command);
      }
    }
  ?>
</div>
</body>
</html>
