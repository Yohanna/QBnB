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
					<?php
						$str = "SELECT pic_path FROM pictures WHERE property_id = '$id'";
						$result = $con->query($str);
						$row = mysqli_fetch_array($result);
						$pic_path;
						if ($row['pic_path'] == null || $row['pic_path'] == "") {
							$pic_path = "property_pics/no-image.png";
						} else {
							$pic_path = $row['pic_path'];
						}
					?>
					<div class="row">
						<div class="col-sm-6">
							<img src="<?php echo $pic_path ?>" style="max-width: 100%; max-height: 100%; height: auto;">
						</div>
						<div class="col-sm-6">
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
					<?php 
						if (isset($_SESSION['isloggedIn']) && $_SESSION['isloggedIn']){
							$str = "SELECT * FROM bookings WHERE tenant_id =".$_SESSION['user_id'];
							$result = $con->query($str);
							$row = mysqli_fetch_array($result);
							if ($row['booking_id'] != null && $row['booking_id'] != "") {
								echo "<button type='button' class='btn btn-primary'> Comment </button>";
							}
						}
					?>
					<div>
						<ul class="list-group" style="list-style-type: none; padding-top: 10px;">
							<?php 
								$str = "SELECT commenter_id, rating, comments.timestamp, comment_text FROM comments WHERE property_id = '$id'";
								$result = $con->query($str);
								$i = 0;
								while($row = mysqli_fetch_array($result)){
									if ($i == 1)
										$i = 5;
									else 
										$i = 1;
									$commenter = $row['commenter_id'];
									$rating = $row['rating'];
									$time = $row['timestamp'];
									$text = $row['comment_text'];
									$str2 = "SELECT FName, LName FROM users WHERE user_id = '$commenter'";
									$result2 = $con->query($str2);
									$row2 = mysqli_fetch_array($result2);
									$name = $row2['FName'] . " " . $row2['LName']; ?>
							<li class="listing-group-item col-sm-offset-<?php echo $i; ?> col-sm-6" style="border-style: double;">
								<div class="row">
									<div class="col-md-3"><?php echo $name; ?></div>
									<div class="col-md-4"><?php echo $time; ?></div>
									<div class="col-md-2"><?php echo $rating; ?></div>
								</div>
								<div class="container">
									<p> <?php echo $text; ?></p>
								</div>
							</li>	
							<?php		
								}	
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>