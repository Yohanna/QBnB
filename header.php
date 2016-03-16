<?php

define("nl", "<br />");

// include database connection
require_once 'config/connection.php';

// Dump list of variables passed in
function varDump(...$Variables){

    echo '<pre class=container>';
    foreach($Variables as $var){
        var_dump($var);
    }
    echo '</pre>';
}

 // <!-- Latest compiled and minified CSS -->
echo '<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">';

// <!-- jQuery library -->
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>';

// <!-- Latest compiled JavaScript -->
echo '<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>';

?>
