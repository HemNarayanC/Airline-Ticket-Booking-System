<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "skybooker-airline ticket booking system";

    $conn = mysqli_connect($servername, $username, $password, $database, 3307);

    if(!$conn){
        die("Error in connecting to database.-->".mysqli_connect_error());
    }

    else{
        echo "Successfully connected to database";
    }
?>