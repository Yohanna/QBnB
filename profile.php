<?php

// Displays current user info, properties owned. If the user is an admin, display an admin button that will redirects the user to admin.php

define("nl", "<br />");

echo __FILE__ . nl;


//Create a user session or resume an existing one
session_start();

if(isset($_SESSION['user_id'])){
   // include database connection
    include_once 'config/connection.php';

    // SELECT query
        $query = "SELECT FName, LName, user_id, email, password FROM user WHERE user_id=?";

        // prepare query for execution
        $stmt = $con->prepare($query);

        // bind the parameters.
        $stmt->bind_Param("s", $_SESSION['user_id']);

        // Execute the query
        $stmt->execute();

        // results
        $result = $stmt->get_result();

        // Row data
        $myrow = $result->fetch_assoc();

        echo "You're logged on" . nl;

        if ( $myrow['is_admin'] = 1){
            echo "You're an admin" . nl;
        }
        else{
            echo "You're NOT an admin" . nl;
            echo '<pre>';
            var_dump($myrow['is_admin']);
            echo '</pre>';
        }


} else {
    //User is not logged in. Redirect the browser to the login index.php page and kill this page.
    echo "You're not logged in!" . nl;
    header("Location: index.php");
    die();
}


?>


Welcome  <?php echo $myrow['FName'] . ' ' . $myrow['LName']; ?>, <a href="index.php?logout=1">Log Out</a><br/>
