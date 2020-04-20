 <!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>  
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<h1 class="col-8">Add a student to the Student table.</h1>
<!-- button back to the home page -->
<form action="http://www.csce.uark.edu/~cggschwe/DB-Final-Project/HW5.php">
<input type="submit" value="Go Back" class="btn btn-primary"/> </form>
<div class="container col-md-6">
<!-- Form to get user input -->
<!-- includes error handling, incase the field is empty -->
<form action="option1.php" method="post" role="form">
<label for="id" class="col-sm-8 col-form-label">Student ID:</label> 
	 <input class="form-control"type="text" name = "id">
	<?php echo $errID; ?>
<label for="fname" class="col-sm-8 col-form-label">Student First Name:</label>
<input class="form-control" type="text" name = "fname">
	<?php echo $errFname; ?>
<label for="lname" class="col-sm-8 col-form-label">Student Last Name:</label>
	<input class="form-control" type="text" name = "lname">
	<?php echo $errLname; ?>
<label for="major" class="col-sm-8 col-form-label">Student Major:</label> 
	<input class="form-control" type="text" name = "major">
	<?php echo $errMajor; ?>
<input name="submit" type = "submit"class="btn btn-primary">
</form>
<?php
    // variables used
    $id= escapeshellarg($_POST['id']);
    $fname= escapeshellarg($_POST['fname']);
    $lname = escapeshellarg( $_POST['lname']);      
    $major = escapeshellarg( $_POST['major']); 
    // error handling
    if(isset($_POST['submit'])) {
      if(empty($_POST['id'])) {
        $errID= 'Please enter the student id';
      }
      else if(empty($_POST['fname'])) {
        $errFname = 'Please enter the student first name';
      }
      else if(empty($_POST['lname'])) {
        $errLname = 'Please enter the student last name';
      }
      else if(empty($_POST['major'])) {
        $errMajor = 'Please enter the student major';
      } else {
         //  runs java and supplies the program with the function name and parameters
        echo " The form has been submitted. ";
     
     	$command = 'java -cp .:mysql-connector-java-5.1.40-bin.jar HW5 ' .'addStudent' . ' ' .$id. ' ' .$fname. ' ' .$lname. ' '.$major;
	system($command);
      }
    }
  ?>
</div>
</body>
</html>

