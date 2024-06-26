<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sign Up</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="css/montserrat-font.css">
	<link rel="stylesheet" type="text/css" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body class="form-v10">
  <?php
    require('db.php');
	// Check if the admin already exists
	$query_admin = "SELECT * FROM `values` WHERE Role='admin'";
	$result_admin = mysqli_query($con, $query_admin);
	$num_rows = mysqli_num_rows($result_admin);
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['Username'])) {
        // removes backslashes
        $fname = stripslashes($_REQUEST['first_name']);
        $fname = mysqli_real_escape_string($con, $fname);
		if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
			$nameErr = "Only letters and white space allowed";
			echo "<script>alert('$nameErr');</script>";
		}
        $lname = stripslashes($_REQUEST['last_name']);
        $lname = mysqli_real_escape_string($con, $lname);
		if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
			$nameErr = "Only letters and white space allowed";
			echo "<script>alert('$nameErr');</script>";
		}
		$profession = stripslashes($_REQUEST['title']);
        $profession = mysqli_real_escape_string($con, $profession);
        $Institution    = stripslashes($_REQUEST['company']);
        $Institution    = mysqli_real_escape_string($con, $Institution);
        $email    = stripslashes($_REQUEST['your_email']);
        $email    = mysqli_real_escape_string($con, $email);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
			echo "<script>alert('$emailErr');</script>";
		}
        $phone = stripslashes($_REQUEST['phone']);
        $phone = mysqli_real_escape_string($con, $phone);
		if (!preg_match("/^[0-9]+$/", $phone)) {
			$phoneErr = "Only digits allowed";
			echo "<script>alert('$phoneErr');</script>";
		}
        $username = stripslashes($_REQUEST['Username']);
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['Password']);
        $password = mysqli_real_escape_string($con, $password);
        $cpassword = stripslashes($_REQUEST['CPassword']);
        $cpassword = mysqli_real_escape_string($con, $cpassword);
        $role = ''; // Initialize role variable

    	// Check if the admin already exists
    	if ($num_rows == 0) {
        	$role = 'admin'; // Assign the admin role
    	} else {
        	$role = 'user'; // Assign the user role
    	}

    	// Modify your database query to insert the role as well
    	$query = "INSERT into `values` (FirstName, LastName, Profession, Institution, Email, PhoneNo, UserName, Password, CPassword, Role ) 
              	VALUES ('$fname', '$lname', '$profession', '$Institution', '$email', '$phone', '$username', '$password', '$cpassword', '$role')";

    	$result = mysqli_query($con, $query);
    	if ($result) {
        	header('location:../Module 1/index.php');
    	} else {            	
        	echo "<div class='form'>
              	<h3>Required fields are missing.</h3><br/>
              	<p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
              	</div>";
    	}
	}  else {
?>
	<div class="page-content">
		<div class="form-v10-content">
			<form class="form-detail" action="" method="post" id="myform">
				<div class="form-left">
					<h2>General Infomation</h2>
					<div class="form-group">
						<div class="form-row form-row-1">
							<input type="text" name="first_name" id="first_name" class="input-text" placeholder="First Name" required>
						</div>
						<div class="form-row form-row-2">
							<input type="text" name="last_name" id="last_name" class="input-text" placeholder="Last Name" required>
						</div>
					</div>
					<div class="form-row">
						<select name="title" >
							  <option selected disabled>Profession</option>
						    <option class="option" value="Student">Student</option>
						    <option class="option" value="Staff">Staff</option>
						    <option class="option" value="Other">Other</option>
						</select>
						<span class="select-btn">
						  	<i class="zmdi zmdi-chevron-down"></i>
						</span>
					</div>

					<div class="form-row">
						<input type="text" name="company" class="company" id="company" placeholder="Institution" required>
					</div>

					<div class="form-row">
						<input type="text" name="your_email" id="your_email" class="input-text" required placeholder="Email">
					</div>
					<div class="form-row">
						<input type="text" name="phone" class="phone" id="phone" placeholder="Phone Number" required>
					</div>

				</div>
				<div class="form-right">
					<h2>Account Details</h2>
					<div class="form-row">
						<input type="text" name="Username" class="input-text" id="Username" placeholder="Username" required>
					</div>
					<div class="form-row">
						<input type="password" name="Password" class="input-text" id="Password" placeholder="Password" required>
					</div>
					<div class="form-row">
						<input type="password" name="CPassword" class="input-text" id="CPassword" placeholder="Confirm Password" required>
					</div>
					<br/><br/><br/><br/><br/><br/><br/><br/><br/>

					<div class="form-checkbox">
						<label class="container"><p>I do accept the <a href="#" class="text">Terms and Conditions</a> of your site.</p>
						  	<input type="checkbox" name="checkbox">
						  	<span class="checkmark"></span>
						</label>
					</div>
					<div class="form-row-last">
						<input type="submit" name="register" class="register" value="Sign Up" >

					</div>
				</div>
			</form>
		</div>
	</div>
  <?php
    }
?>
</body>
</html>
