<?php


?>

<!DOCTYPE HTML>
<html>
<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h3 class="text-center"> Please Fill Out A Search Form </h3>
	</div>
	<form class = "form-horizontal" role = "form">
		<div class = "form-group"> 
			<label class = "control-label col-sm-2" for = "type"> Property Type: </label>
			<div class="col-sm-offset-2 col-sm-10">
				<div class="radio">
					<label class="control-label"><input type="radio" name="radioopt">House</label>
				</div>
				<div class="radio">
					<label class="control-label"><input type="radio" name="radioopt">Town-House</label>
				</div>
				<div class="radio">
					<label class="control-label"><input type="radio" name="radioopt">Apartment</label>
				</div>
				<div class="radio">
					<label class="control-label"><input type="radio" name="radioopt"> Cottage </label>
				</div>
			</div>
		</div>

		<div class = "form-group"> 
			<label class = "control-label col-sm-2" for = "type"> District: </label>
			<div class="col-sm-offset-2 col-sm-10">
				<select class="form-control" id="Distract">
					
				</select>
			</div>
		</div>

		<div class = "form-group"> 
			<label class = "control-label col-sm-2" for = "type"> Point Of Interest: </label>
			
		</div>

		<div class = "form-group"> 
			<label class = "control-label col-sm-2" for = "type"> Features: </label>
			<div class="col-sm-offset-2 col-sm-10">
				<div class="checkbox">
					<label class="control-label"><input type="checkbox"> Internet </label>
				</div>
				<div class="checkbox">
					<label class="control-label"><input type="checkbox"> Gym </label>
				</div>
				<div class="checkbox">
					<label class="control-label"><input type="checkbox"> Pet Allowed </label>
				</div>
				<div class="checkbox">
					<label class="control-label"><input type="checkbox"> TV </label>
				</div>
				<div class="checkbox">
					<label class="control-label"><input type="checkbox"> Parking </label>
				</div>
				<div class="checkbox">
					<label class="control-label"><input type="checkbox"> Patio </label>
				</div>
				<div class="checkbox">
					<label class="control-label"><input type="checkbox"> Laundry Machine </label>
				</div>
			</div>
		</div>
	</form>
</body>
</html>