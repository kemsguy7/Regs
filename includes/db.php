<?php 
    //Set the database information
    defined("DB_USER") ? null : define("DB_USER", "root");
    defined("DB_PASSWORD") ? null : define("DB_PASSWORD", "");
    defined("DB_HOST") ? null : define("DB_HOST", "localhost");
    defined("DB_NAME") ? null : define("DB_NAME", "fecamds");

    //Make the conneciton:
    $mysqli = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

    if (!$mysqli) {
        trigger_error('Could not connect to MySQl: ' . mysqli_connect_error($mysqli));
    } else {
        echo "Connection successful";
    }
?>