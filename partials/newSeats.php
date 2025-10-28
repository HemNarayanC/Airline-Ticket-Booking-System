<?php
session_start();
include('../partials/_db_connect.php');

global $bookedSeatsCountOutbound, $bookedSeatsCountReturn;

function generateSeats($totalSeats) {
    $columns = ['A', 'B', 'C', 'D', 'E'];
    $seats = [];
    $row = 1;
    for ($i = 1; $i <= $totalSeats; $i++) {
        $seatColumn = $columns[($i - 1) % count($columns)];
        $seats[] = $row . $seatColumn;
        if ($i % count($columns) == 0) {
            $row++;
        }
    }
    return $seats;
}

$tripType = $_SESSION['tripType'];
print_r($tripType);
$flightIdOutbound = $_SESSION['onwardFlightId'];
$totalSeatsOutbound = $_SESSION['ot_seats'];
$availableOnward = $_SESSION['oa_seats'];

$allSeatsOutbound = generateSeats($totalSeatsOutbound);
$passengerCount = $_SESSION['total_passengers'];

/*$queryOutbound = "SELECT `total_seats`, `available_seats` FROM `onward_flights` WHERE `flight_id` = '$flightIdOutbound'";
$resultOutbound = mysqli_query($conn, $queryOutbound);
$flightDataOutbound = mysqli_fetch_assoc($resultOutbound);
print_r($flightDataOutbound);*/
// print_r($allSeatsOutbound);

$bookedSeatsCountOutbound = $totalSeatsOutbound - $availableOnward;
$availableSeatsOutbound = array_slice($allSeatsOutbound, $bookedSeatsCountOutbound);

if($tripType == 'roundTrip'){
    $flightIdReturn = $_SESSION['returnFlightId'];
    $totalSeatsReturn = $_SESSION['rt_seats'];
    $availableReturn = $_SESSION['ra_seats'];

    /*$queryReturn = "SELECT `total_seats`, `available_seats` FROM `return_flights` WHERE `return_flight_id` = '$flightIdReturn'";
    $resultReturn = mysqli_query($conn, $queryReturn);
    $flightDataReturn = mysqli_fetch_assoc($resultReturn);*/

    $bookedSeatsCountReturn =  $totalSeatsReturn - $availableReturn;
    // echo $bookedSeatsCountReturn;
    $allSeatsReturn = generateSeats($totalSeatsReturn);
    $availableSeatsReturn = array_slice($allSeatsReturn, $bookedSeatsCountReturn);
}



if (count($availableSeatsOutbound) < $passengerCount || ($tripType == 'round-trip' && count($availableSeatsReturn) < $passengerCount)) {
    echo "Not enough available seats for one or both flights!";
    exit();
}

$reservedSeats = [];
$reservedReturnSeats = [];

for ($i = 0; $i < $passengerCount; $i++) {
    $reservedSeats[] = array_shift($availableSeatsOutbound);
    if ($tripType == 'roundTrip') {
        $reservedReturnSeats[] = array_shift($availableSeatsReturn);
    }
}

$_SESSION['reservedSeats'] = $reservedSeats;
$_SESSION['reservedReturnSeats'] = $reservedReturnSeats;

// print_r($_SESSION['reservedSeats']);
echo "<br>";
print_r($availableSeatsReturn);
print_r($_SESSION['reservedReturnSeats']);
// print_r($totalSeatsReturn);
// print_r($availableReturn);
?>
