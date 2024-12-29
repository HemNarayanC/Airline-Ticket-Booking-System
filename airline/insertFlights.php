<?php

include('../partials/_db_connect.php');
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $c_id = $_SESSION['c_id'];
    $tripType = $_POST['tripType'];
    $onwardFlightNo = $_POST['flightNumber'];
    $flightName = $_POST['flightName'];
    $aircraftModel = $_POST['aircraftModel'];
    $departureAirportId = $_POST['departureAirport'];
    $destinationAirportId = $_POST['destinationAirport'];
    $departureDateTime = $_POST['departureTime'];
    $arrivalDateTime = $_POST['arrivalTime'];
    $totalSeats = $_POST['totalSeats'];
    $flightStatus = $_POST['flightStatus'];
    $economyFare = $_POST['economyFare'];
    $businessFare = $_POST['businessFare'];
    $firstClassFare = $_POST['firstClassFare'];

    $sqlInsertFlight = "INSERT INTO `onward_flights`(`c_id`, `flight_number`, `flight_name`, `aircraft_model`, `departure_airport_id`, `destination_airport_id`, `departure_time`, `arrival_time`, `flight_status`, `trip_type`, `total_seats`, `available_seats`) VALUES ('$c_id','$onwardFlightNo','$flightName','$aircraftModel', '$departureAirportId','$destinationAirportId','$departureDateTime','$arrivalDateTime','$flightStatus','$tripType','$totalSeats', '$totalSeats')";

    $resultInsertFlight = mysqli_query($conn, $sqlInsertFlight);

    if($resultInsertFlight) {

        $flightId = mysqli_insert_id($conn);

        $sqlInsertEconomyFare = "INSERT INTO `seat_classes` (`flight_id`, `class_name`, `price`)
                                VALUES ('$flightId', 'Economy', '$economyFare')";
        $resultEconomy = mysqli_query($conn, $sqlInsertEconomyFare); 
        
        $sqlInsertBusinessFare = "INSERT INTO `seat_classes` (`flight_id`, `class_name`, `price`) 
                                  VALUES ('$flightId', 'Business', '$businessFare')";
        $resultBusiness = mysqli_query($conn, $sqlInsertBusinessFare);

        $sqlInsertFirstClassFare = "INSERT INTO `seat_classes` (`flight_id`, `class_name`, `price`) 
                                    VALUES ('$flightId', 'First_Class', '$firstClassFare')";
        $resultFirstClass = mysqli_query($conn, $sqlInsertFirstClassFare);
        
        if($tripType == 'roundTrip'){
            $returnFlightNo = $_POST['returnFlightNumber'];
            $returnFlightName = $_POST['returnFlightName'];
            $returnDepartureAirportId = $destinationAirportId;
            $returnDestinationAirportId = $departureAirportId;
            $returnDepartureDateTime = $_POST['returnDepartureTime'];
            $returnArrivalDateTime = $_POST['returnArrivalTime'];

            $sqlInsertReturnFlight = "INSERT INTO `return_flights`(`onward_flight_id`, `return_flight_number`, `return_flight_name`, `return_source_id`, `return_destination_id`, `return_departure_time`, `return_arrival_time`) VALUES ('$flightId','$returnFlightNo','$returnFlightName','$returnDepartureAirportId','$returnDestinationAirportId','$returnDepartureDateTime','$returnArrivalDateTime')";

            $resultReturnFlight = mysqli_query($conn, $sqlInsertReturnFlight);

            if(!$resultReturnFlight){
                echo "Error inserting return flight: ".mysqli_error($conn);
                exit();
            }
        }

        if($resultEconomy && $resultBusiness && $resultFirstClass) {
            
            echo "Flight Details have been successfully saved.";
            header('Location: flightManagement.php');
            exit();
        }
    }

    else {
        echo "Error inserting flight details: ". mysqli_error($conn);
    }
}