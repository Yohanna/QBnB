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
?>

<html>
<body>

    <h1 class="text-center">User History</h1>
    <?php
      if (isset($_GET['user_id'])){
        $id = $_GET["user_id"];
      }

      $str = "SELECT status, check_in, property_id FROM bookins WHERE";
    ?>
     <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tenant Name</th>
                    <th>Property Address</th>
                    <th>District</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th> <!-- Display buttons to accept, reject -->
                </tr>
            </thead>

            <tbody>
            <?php
              $i = 1;
              while($row_req_rec = $result_rec->fetch_assoc()):
            ?>
                <tr>
                    <td><?= $i; $i++ ?></td>
                    <td>Tenant Name</td>
                    <td><?= $row_req_rec['address'] ?></td>
                    <td><?= $row_req_rec['district'] ?></td>
                    <td><?= $row_req_rec['type'] ?></td>
                    <td><?= $row_req_rec['price'] ?></td>
                    <td>
                    <?php
                        if($row_req_rec['status'] == 1)
                            echo "Confirmed";
                        else if($row_req_rec['status'] == 2)
                            echo "Rejected";
                        else echo "Pending";
                    ?>
                    </td>
                    <td>
                        <a type="button" class="btn btn-success" href="accept_request.php?booking_id=<?=$row_req_rec['booking_id']?>">Accept</a>
                        <a type="button" class="btn btn-danger" href="reject_request.php?booking_id=<?=$row_req_rec['booking_id']?>">Reject</a>
                    </td>
                </tr>

            </tbody>
        </table >
</body>
</html>
