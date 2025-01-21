<?php

include('../partials/_db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $flightId = $_GET['air_id'];
    $flightType = $_GET['flight_type'];

    if ($flightType == 'onward') {
        $deleteOnwardQuery = "DELETE FROM `onward_flights` WHERE `flight_id` = '$flightId'";
        if (mysqli_query($conn, $deleteOnwardQuery)) {
            header('Location: viewFlight.php');
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    if ($flightType == 'return') {
        $deleteReturnQuery = "DELETE FROM `return_flights` WHERE `return_flight_id` = '$flightId'";
        if (mysqli_query($conn, $deleteReturnQuery)) {
            header('Location: viewFlight.php');
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

?>
