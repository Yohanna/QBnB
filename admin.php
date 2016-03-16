<?php

// Admin page. Shows a list of all available properties in QBnB with CRUD functionality.

require_once 'header.php';

//Create a user session or resume an existing one
session_start();

// Check again if the logged in user is an admin

$query = "SELECT is_admin FROM user WHERE user_id=?";

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
        $myrow = $result->fetch_assoc();

        // If the current logged in user is NOT an admin, redirect to profile.php
        if($myrow['is_admin'] == 0){
            //Redirect the browser to the profile editing page and kill this page.
            header("Location: profile.php");
            die();
        }
    }
}
else {
    echo "Failed to prepare the SQL";
}

// At this point we should have made sure the current logged in user is an admin

// Display all properties in the db

echo "You're an admin" . nl;

?>


