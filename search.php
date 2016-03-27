<?php

require_once 'header.php';
require_once 'navbar.php';
	
?>

<!DOCTYPE HTML>
<html>
<head>
</head>
<body>

<?php
	if (isset($_POST)) { 
			$type;
			$price;
			$feature;
			if (!(empty($_POST["type"])))
				$type = $_POST["type"];
			$district = $_POST["district"];
			$poi = $_POST["poi"];
			if (!(empty($_POST["features"])))
				$feature = $_POST["features"];
			if (!(empty($_POST["type"])))
				$price = $_POST["price"]



		?>
		<div class="container">
			<h1> Search Result </h1>
			<table class="table table-hover"> 
				<thead>
					<tr>
						<th> Owner </th>
						<th> Address </th>
						<th> District </th>
						<th> Type </th>
						<th> Price </th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
	<?php }
?>


	<div class="container">
		<h3 class="text-center"> Please Fill Out A Search Form </h3>
	</div>
	<form action="search.php" method="post" class = "form-horizontal" role = "form">
		<div class = "form-group">
			<label class = "control-label col-sm-2" for = "type"> Property Type: </label>

			<div class="col-sm-offset-2 col-sm-10">
				<?php
					$str = "SELECT distinct type FROM properties";
					$result = $con->query($str);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							
				?>
				<div class="radio">
					<label class="control-label"><input type="radio" name="radioopt">
						<?php
							echo $row['type'];
						?>
					</label>
				</div>
							<?php 
						}
					}
				?>
			</div>
		</div>

		<div class = "form-group">
			<label class = "control-label col-sm-2" for = "district"> District: </label>
			<div class="col-sm-offset-2 col-sm-10">
				<select class="form-control" id="Distract">
					<?php
						$str = "SELECT Distinct District FROM districts";
						$result = $con->query($str);
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
					?>
					<option>
						<?php
							echo $row['District'];
						?>
					</option>
					<?php
							}
						}
					?>
				</select>
			</div>
		</div>

		<div class = "form-group">
			<label class = "control-label col-sm-2" for = "poi"> Point Of Interest: </label>
				<div class="col-sm-offset-2 col-sm-10">
				<select class="form-control" id="Distract">
					<?php
						$str = "SELECT Distinct POI FROM districts";
						$result = $con->query($str);
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
					?>
					<option>
						<?php
							echo $row['POI'];
						?>
					</option>
					<?php
							}
						}
					?>
				</select>
			</div>
		</div>

		<div class = "form-group">
			<label class = "control-label col-sm-2" for = "features"> Features: </label>
			<div class="col-sm-offset-2 col-sm-10">
				<?php
					$str = "SHOW COLUMNS FROM features";
					$result = $con->query($str);
					while($row = mysqli_fetch_array($result)){
						if ($row['Type'] == 'tinyint(1)'){
				?>
				<div class="checkbox">
					<label class="control-label"><input type="checkbox">
						<?php
							echo $row['Field'];
						?>
					</label>
				</div>
				<?php
						}
					}
				?>
			</div>
		</div>

		<div class = "form-group">
			<label class = "control-label col-sm-2" for = "price"> Price Range: </label>

			<div class="col-sm-offset-2 col-sm-10">
				<?php
					$str = "SELECT MAX(price) AS mx FROM properties";
					$str2 = "SELECT MIN(price) AS mn FROM properties";

					$result = $con->query($str);
					$result2 = $con->query($str2);
					if ($result->num_rows > 0) {
						$row = $result->fetch_assoc();
						$max = $row['mx'];	
						$range = $max/5.0;
						
						$row2 = $result2->fetch_assoc();
						$min = $row2['mn'];

						$range = ($max - $min) / 5; 

						for ($i = 0; $i < 5; $i++){
							
				?>
				<div class="radio">
					<label class="control-label"><input type="radio" name="radioopt">
						<?php
							echo ($range * $i +  $min) . "-" . ($range * ($i+1) + $min);
						?>
					</label>
				</div>
				<?php
						}
					}
				?>

				<div class="form-group"> 
    				<div class="col-sm-offset-2 col-sm-10">
   				    	<button type="submit" class="btn btn-default" name="submit">Submit</button>
  					</div>
  				</div>
			</div>
		</div>
	</form>
</body>
</html>
