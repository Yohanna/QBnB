<head>
<?php

// Provide Log In/Out functionality.

require_once 'header.php';
require_once 'navbar.php';

//Create a user session or resume an existing one
//session_start();
?>
</head>

<html>
<body>
	
	<form action="signup.php" method="post">
    <div class = "container">
        <!-- <div class = "wrapper"> -->
            <h1 class = "form-signin-heading text-center">Sign Up</h3>
            <hr class = "colorgraph"> <br>
			
			First Name: <input type="text" class="form-control" name="FName" placeholder="First Name" maxlength="10" required"" autofocus=""/>
			
			<br>Last Name: <input type="text" class="form-control" name="LName" placeholder="Last Name" maxlength="10" required""/>
			
            <br>Email: <input type="text"  class="form-control" name="email" placeholder="Email" maxlength="32" required="" />
			
            <br>Password: <input type="password" class="form-control" name="password" placeholder="Password" maxlength="32" required=""/>
			
			<br>Re-Type Password: <input type="password" class="form-control" name="re-password" placeholder = "Password" maxlength="32" required=""/>
			
			<br>Gender:<br>
			<input type="radio" name="gender" value="Female" checked="checked">Female
			<input type="radio" name="gender" value="Female">Male<br>
			
			<br>Phone Number: <input type="text" class="form-control" name="phone_no" placeholder="1234567890" maxlength="10" required=""/>
			
			<br>Graduating Year: <input type="text" class="form-control" name="grad_year" placeholder="2016" maxlength="4" required=""/>
			
			<br>Faculty: 
			<select name="faculty_id">
				<option value="1">Arts and Science</option>
				<option value="2">Education</option>
				<option value="3">Engineering and Applied Science</option>
				<option value="4">Commerce</option>
			</select><br>
			
			<br>Degree Type: 
			<select name="degree_type">
				<option value="BA">BA</option>
				<option value="BCMP">BCMP</option>
				<option value="BFA">BFA</option>
				<option value="BMUS">BMUS</option>
				<option value="BPHE">BPHE</option>
				<option value="BSC">BSC</option>
			</select><br>
			
			<!--is_admin = 0 -->

            <br><input type="submit" class="btn btn-lg btn-primary btn-block" name="submitBtn" value="Submit" />
        <!-- </div> -->
    </div>
    </form>
	
	<?php

	if(isset($_POST['submitBtn'])){
	
	// Check if the email already exists
	$query = "SELECT COUNT(*) FROM users WHERE email=?";

		// prepare query for execution
		if($stmt = $con->prepare($query)){

			// bind the parameters.
			$stmt->bind_Param("s", $_POST['email']);

			// Execute the query
			$stmt->execute();

			// Get Results
			$result = $stmt->get_result();

			// Get the number of rows returned
			$num = $result->num_rows;

			// If an email is found
			if($num>0){
				echo '<br><p class="bg-danger text-center">Failed to create account.</p>' . nl;
				die();
			}
		}
		
		// Email not found: Create User
		$query = "INSERT INTO users (FName, LName, gender, email, password, phone_no, grad_year, faculty_id, is_admin, degree_type)
				   VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, ?)";
		
		// prepare query for execution
		$stmt = $con->prepare($query);
		
		// bind the parameters.
		$stmt->bind_param("sssssiiis", $FName, $LName, $gender, $email, $password, $phone_no, $grad_year, $faculty_id, $degree_type);
		
		// Assign values
		$FName=$_POST['FName'];
		$LName=$_POST['LName'];
		$gender=$_POST['gender'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$phone_no=$_POST['phone_no'];
		$grad_year=$_POST['grad_year'];
		$faculty_id=$_POST['faculty_id'];
		$degree_type=$_POST['degree_type'];
		
		// Execute the query
		$stmt->execute();
	}
?>
	
	
	
</body>
</html>

