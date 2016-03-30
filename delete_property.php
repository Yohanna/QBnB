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

if ( isset($_GET['property_id']) && !empty($_GET['property_id'])) {
    $property_id = $_GET['property_id'];
}

if(isset($_POST['deleteBtn'])){
    // Delete the property
    $query = "DELETE FROM properties WHERE property_id = ?";

    $stmt = $con->prepare($query);
    $stmt->bind_Param("i", $property_id);
    if ($stmt->execute() == false){
        echo "Error Deleting Property".nl;
    }
    else {
        header("Location: user_properties.php");
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
                    <h3>Delete Property?</h3>
                </div>
                <form action="delete_property.php?property_id=<?= $property_id?>" method="post">
                    <p class="alert alert-danger">Are you sure you want to delete this property from QBnB?</p>
                    <div class="col-md-offset-4">
                        <button type="submit" name="deleteBtn" class="btn btn-danger btn-lg">Yes</button>
                        <a class="btn btn-default btn-lg" href="user_properties.php">No</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- /container -->
    </body>
</html>
