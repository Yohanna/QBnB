<?php

// Provide Log In/Out functionality.

require_once 'header.php';
require_once 'navbar.php';

//Create a user session or resume an existing one
session_start();
?>


<!DOCTYPE HTML>
<html>
    <head>
    </head>

    <body>

    <form action="index.php" method="post">
    <div class = "container">
        <!-- <div class = "wrapper"> -->
            <h3 class = "form-signin-heading"> Welcome to QBnB, Please Sign In </h3>
            <hr class = "colorgraph"> <br>

            <input type="text"  class="form-control" name = "email" placeholder = "Email" required="" autofocus=""/>
            <input type="password" class="form-control" name="password" placeholder = "Password" required=""/>

            <input type="submit" class="btn btn-lg btn-primary btn-block" name="loginBtn" value="Log In" />
        <!-- </div> -->
    </div>
    </form>

    </body>
</html>

<?php

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
                echo '<p class="bg-danger">Failed to login</p>' . nl;
            }
        }
        else {
            echo "Failed to prepare the SQL";
        }
 }

?>
