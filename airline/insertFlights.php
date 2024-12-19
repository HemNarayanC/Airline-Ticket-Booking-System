<?php

include('../partials/_db_connect.php');
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $tripType = $_POST['tripType'];
    $onwardFlightNo = $_POST['flightNumber'];
    $flightName = $_POST['flightName'];
    $aircraftModel = $_POST['aircraftModel'];
    $departureAirport = $_POST['departureAirport'];
    $destinationAirport = $_POST['destinationAirport'];
    $departureDateTime = $_POST['departureTime'];
    $arrivalDateTime = $_POST['arrivalTime'];
    $totalSeats = $_POST['totalSeats'];
    $flightStatus = $_POST['flightStatus'];
    $economyFare = $_POST['economyFare'];
    $businessFare = $_POST['businessFare'];
    $firstClassFare = $_POST['firstClassFare'];

    function getAirportID($airportName, $conn) {
        $selectAirportQuery = "SELECT `airport_id` FROM `aiport` WHERE `airport_name` = '$airportName'";
        $resultAirportID = mysqli_query($conn, $selectAirportQuery);
        $noOfAirport = mysqli_num_rows($resultAirportID);
        if($resultAirportID && ($noOfAirport) > 0) {
            $row = mysqli_fetch_assoc($resultAirportID);
            return $row['airport_id'];
        }
        return null;
    }

    $departureAirportID = getAirportID($departureAirport, $conn);
    if(!$departureAirportID){
        echo "Error: Departure airport : '$departureAirport' not found";
        exit();
    }
    $destinationAirportID = getAirportID($destinationAirport, $conn);
    if(!$destinationAirportID){
        echo "Error: Destination airport : '$destinationAirport' not found";
        exit();
    }
}