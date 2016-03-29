<?php

// Display a confirmation that an admin wants to delete a user from  Qbnb.
// This will also delete their properties automatically.

require_once 'header.php';
require_once 'navbar.php';

?>

<?php

// If no logged in user is found or if the current logged in user is NOT an admin
if(userLoggedIn() == false || (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == false) ){
    header("Location: profile.php"); // If not logged in user was found, profile.php will redirect to index.php
    die();
}

if ( isset($_GET['user_id']) && !empty($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Get user name
    $query = "SELECT FName, LName FROM user WHERE user_id = ?";

    $stmt->bind_Param("i", $_GET['user_id']);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $user_name = $row['FName'] . ' ' . $row['LName'];
}

if(isset($_POST['deleteBtn'])){
    // Delete the user
    $query = "DELETE FROM users WHERE user_id = ?";

    $stmt = $con->prepare($query);
    $stmt->bind_Param("i", $user_id);
    if ($stmt->execute() == false){
        echo "Error Deleting User".nl;
    }
    else {
        header("Location: admin.php");
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
                    <h3>Delete <?= $user_name?>?</h3>
                </div>
                <form action="delete_user.php?user_id=<?= $user_id?>" method="post">
                    <p class="alert alert-danger">Are you sure to delete "<?= $user_name ?>" from QBnB?</p>
                    <div class="col-md-offset-4">
                        <button type="submit" name="deleteBtn" class="btn btn-danger btn-lg">Yes</button>
                        <a class="btn btn-default btn-lg" href="admin.php">No</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- /container -->
    </body>
</html>
