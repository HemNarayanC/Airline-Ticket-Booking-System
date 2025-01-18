<?php

include ('../partials/_db_connect.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $flightId = $_POST['id'];
    $flightType = $_POST['flight_type'];
    
    if ($flightType == 'onward') {
        $departureTime = $_POST['onward_departure_time'];
        $arrivalTime = $_POST['onward_arrival_time'];
        $flightStatus = $_POST['flight_status'];

        $updateOnwardQuery = "UPDATE `onward_flights` 
                            SET `departure_time` = '$departureTime',
                                `arrival_time` = '$arrivalTime',
                                `flight_status` = '$flightStatus'
                            WHERE `flight_id` = '$flightId'";

        if (mysqli_query($conn, $updateOnwardQuery)) {
            header('Location: viewFlight.php');
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    if ($flightType == 'return') {
        $returnDepartureTime = $_POST['return_departure_time'];
        $returnArrivalTime = $_POST['return_arrival_time'];
        $flightStatus = $_POST['flight_status'];

        $updateReturnQuery = "UPDATE `return_flights` 
                            SET `return_departure_time` = '$returnDepartureTime',
                                `return_arrival_time` = '$returnArrivalTime',
                                `flight_status` = '$flightStatus'
                            WHERE `return_flight_id` = '$flightId'";

        if (mysqli_query($conn, $updateReturnQuery)) {
            header('Location: viewFlight.php');
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

?>