<?php

// Display properties I have rented and a link to view them
// View_property.php should provide a a way to comment on those properties.


require_once 'header.php';
require_once 'navbar.php';

if(userLoggedIn() == false){
    //User is not logged in. Redirect the browser to the login index.php page and kill this page.
    header("Location: index.php");
    die();
}


?>
