<?php

require_once 'header.php';

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
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">My Properties
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="add_property.php">Add a property</a></li>
								<li><a href="user_properties.php">Properties Owned</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                    <?php
                    // Display Admin link in navbar if current logged in user is an admin
                    if( isset( $_SESSION['admin']) && $_SESSION['admin'] == true ){
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
