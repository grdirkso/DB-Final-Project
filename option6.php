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
    // variable used in java program
    $id= escapeshellarg($_POST['id']);
    // error handling
    if(isset($_POST['submit'])) {
      if(empty($_POST['id'])) {
        $errID= 'Please enter the student ID';
      } else {
	echo "The form has been submitted";
     	// runs the java program, passes the variables inline
     	$command = 'java -cp .:mysql-connector-java-5.1.40-bin.jar HW5 ' .'viewCoursesForStudent' . ' '.$id;
        echo "<p>command: $command </p>";
	system($command);
      }
    }
  ?>
<h1>View all courses for a given student (given the StudentID, display all attributes in the Course table for each course)</h1>
<!-- back button -->
<form action="http://www.csce.uark.edu/~cggschwe/DB-Final-Project/HW5.php">
<input type="submit" value="Go Back" class="btn btn-primary"/> </form>
<div class="container col-md-6">
<!-- Forms to get user input, includes error handling-->	
<form action="option6.php" method="post" role="form">
		<label for="id" class="col-sm-8 col-form-label">Student ID:</label> 
		 <input class="form-control"type="text" name = "id">
		<?php echo $errID; ?>
		<input name="submit" type = "submit"class="btn btn-primary">
	</form>
</div>
</body>
</html>
