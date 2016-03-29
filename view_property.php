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
		<div class="col-sm-15">
			<ul class="nav nav-tabs" id="prop_tab">
				<li class="active"><a href="#property" data-toggle="tab"> Property Info </a></li>
				<li><a href="#user_info" data-toggle="tab"> Owner Info </a></li>
				<li><a href="#comments" data-toggle="tab"> Comments </a></li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="property">
					<div class="container col-sm-12">
						<table class="table table-striped">
							<thead>
								<td></td>
								<td></td>
							</thead>
							<tbody>
								<td><span class="badge"> Type: </span></td>
								<td><?php echo $type; ?></td>
							</tbody>
							<tbody>
								<td><span class="badge"> Address: </span></td>
								<td><?php echo $address; ?></td>
							</tbody>
							<tbody>
								<td><span class="badge"> Price: </span></td>
								<td><?php echo $price; ?></td>
							</tbody>
						</table>
					</div>
					<div class="container col-sm-offset-6 col-sm-6">
						<table class="table">
							<thead>
								<td></td>
								<td></td>
							</thead>
							<?php
								$str = "SHOW COLUMNS FROM features";
								$result = $con->query($str);
								while($row = mysqli_fetch_array($result)){
									if ($row['Type'] == 'tinyint(1)'){
										$str2 = "SELECT ".$row['Field']." FROM features WHERE property_id = '$id'";
										$result2 = $con->query($str2);
										$row2 = mysqli_fetch_array($result2);
										$field = $row['Field'];
							?>
							<tbody>
								<td><?php echo $row['Field']; ?></td>
								<td>
									<?php
										if ($row2[$field] == 1)
											echo "Yes";
										else
											echo "No";
									?>
								</td>
							</tbody>
							<?php
									}
								}
							?>
						</table>
					</div>
				</div>
				<div class="tab-pane" id="user_info">
					<div class="container col-sm-12">
						<table class="table table-striped">
							<thead>
								<td></td>
								<td></td>
							</thead>
							<tbody>
								<td><span class="badge"> First Name: </span></td>
								<td><?php echo $FName; ?></td>
							</tbody>
							<tbody>
								<td><span class="badge"> Last Name: </span></td>
								<td><?php echo $LName; ?></td>
							</tbody>
							<tbody>
								<td><span class="badge"> Gender: </span></td>
								<td><?php echo $gender; ?></td>
							</tbody>
							<tbody>
								<td><span class="badge"> Phone #: </span></td>
								<td><?php echo $phone_no; ?></td>
							</tbody>
							<tbody>
								<td><span class="badge"> Grad Year: </span></td>
								<td><?php echo $grad_year; ?></td>
							</tbody>
							<tbody>
								<td><span class="badge"> Faculty: </span></td>
								<td><?php echo $faculty; ?></td>
							</tbody>
							<tbody>
								<td><span class="badge"> Degree: </span></td>
								<td><?php echo $degree_type; ?></td>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane" id="comments">
					
				</div>
			</div>
		</div>
	</div>
</body>
</html>