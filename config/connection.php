<?php

$host = "localhost";
$db_name = "qbnb";
$username = "cisc332";
$password = "cisc332password";

try {
    $con = new mysqli($host,$username,$password, $db_name);
}

// show error
catch(Exception $exception){
    echo "DB Connection error: " . $exception->getMessage();
}

?>
