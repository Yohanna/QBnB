<?php

// View_property.php should provide a a way to comment on those properties.




require_once 'header.php';
require_once 'navbar.php';

if(userLoggedIn() == false){
    //User is not logged in. Redirect the browser to the login index.php page and kill this page.
    header("Location: index.php");
    die();
}


// This page should only be viewed by Admins or if the _SESSION['user_id'] == _GET['user_id']
if ($_SESSION['is_admin'] == False || ($_SESSION['user_id'] != $_GET['user_id'])){
    header("Location: profile.php");
    die();
}

// Get list of properties that user owns and a request has been made to rent them.


/*
* Request Received
*/
$req_rec_query = "SELECT * FROM bookings NATURAL JOIN properties WHERE supplier_id = ?";

$stmt = $con->prepare($req_rec_query);
$stmt->bind_Param("i", $_GET['user_id']);
$stmt->execute();
$result_rec = $stmt->get_result();

// Number of rows in requests received
$num_req_rec = $result_rec->num_rows;

/*
* Request Made
*/

$req_made_query = "SELECT * FROM bookings NATURAL JOIN properties WHERE tenant_id = ?";

$stmt = $con->prepare($req_made_query);
$stmt->bind_Param("i", $_GET['user_id']);
$stmt->execute();
$result_made = $stmt->get_result();

// Number of rows in requests made
$num_req_made = $result_made->num_rows;

?>


<!DOCTYPE html>
<html>
<head>
    <title>Booking Requests</title>
    <h1 style="text-align: center;">Here's a list of requests you have received or made</h1>
</head>
<body>
    <div class="container">


        <!-- Requests Received -->
        <h2 style="text-align: center;">Requests Received</h2>

        <?php
        if ($num_req_rec > 0){
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
            <?php
            endwhile; // $row_req_rec = $result_rec->fetch_assoc()
            ?>

            </tbody>
        </table >

        <?php
        } // if ($num_req_rec > 0)
        else{ // This user's properties didn't receive any requests
            echo "<h3 class='alert alert-info'>You didn't receive any request so far!</h3>";
        }
        ?>
        </div>

        <br><hr class = "colorgraph"><br>

        <!-- Requests Made -->

        <div class="container">
        <h2 style="text-align: center;">Requests Made</h2>
        <?php
        if ($num_req_made > 0){
        ?>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Supplier Name</th>
                    <th>Property Address</th>
                    <th>District</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th> <!-- Display buttons to cancel request -->
                </tr>
            </thead>

            <tbody>


            <?php
              $i = 1;
              while($row_req_made = $result_made->fetch_assoc()):

            ?>
                <tr>
                    <td><?= $i; $i++ ?></td>
                    <td>Supplier Name</td>
                    <td><?= $row_req_made['address'] ?></td>
                    <td><?= $row_req_made['district'] ?></td>
                    <td><?= $row_req_made['type'] ?></td>
                    <td><?= $row_req_made['price'] ?></td>
                    <td>
                    <?php
                        if($row_req_made['status'] == 1)
                            echo "Confirmed";
                        else if($row_req_made['status'] == 2)
                            echo "Rejected";
                        else echo "Pending";
                    ?>
                    </td>
                    <td>
                        <a type="button" class="btn btn-primary" href="view_property.php?prop_id=<?=$row_req_made['property_id']?>">View</a>
                        <a type="button" class="btn btn-danger" href="cancel_request.php?booking_id=<?=$row_req_made['booking_id']?>">Cancel</a>
                    </td>
                </tr>
            <?php
                endwhile; // $row_req_made = $result_made->fetch_assoc()
            ?>

            </tbody>

        </table>

        <?php
        } // if ($row_req_made > 0)
        else{ // This user didn't make any requests
            echo "<h3 class='alert alert-info'>You didn't make any request so far!</h3>";
        }
        ?>

    </div>
</body>
</html>


