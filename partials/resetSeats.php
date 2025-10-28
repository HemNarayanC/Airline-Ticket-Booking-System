<?php
include '_db_connect.php';

function resetAvailableSeatsForFlights($conn, $table, $flightIdColumn, $departureTimeColumn, $arrivalTimeColumn, $totalSeatsColumn, $availableSeatsColumn) {

    $query = "SELECT `$flightIdColumn`, `$departureTimeColumn`, `$arrivalTimeColumn`, `$totalSeatsColumn` FROM `$table`";
    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($flight = mysqli_fetch_assoc($result)) {
            // print_r($flight);
            $flightId = $flight[$flightIdColumn];
            $departureTime = strtotime($flight[$departureTimeColumn]);
            $arrivalTime = strtotime($flight[$arrivalTimeColumn]);

            if ($c = ($arrivalTime < time())) {

                $totalSeats = $flight[$totalSeatsColumn];

                $updateQuery = "UPDATE `$table` 
                                SET `$availableSeatsColumn` = '$totalSeats' 
                                WHERE `$flightIdColumn` = '$flightId'";
                mysqli_query($conn, $updateQuery);
                if (!mysqli_query($conn, $updateQuery)) {
                    error_log("Error resetting seats for $flightId in $table: " . mysqli_error($conn));
                }
            }
            var_dump($c);
        }
    } else {
        error_log("Error fetching flight data from $table: " . mysqli_error($conn));
    }
}

resetAvailableSeatsForFlights(
    $conn, 
    'onward_flights', 
    'flight_id', 
    'departure_time', 
    'arrival_time', 
    'total_seats', 
    'available_seats'
);

resetAvailableSeatsForFlights(
    $conn, 
    'return_flights', 
    'return_flight_id', 
    'return_departure_time', 
    'return_arrival_time', 
    'total_seats', 
    'available_seats'
);
?>
