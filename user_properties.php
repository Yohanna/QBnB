<?php

// User properties page.

require_once 'header.php';
require_once 'navbar.php';

// Resume a session if there's one
session_start();

?>


<html>
<body>
    <?php
	if( isset($_SESSION['isloggedIn']) && $_SESSION['isloggedIn'] == true) {
    // Select all properties
    $query = "SELECT address, district, type, price FROM properties where supplier_id='" . $_SESSION['user_id'] . "'";

    // prepare query for execution
    if($stmt = $con->prepare($query)){

        // Execute the query
        $stmt->execute();

        // Get Results
        $result = $stmt->get_result();

        // Get the number of rows returned
        $num = $result->num_rows;;

        if($num == 0)
          echo "You do not own any properties";
        else {
        ?>

        <div class="container">
        <h1>Properties Owned</h1>
        <table class="table table-bordered table-striped" >
        <thead>
        <tr>
          <th>Address</th>
          <th>District</th>
          <th>Type</th>
          <th>Price per month</th>
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
	}
      ?>
        </tbody>
        </table>
        </div>



</body>
</html>
