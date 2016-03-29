<?php

require_once 'header.php';
require_once 'navbar.php';
	
?>

<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
	<div class="container">
		<h1> Property Details </h1>
		<?php 
			if (isset($_GET['prop_id'])){	
				$id = $_GET["prop_id"];
			}

			$str = "SELECT supplier_id, address, district, type, price FROM properties WHERE property_id = '$id'";
			$result = $con->query($str);
			
			$supp_id; $address; $type; $price;

			while($row = mysqli_fetch_array($result)) {
				$supp_id = $row["supplier_id"];
				$address = $row["address"];
				$type = $row["type"];
				$price = $row["price"];
			}

			$str = "SELECT FName, LName, gender, email, phone_no, grad_year, faculty_id, degree_type FROM users WHERE user_id = '$supp_id'";			
			$result = $con->query($str);

			$FName; $LName; $gender; $email; $phone_no; $grad_year; $faculty_id; $degree_type;
			while($row = mysqli_fetch_array($result)) {
				$LName = $row["LName"];
				$FName = $row["FName"];
				$gender = $row["gender"];
				$phone_no = $row["phone_no"];
				$grad_year = $row["grad_year"];
				$faculty_id = $row["faculty_id"];
				$degree_type = $row["degree_type"];
			}

			$str = "SELECT faculty FROM faculties WHERE faculty_id = '$faculty_id'";
			$result = $con->query($str);

			$faculty;
			while($row = mysqli_fetch_array($result)) {
				$faculty = $row["faculty"];
			}

		?>
		<h2> Owner Info </h2>
	</div>
</body>
</html>