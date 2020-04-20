<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>  
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<h1 class="col-8">Add a course to the Course table.</h1>
<!-- button back to the home page -->
<form action="http://www.csce.uark.edu/~cggschwe/DB-Final-Project/HW5.php">
<input type="submit" value="Go Back" class="btn btn-primary"/> </form>
<div class="container col-md-6">
<!-- Form to get user input -->
<!-- includes error handling, incase the field is empty -->
<form action="option2.php" method="post" role="form">
<label for="id" class="col-sm-8 col-form-label">Department Code:</label> 
	 <input class="form-control"type="text" name = "code">
	<?php echo $errCode; ?>
<label for="fname" class="col-sm-8 col-form-label">Course Number:</label>
<input class="form-control" type="text" name = "number">
	<?php echo $errNumber; ?>
<label for="lname" class="col-sm-8 col-form-label">Title:</label>
	<input class="form-control" type="text" name = "title">
	<?php echo $errTitle; ?>
<label for="major" class="col-sm-8 col-form-label">Hours:</label> 
	<input class="form-control" type="text" name = "hours">
	<?php echo $errHours; ?>
<input name="submit" type = "submit"class="btn btn-primary">
</form>
<?php
    // variables used
    $code= escapeshellarg($_POST['code']);
    $number= escapeshellarg($_POST['number']);
    $title = escapeshellarg( $_POST['title']);      
    $hours = escapeshellarg( $_POST['hours']); 
    // error handling
    if(isset($_POST['submit'])) {
      if(empty($_POST['code'])) {
        $errCode= 'Please enter the department code';
      }
      else if(empty($_POST['number'])) {
        $errNumber = 'Please enter the course number';
      }
      else if(empty($_POST['title'])) {
        $errTitle = 'Please enter the course title';
      }
      else if(empty($_POST['hours'])) {
        $errHours = 'Please enter how many hours the course is';
      } else {
        echo " The form has been submitted. ";
    //  runs java and supplies the program with the function name and parameters
    //receives a print statement 
    $command = 'java -cp .:mysql-connector-java-5.1.40-bin.jar HW5 ' .'addCourse' . ' ' .$code. ' ' .$number. ' ' .$title. ' '.$hours;
	system($command);
      }
    }
  ?>
</div>
</body>
</html>

