<?php

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'apartmentsystem');
    define('DB_NAME', 'apartment_system');

    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if(!$conn){
        die("Connection Failed: " . mysqli_connect_error());
    }

?>