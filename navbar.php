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
                        <li class="active"><a href="search.php">Home</a></li>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="#">Page 3</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="index.php?logout=1"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
                    </ul>
                </div>
            </nav>
        </body>
    </html>
</html>
