<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>  
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<h1 class="col-8">Add an application to the Enrollment table.</h1>
<!-- button back to the home page -->
<form action="http://www.csce.uark.edu/~cggschwe/DB-Final-Project/HW5.php">
<input type="submit" value="Go Back" class="btn btn-primary"/> </form>
<div class="container col-md-6">
<!-- form to get all user input -->
<!-- includes error handling incase a field is left empty -->
<form action="option3.php" method="post" role="form">
<label for="id" class="col-sm-8 col-form-label">Student ID:</label> 
	 <input class="form-control"type="text" name = "sID">
	<?php echo $errSID; ?>
<label for="fname" class="col-sm-8 col-form-label">Department Code:</label>
<input class="form-control" type="text" name = "code">
	<?php echo $errCode; ?>
  <label for="fname" class="col-sm-8 col-form-label">Course Number:</label>
<input class="form-control" type="text" name = "number">
	<?php echo $errNumber; ?>
<input name="submit" type = "submit"class="btn btn-primary">
</form>
<?php
    // error handling
    $sID= escapeshellarg($_POST['sID']);
    $code= escapeshellarg($_POST['code']);
    $number= escapeshellarg($_POST['number']);
    if(isset($_POST['submit'])) {
      if(empty($_POST['sID'])) {
        $errSID= 'Please enter the student ID';
      }
      else if(empty($_POST['code'])) {
        $errCode = 'Please enter the department code';
      }
      else if(empty($_POST['number'])) {
        $errNumber = 'Please enter the course number'; 
      } else {
        echo " The form has been submitted. ";
      //  runs java and provides program with function name and parameters
      //receives a print statement
       $command = 'java -cp .:mysql-connector-java-5.1.40-bin.jar HW5 ' .'addApplication' . ' ' .$sID. ' '.$code. ' '.$number;
	system($command);
      }
    }
  ?>
</div>
</body>
</html>

