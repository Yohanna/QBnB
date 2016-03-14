<?php

// Provide Log In/Out functionality.

define("nl", "<br />");

echo __FILE__ . nl;

?>


<!DOCTYPE HTML>
<html>
    <head>
        <title>Welcome to QBnB</title>

    </head>
<body>

 <?php
//Create a user session or resume an existing one
session_start();

//check if the user clicked the logout link and set the logout GET parameter
if(isset($_GET['logout'])){
    //Destroy the user's session.
    $_SESSION['user_id']=null;
    session_destroy();
}


//check if the user is already logged in and has an active session
if(isset($_SESSION['user_id'])){
    //Redirect the browser to the profile editing page and kill this page.
    header("Location: profile.php");
    die();
}


//check if the login form has been submitted
if(isset($_POST['loginBtn'])){

    // include database connection
    include_once 'config/connection.php';

    // SELECT query
        $query = "SELECT user_id, email, password FROM user WHERE email=? AND password=?";

        // prepare query for execution
        if($stmt = $con->prepare($query)){

            // bind the parameters.
            $stmt->bind_Param("ss", $_POST['email'], $_POST['password']);

            // Execute the query
            $stmt->execute();

            // Get Results
            $result = $stmt->get_result();

            // Get the number of rows returned
            $num = $result->num_rows;;

            if($num>0){
                //If the email/password matches a user in our database
                //Read the user details
                $myrow = $result->fetch_assoc();

                //Create a session variable that holds the user's user_id
                $_SESSION['user_id'] = $myrow['user_id'];
                //Redirect the browser to the profile editing page and kill this page.
                header("Location: profile.php");
                die();
            } else {
                //If the email/password doesn't match a user in our database
                // Display an error message and the login form
                echo "Failed to login" . nl;
            }
        }
        else {
            echo "Failed to prepare the SQL";
        }
 }

?>


<!-- dynamic content will be here -->
 <form name='login' id='login' action='index.php' method='post'>
    <table border='0'>
        <tr>
            <td>email</td>
            <td><input type='text' name='email' id='email' /></td>
        </tr>
        <tr>
            <td>Password</td>
             <td><input type='password' name='password' id='password' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' id='loginBtn' name='loginBtn' value='Log In' />
            </td>
        </tr>
    </table>
</form>

</body>
</html>
