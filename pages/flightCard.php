<?php
session_start();
include('../partials/_db_connect.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $_SESSION['tripType'] = $_POST['tripType'];
    $departureAirportId = $_POST['demoPlaceDepart'];
    $destinationAirportId = $_POST['demoPlaceDest'];
    $_SESSION['departureDate'] = $_POST['departureDate'];
    $_SESSION['returnDate'] = $_POST['returnDate'];
    $class = $_POST['seatClass'];
    $_SESSION['noOfAdult'] = $_POST['adults'];
    $_SESSION['noOfChildren'] = $_POST['children'];
    $_SESSION['noOfInfants'] = $_POST['infants'];
    $total_passengers = $_SESSION['noOfAdult'] + $_SESSION['noOfChildren'] + $_SESSION['noOfInfants'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Card</title>
    <link rel="stylesheet" href="../assets/navbar.css">
    <link rel="stylesheet" href="flightCard.css">
</head>
<body>
    <?php include('../partials/_navbar.php'); ?>

    <div class="main-flight-container">
        <?php
        $sqlFlightDetails01 = "SELECT
                                o.flight_id as onward_id,
                                o.flight_number as flight_no,
                                o.aircraft_model as aircraft,
                                o.departure_airport_id as da_id,
                                da.location as departure_location,
                                da.area_code as departure_area_code,
                                o.destination_airport_id as dest_id,
                                dest.location as destination_location,
                                dest.area_code as destination_area_code,
                                o.departure_time as dept_time,
                                o.arrival_time as arr_time,
                                o.trip_type as trip,
                                o.flight_status as of_status,
                                o.total_seats as t_seats,
                                o.available_seats as a_seats,
                                sc.class_name as class,
                                sc.price as price,
                                c.c_name as company,
                                r.return_flight_id as rf_id,
                                r.return_flight_number as rf_no,
                                r.return_departure_time as rd_time,
                                r.return_arrival_time as ra_time,
                                r.return_source_id as return_depart,
                                r.return_destination_id as return_dest,
                                r.flight_status as rf_status,
                                r.total_seats as rt_seats,
                                r.available_seats as ra_seats
                                FROM
                                    onward_flights o
                                INNER JOIN 
                                    seat_classes sc ON o.flight_id = sc.flight_id
                                INNER JOIN
                                    airline c ON o.c_id = c.c_id
                                LEFT JOIN
                                    return_flights r ON o.flight_id = r.onward_flight_id
                                INNER JOIN
                                    airport da ON o.departure_airport_id = da.airport_id
                                INNER JOIN
                                    airport dest ON o.destination_airport_id = dest.airport_id
                                ";
                                
        $resultFlightDetails01 = mysqli_query($conn, $sqlFlightDetails01);
        $noOfRows01 = mysqli_num_rows($resultFlightDetails01);

        if($resultFlightDetails01 && ($noOfRows01 > 0)){
            while($row1 = mysqli_fetch_assoc($resultFlightDetails01)){
                // Format Departure Date and Time
                $deptTime = strtotime($row1['dept_time']);
                $deptDate = date('D d M Y', $deptTime);
                $deptTimeFormatted = date('h:iA', $deptTime);

                // Format Arrival Date and Time
                $arrTime = strtotime($row1['arr_time']);
                $arrDate = date('D d M Y', $arrTime);
                $arrTimeFormatted = date('h:iA', $arrTime);

                // Format Return Departure Date and Time (if available)
                if ($row1['rd_time']) {
                    $rdTime = strtotime($row1['rd_time']);
                    $rdDate = date('D d M Y', $rdTime);
                    $rdTimeFormatted = date('h:iA', $rdTime);
                }

                // Format Return Arrival Date and Time (if available)
                if ($row1['ra_time']) {
                    $raTime = strtotime($row1['ra_time']);
                    $raDate = date('D d M Y', $raTime);
                    $raTimeFormatted = date('h:iA', $raTime);
                }

                $on_duration = strtotime($row1['arr_time']) - strtotime($row1['dept_time']);
                $hours = floor($on_duration / 3600);
                $minutes = floor(($on_duration % 3600) / 60);
                $on_duration_formatted = sprintf('%02dhrs : %02dm', $hours, $minutes);

                $rn_duration = strtotime($row1['ra_time']) - strtotime($row1['rd_time']);
                $hours = floor($rn_duration / 3600);
                $minutes = floor(($on_duration % 3600) / 60);
                $rn_duration_formatted = sprintf('%02dhrs : %02dm', $hours, $minutes);

                $on_flight_status = $row1['of_status'];
                $rn_flight_status = $row1['rf_status'];

                if((strtotime($deptDate) >= strtotime($_SESSION['departureDate'])) && ($row1['da_id'] === $departureAirportId) && ($row1['dest_id'] === $destinationAirportId))
                {
                    if(($row1['class'] === $class) && ($row1['trip'] === $_SESSION['tripType'])){
                        echo '<div class="flight-card">';
                        if($_SESSION['tripType'] === 'oneWay' && ($on_flight_status != 'completed' && $on_flight_status != 'canceled' && $on_flight_status != 'in_progress')) {
                            echo '
                            <form action="passengerContactForm.php" method="post">
                                <input type="hidden" name="departureDate" value="'.$_SESSION['departureDate'].'">
                                <input type="hidden" name="returnDate" value="'.$_SESSION['returnDate'].'">
                                <input type="hidden" name="tripType" value="'.$_SESSION['tripType'].'">
                                <input type="hidden" name="price" value="'.$row1['price'].'">
                                <input type="hidden" name="flight_no" value="'.$row1['flight_no'].'">
                                <input type="hidden" name="flight_id" value="'.$row1['onward_id'].'">
                                <input type="hidden" name="departure_location" value="'.$row1['departure_location'].'">
                                <input type="hidden" name="departure_area_code" value="'.$row1['departure_area_code'].'">
                                <input type="hidden" name="destination_location" value="'.$row1['destination_location'].'">
                                <input type="hidden" name="destination_area_code" value="'.$row1['destination_area_code'].'">
                                <input type="hidden" name="depart_date" value="'.$deptDate.'">
                                <input type="hidden" name="depart_time" value="'.$deptTimeFormatted.'">
                                <input type="hidden" name="arrival_time" value="'.$arrTimeFormatted.'">
                                <input type="hidden" name="available_seats" value="'.$row1['a_seats'].'">
                                <input type="hidden" name="total_seats" value="'.$row1['t_seats'].'">
                                <input type="hidden" name="noOfAdult" value="'.$_SESSION['noOfAdult'].'">
                                <input type="hidden" name="noOfChildren" value="'.$_SESSION['noOfChildren'].'">
                                <input type="hidden" name="noOfInfants" value="'.$_SESSION['noOfInfants'].'">
                                
                                <!-- Flight header -->
                                <div class="flight-card-header">
                                    <div class="airline">
                                        <span>'.$row1['company'].'</span>
                                    </div>
                                    <div class="seat-class">
                                        <span>'.$row1['class'].'</span>
                                        <button type="submit" class="price-btn">Buy Now : NPR.'.($row1['price'] * $total_passengers).'</button>
                                    </div>
                                </div>
                            
                                <!-- Flight Route -->
                                <div class="flight-routes-container">
                                    <!-- onward-flight -->
                                    <div class="flight-route onward-flight">
                                        <div class="route-info">
                                            <div class="departure">
                                                <div class="time">'.$deptTimeFormatted.'</div>
                                                <div class="city">'.$row1['departure_location'].', '. $row1['departure_area_code'].'</div>
                                                <div class="date">'.$deptDate.'</div>
                                            </div>
                                        
                                            <div class="flight-duration">
                                                <div class="duration-time">'.$on_duration_formatted.'</div>
                                                <div class="duration-line">
                                                    <span class="dot"></span>
                                                    <span class="line"></span>
                                                    <span class="dot"></span>
                                                </div>
                                            </div>
                                        
                                            <div class="arrival">
                                                <div class="time">'.$arrTimeFormatted.'</div>
                                                <div class="city">'.$row1['destination_location'].', ' .$row1['destination_area_code'].'</div>
                                                <div class="date">'.$arrDate.'</div>
                                            </div>
                                        
                                            <div class="flight-details">
                                                <div class="detail">
                                                    <span class="label">Seats Left:</span>
                                                    <span class="value">'.$row1['a_seats'].'</span>
                                                </div>
                                                <div class="detail">
                                                    <span class="label">Flight:</span>
                                                    <span class="value">'.$row1['flight_no'].'</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>';
                        }

                        // Return Flight
                        if(($_SESSION['tripType'] === 'roundTrip') && isset($rdDate) && strtotime($rdDate) >= strtotime($_SESSION['returnDate']) && ($rn_flight_status != 'completed' && $rn_flight_status != 'canceled' && $on_flight_status != 'in_progress')){
                            echo '
                            <form action="passengerContactForm.php" method="post">
                                <input type="hidden" name="departureDate" value="'.$_SESSION['departureDate'].'">
                                <input type="hidden" name="returnDate" value="'.$_SESSION['returnDate'].'">
                                <input type="hidden" name="tripType" value="'.$_SESSION['tripType'].'">
                                <input type="hidden" name="price" value="'.$row1['price'].'">
                                <input type="hidden" name="flight_id" value="'.$row1['onward_id'].'">
                                <input type="hidden" name="return_flight_id" value="'.$row1['rf_id'].'">
                                <input type="hidden" name="flight_no" value="'.$row1['flight_no'].'">
                                <input type="hidden" name="return_flight_no" value="'.$row1['rf_no'].'">
                                <input type="hidden" name="departure_location" value="'.$row1['departure_location'].'">
                                <input type="hidden" name="departure_area_code" value="'.$row1['departure_area_code'].'">
                                <input type="hidden" name="destination_location" value="'.$row1['destination_location'].'">
                                <input type="hidden" name="destination_area_code" value="'.$row1['destination_area_code'].'">
                                <input type="hidden" name="depart_date" value="'.$deptDate.'">
                                <input type="hidden" name="depart_time" value="'.$deptTimeFormatted.'">
                                <input type="hidden" name="arrival_time" value="'.$arrTimeFormatted.'">
                                <input type="hidden" name="return_date" value="'.$rdDate.'">
                                <input type="hidden" name="return_depart_time" value="'.$rdTimeFormatted.'">
                                <input type="hidden" name="return_arrival_time" value="'.$raTimeFormatted.'">
                                <input type="hidden" name="available_seats" value="'.$row1['a_seats'].'">
                                <input type="hidden" name="total_seats" value="'.$row1['t_seats'].'">
                                <input type="hidden" name="r_available_seats" value="'.$row1['ra_seats'].'">
                                <input type="hidden" name="r_total_seats" value="'.$row1['rt_seats'].'">
                                <input type="hidden" name="noOfAdult" value="'.$_SESSION['noOfAdult'].'">
                                <input type="hidden" name="noOfChildren" value="'.$_SESSION['noOfChildren'].'">
                                <input type="hidden" name="noOfInfants" value="'.$_SESSION['noOfInfants'].'">
                                
                                <!-- Flight header -->
                                <div class="flight-card-header">
                                    <div class="airline">
                                        <span>'.$row1['company'].'</span>
                                    </div>
                                    <div class="seat-class">
                                        <span>'.$row1['class'].'</span>
                                        <button type="submit" class="price-btn">Buy Now : NPR.'.($row1['price'] * $total_passengers).'</button> 
                                    </div>
                                </div>
                            
                                <!-- Flight Route -->
                                <div class="flight-routes-container">
                                    <!-- onward-flight -->
                                    <div class="flight-route onward-flight">
                                        <div class="route-info">
                                            <div class="departure">
                                                <div class="time">'.$deptTimeFormatted.'</div>
                                                <div class="city">'.$row1['departure_location'].', '. $row1['departure_area_code'].'</div>
                                                <div class="date">'.$deptDate.'</div>
                                            </div>
                                        
                                            <div class="flight-duration">
                                                <div class="duration-time">'.$on_duration_formatted.'</div>
                                                <div class="duration-line">
                                                    <span class="dot"></span>
                                                    <span class="line"></span>
                                                    <span class="dot"></span>
                                                </div>
                                            </div>
                                        
                                            <div class="arrival">
                                                <div class="time">'.$arrTimeFormatted.'</div>
                                                <div class="city">'.$row1['destination_location'].', ' .$row1['destination_area_code'].'</div>
                                                <div class="date">'.$arrDate.'</div>
                                            </div>
                                        
                                            <div class="flight-details">
                                                <div class="detail">
                                                    <span class="label">Seats Left:</span>
                                                    <span class="value">'.$row1['a_seats'].'</span>
                                                </div>
                                                <div class="detail">
                                                    <span class="label">Flight:</span>
                                                    <span class="value">'.$row1['flight_no'].'</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flight-route return flights">
                                        <div class="route-info">
                                            <div class="departure">
                                                <div class="time">'.$rdTimeFormatted.'</div>
                                                <div class="city">'.$row1['destination_location'].', ' .$row1['destination_area_code'].'</div>
                                                <div class="date">'.$rdDate.'</div>
                                            </div>
                                                    
                                            <div class="flight-duration">
                                                <div class="duration-time">'.$rn_duration_formatted.'</div>
                                                <div class="duration-line">
                                                    <span class="dot"></span>
                                                    <span class="line"></span>
                                                    <span class="dot"></span>
                                                </div>
                                            </div>
                                                    
                                            <div class="arrival">
                                                <div class="time">'.$raTimeFormatted.'</div>
                                                <div class="city">'.$row1['departure_location'].', '. $row1['departure_area_code'].'</div>
                                                <div class="date">'.$raDate.'</div>
                                            </div>
                                                    
                                            <div class="flight-details">
                                                <div class="detail">
                                                    <span class="label">Seats Left:</span>
                                                    <span class="value">'.$row1['ra_seats'].'</span>
                                                </div>
                                                <div class="detail">
                                                    <span class="label">Flight:</span>
                                                    <span class="value">'.$row1['rf_no'].'</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>';
                        }
                        echo '</div>';
                    }
                }
            }
        }
        ?>
    </div>
</body>
</html>

