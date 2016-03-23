<?php

require_once 'header.php';

if( userLoggedIn() ){
    $query = "SELECT FName, LName FROM users WHERE user_id=?";

    $stmt = $con->prepare($query);

    $stmt->bind_Param("s", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}

?>

<html>
    <!DOCTYPE html>
    <html lang="en">
        <head></head>
        <body>
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="search.php">QBnB</a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
                        <li><a href="user_properties.php"><span class="glyphicon glyphicon-home"></span> My Properties</a></li>
                        <li><a href="add_property.php"><span class="glyphicon glyphicon-plus"></span> Add a property</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    <?php
                    // Display who's signed in
                    if(userLoggedIn())
                        echo '<li><p class="navbar-text">Signed in as '.$row['FName'] . ' ' . $row['LName'].'</p></li>';
                    ?>


                    <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                    <?php
                    // Display Admin link in navbar if current logged in user is an admin
                    if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']){
                        echo '<li><a href="admin.php"><span class="glyphicon glyphicon-eye-open"></span> Admin</a></li>';
                    }
                    ?>
                    <li><a href="index.php?logout=1"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
                    </ul>
                </div>
            </nav>
        </body>
    </html>
</html>
