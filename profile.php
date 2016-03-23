<?php

// Displays current user info, properties owned. If the user is an admin, display an admin button that will redirects the user to admin.php


require_once 'header.php';
require_once 'navbar.php';

if(isset($_SESSION['user_id'])){

        echo "You've logged in" . nl;

        // SELECT query
        $query = "SELECT FName, LName, is_admin FROM users WHERE user_id=?";

        // prepare query for execution
        $stmt = $con->prepare($query);

        // bind the parameters.
        $stmt->bind_Param("s", $_SESSION['user_id']);

        // Execute the query
        $stmt->execute();

        // results
        $result = $stmt->get_result();

        // Row data
        $row = $result->fetch_assoc();

        if ( $row['is_admin'] == 1){
            echo "You're an admin" . nl;

            $_SESSION['admin'] = true;

            echo '<a href="admin.php">Click Here to go to admin.php</a>' . nl;
        }
        else{
            echo "You're NOT an admin" . nl;
        }


}
else {
    //User is not logged in. Redirect the browser to the login index.php page and kill this page.
    header("Location: index.php");
    die();
}


?>


Welcome  <?php echo $row['FName'] . ' ' . $row['LName'] . nl; ?>
<a type="button" class="btn btn-primary" href="user_properties.php">Properties Owned</a>
