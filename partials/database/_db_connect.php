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

    $sql = "SELECT * from `users`";
    $result = mysqli_query($conn, $sql);

    // Fetch results
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['user_id'] . "<br>";
        echo $row['fname'] . "<br>";
    }
?>