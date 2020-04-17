<h1>Add an application to the Enrollment table.</h1>
<form action="http://www.csce.uark.edu/~cggschwe/DB-Final-Project/HW5.php">
<input type="submit" value="Go Back" class="btn btn-primary"/> </form>
<div class="container col-md-6">
<form action="option1.php" method="post" role="form">
<label for="id" class="col-sm-8 col-form-label">Department Code:</label> 
	 <input class="form-control"type="text" name = "deptCode">
	<?php echo $errID; ?>
<label for="fname" class="col-sm-8 col-form-label">Course Number:</label>
<input class="form-control" type="text" name = "cNum">
	<?php echo $errFname; ?>
<label for="lname" class="col-sm-8 col-form-label">Title:</label>
	<input class="form-control" type="text" name = "title">
	<?php echo $errLname; ?>
<label for="major" class="col-sm-8 col-form-label">Hours:</label> 
	<input class="form-control" type="text" name = "hours">
	<?php echo $errMajor; ?>
<input name="submit" type = "submit"class="btn btn-primary">
</form>
</div>
</body>
</html>