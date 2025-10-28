<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "skybooker-airline ticket booking system";
    $port = 3309;
    $conn = mysqli_connect($servername, $username, $password, $database, $port);

    if(!$conn){
        die("Error in connecting to database.-->".mysqli_connect_error());
    }

    // else{
    //     echo "Successfully connected to database";
    // }
?>