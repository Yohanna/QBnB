<?php

/*
* Admin page.
* Shows a list of all available properties in QBnB with CRUD functionality.
* Shows a list of all users who owns a property
*/



require_once 'header.php';
require_once 'navbar.php';

// Check if there's a logged in user
if( userLoggedIn() ) {

  // Check if the logged in user is an admin
  $query = "SELECT is_admin FROM users WHERE user_id=?";

  // prepare query for execution
  if($stmt = $con->prepare($query)){

      $stmt->bind_Param("s", $_SESSION['user_id']);
      $stmt->execute();
      $result = $stmt->get_result();

      $num = $result->num_rows;;

      if($num>0){

          //If the user_id matches a user in our db, get the is_admin value
          $row = $result->fetch_assoc();

          // If the current logged in user is NOT an admin, redirect to profile.php
          if($row['is_admin'] == 0){
              header("Location: profile.php");
              die();
          }
      }

  }
  else {
    echo "Failed to prepare the SQL";
    // If we can't check if the
    header("Location: profile.php");
    die();
  }
}
else { // No logged in user
  header("Location: index.php");
  die();
}

// At this point we should have made sure the current logged in user is an admin

	if (isset($_GET['prop_id'])){
		$id = $_GET["prop_id"];
	}
?>

<<!DOCTYPE html>
<html>
<head>
	<title> Property History </title>
</head>
<body>
	<h1> Property History </h1>
	<div class="container">
		<table class="table table-bordered table-hover" >
            <thead>
            <tr>
              <th>Booking id</th>
              <th>Consumer id</th>
              <th>Checkedin Date</th>
              <th>rateing</th>
            </tr>
            </thead>
            <tbody>
            <?php
            	$str = "SELECT booking_id, status, check_in, tenant_id FROM bookings WHERE property_id = '$id'";
				$result = $con->query($str);
				while($row = mysqli_fetch_array($result)) {
					$book_id = $row["booking_id"];
					$status = $row["status"];
					$checkin = $row["check_in"];
					$tenant_id = $row["tenant_id"];
					$str2 = "SELECT rating FROM comments WHERE property_id='$id' AND commenter_id='$tenant_id'";
					$result2 = $con->query($str);
					$row2 = mysqli_fetch_array($result)
            ?>
            	<td><?php echo $book_id; ?></td>
            	<td><?php echo $tenant_id; ?></td>
            	<td><?php echo $checkin; ?></td>
            	<td><?php echo $row2['rating']; ?></td>
            <?php
            }
            ?>
            </tbody>
	</div>
</body>
</html>