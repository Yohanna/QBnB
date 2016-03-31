<?php

require_once 'header.php';
require_once 'navbar.php';

if (userLoggedIn() == false){
	header("Location: index.php");
	die();
}

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

			if (isset($_POST['submit'])) {
				$rate = $_POST["rate"];
				$comment_txt = $_POST["comment"];
				$time = date('Y-m-d G:i:s');
				$str = "INSERT INTO comment (commenter_id, property_id, comment_text, rating, timestamp) VALUES
				(". $_SESSION["user_id"].",'$id','$comment_txt','$rate','$time');";
				$result = $con->query($str);
				if (!($result))
					echo "Insertion Error AT Comment";
				else
					echo "<div class='alert alert-success'>
 						Your request is placed successfully.
						</div>";
			}

			if (isset($_POST['request'])) {
				if(!(empty($_POST["checkin"])))
					$checkin_date = $_POST["checkin"];
				$str = "INSERT INTO bookings (status, check_in, property_id, tenant_id) VALUES
				(3,'$checkin_date','$id',". $_SESSION["user_id"].")";
				$result = $con->query($str);
				if (!($result))
					echo "Insertion Error AT Request";
				else
				?>
					<script type="text/javascript">
					alert("Your request has been sent.");
					window.location.href = "search.php";
					</script>
			<?php }

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

		<?php
			$str = "SELECT status FROM bookings WHERE tenant_id=".$_SESSION['user_id']." And property_id = '$id'";
			$result = $con->query($str);
			$row = mysqli_fetch_array($result);
			echo "<form action='view_property.php?prop_id=".$id."' method='post' class = 'form-horizontal' role = 'form'>";
			echo "<div class = 'form-group'>";
			if (($row['status'] != null && $row['status']!="") && $row['status'] == 3)
				echo "<button type='button' class='btn btn-default disabled'>Request Under Processing </button>";
			else {
				echo "<div class='row col-sm-offset-0'>";
				echo "<div class='col-md-1'>";
				echo "<label for = 'date'> Check In Date: </label>";
				echo "</div>";
				echo "<div class='col-sm-2'>";
				echo "<input type='date' name='checkin' required>";
				echo "</div>";
				echo "<div class='col-sm-2'>";
				echo "<button type='submit' class='btn btn-success' name='request'>Send Request</button>";
				echo "</div>";
				echo "</div>";
			}
			echo "</div>";
			echo "</form>";
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
					<div class="container" style="position: absolute; top: 500px;">
						<?php
							$str = "SELECT * FROM bookings WHERE property_id='$id' AND status = 1 AND tenant_id =".$_SESSION['user_id'];
							$result = $con->query($str);
							$str2 = "SELECT comment_id FROM comments WHEREproperty_id='$id' AND tenant_id =".$_SESSION['user_id'];
							$result2 = $con->query($str2);
							if ($result->num_rows > 0 && $result->num_rows > $result2->num_rows) { ?>
								<form action="view_property.php?prop_id='$id'" method="post" class="form-horizontal" role="comment">
									<div class="form-group">
										<div>
											<label class = "control-label col-sm-2" for = "type"> Your Rating: </label>
											<label class="radio-inline"><input type="radio" name="rate" value="1">1</label>
											<label class="radio-inline"><input type="radio" name="rate" value="2">2</label>
											<label class="radio-inline"><input type="radio" name="rate" value="3">3</label>
											<label class="radio-inline"><input type="radio" name="rate" value="4">4</label>
											<label class="radio-inline"><input checked="" type="radio" name="rate" value="5">5</label>
										</div>
									</div>
									<div class="form-group">
										<div>
											<label class = "control-label col-sm-2" for = "type"> Comment Here: </label>
											<textarea class="form-control" rows="5" id="comment"></textarea>
										</div>
									</div>
									<div class="form-group">
    									<div class="col-sm-offset-10 col-sm-2">
   				    						<button type="submit" class="btn btn-default" name="submit"> Comment </button>
  										</div>
  									</div>
								</form>
							<?php }
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
