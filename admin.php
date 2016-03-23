<?php

// Admin page. Shows a list of all available properties in QBnB with CRUD functionality.

require_once 'header.php';
require_once 'navbar.php';

// Check if there's a logged in user
if( userLoggedIn() ) {

  // Check if the logged in user is an admin
  $query = "SELECT is_admin FROM users WHERE user_id=?";

  // prepare query for execution
  if($stmt = $con->prepare($query)){

      // bind the parameters.
      $stmt->bind_Param("s", $_SESSION['user_id']);

      // Execute the query
      $stmt->execute();

      // Get Results
      $result = $stmt->get_result();

      // Get the number of rows returned
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
} // session_status() == PHP_SESSION_ACTIVE
else { // No logged in user
  header("Location: index.php");
  die();
}

// At this point we should have made sure the current logged in user is an admin
?>


<html>
<body>

    <h1 class="text-center">Hello Admin</h1>

    <?php
    // Select all properties
    $query = "SELECT property_id, address, district, type, price, FName, LName FROM properties, users where supplier_id = user_id";

    // prepare query for execution
    if($stmt = $con->prepare($query)){

        // Execute the query
        $stmt->execute();

        // Get Results
        $result = $stmt->get_result();

        // Get the number of rows returned
        $num = $result->num_rows;;

        if($num == 0)
          echo "Failed to prepare the SQL";
        else {
        ?>

        <div class="container">
        <h2>Current Properties in QBnB</h2>
        <table class="table table-bordered table-striped" >
        <thead>
        <tr>
          <th>Address</th>
          <th>District</th>
          <th>Type</th>
          <th>Price per month</th>
          <th>Supplier Name</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>

        <?php
          while($row = $result->fetch_assoc()):
        ?>
        <tr>
          <td><?=$row['address'] ?></td>
          <td><?=$row['district']?></td>
          <td><?=$row['type']?></td>
          <td><?=$row['price']?></td>
          <td><?=$row['FName'] . ' ' . $row['LName']?></td>
          <td>
          <a type="button" class="btn btn-info" href="view_property.php?property_id=<?=$row['property_id']?>">View</a>
          <a type="button" class="btn btn-warning" href="edit_property.php?property_id=<?=$row['property_id']?>">Edit</a>
          <a type="button" class="btn btn-danger" href="delete_property.php?property_id=<?=$row['property_id']?>">Delete</a>
          </td>
        </tr>

          <?php
          endwhile; // $row = $result->fetch_assoc()
        } // end else for '$num == 0'
      } // end if $stmt prepare
      ?>
        </tbody>
        </table>
        </div>



</body>
</html>
