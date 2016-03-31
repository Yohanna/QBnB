<?php
require_once 'header.php';
require_once 'navbar.php';
?>

<?php
	
	// If no logged in user is found or if the current logged in user is NOT an admin
if(userLoggedIn() == false || (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == false) ){
    header("Location: profile.php"); // If not logged in user was found, profile.php will redirect to index.php
    die();
}

if ( isset($_GET['booking_id']) && !empty($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];
}

if(isset($_POST['rejectBtn'])){
    // Delete the request
    $query = "UPDATE bookings SET status='2' WHERE booking_id = ?";

    $stmt = $con->prepare($query);
    $stmt->bind_Param("i", $booking_id);
    if ($stmt->execute() == false){
        echo "Error Rejecting Request".nl;
    }
    else {
        header("Location: booking_requests.php");
        die();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    <body>
        <div class="container">
            <div class="col-md-4 col-md-offset-4">
                <div class="row">
                    <h3>Reject Property?</h3>
                </div>
                <form action="reject_request.php?booking_id=<?= $booking_id?>" method="post">
                    <p class="alert alert-danger">Are you sure you want to reject this request?</p>
                    <div class="col-md-offset-4">
                        <button type="submit" name="rejectBtn" class="btn btn-danger btn-lg">Yes</button>
                        <a class="btn btn-default btn-lg" href="booking_requests.php">No</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- /container -->
    </body>
</html>