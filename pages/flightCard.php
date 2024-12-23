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

    <?php
        include('../partials/_db_connect.php');
        include('../partials/_navbar.php');
        ?>

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
                                o.total_seats as t_seats,
                                sc.class_name as class,
                                sc.price as price,
                                c.c_name as company,
                                r.return_flight_id as rf_id,
                                r.return_flight_number as rf_no,
                                r.return_departure_time as rd_time,
                                r.return_arrival_time as ra_time,
                                r.return_source_id as return_depart,
                                return_depart.location as r_departure_location,
                                return_depart.area_code as r_departure_area_code,
                                r.return_destination_id as return_dest,
                                return_dest.location as r_destination_location,
                                return_dest.area_code as r_destination_area_code
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
                                LEFT JOIN
                                    airport return_depart ON r.return_source_id = return_depart.airport_id
                                LEFT JOIN
                                    airport return_dest ON r.return_destination_id = return_dest.airport_id
                                ";
        $resultFlightDetails01 = mysqli_query($conn, $sqlFlightDetails01);
        $noOfRows01 = mysqli_num_rows($resultFlightDetails01);
        echo $noOfRows01;
        echo "<br>";

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
   
            echo' <div class="flight-card">
            
            <!-- Flight header -->
            <div class="flight-card-header">
            <div class="airline">
            <span>'.$row1['company'].'</span>
            </div>
            <div class="seat-class">
            <span>'.$row1['class'].'</span>
            <span>'.$row1['trip'].'</span>
            <button class="price-btn">Buy Now : NPR.'.$row1['price'].'</button>
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
                            <span class="value">'.$row1['t_seats'].'</span>
                        </div>
                        <div class="detail">
                            <span class="label">Flight:</span>
                            <span class="value">'.$row1['flight_no'].'</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Return Flight -->
            <div class="flight-route return flights">
                <div class="route-info">
                    <div class="departure">
                        <div class="time">'.$rdTimeFormatted.'</div>
                        <div class="city">'.$row1['r_departure_location'].', '. $row1['r_departure_area_code'].'</div>
                        <div class="date">'.$rdDate.'</div>
                    </div>
                            
                    <div class="flight-duration">
                        <div class="duration-line">
                            <span class="dot"></span>
                            <span class="line"></span>
                            <span class="dot"></span>
                        </div>
                    </div>
                            
                    <div class="arrival">
                        <div class="time">'.$raTimeFormatted.'</div>
                        <div class="city">'.$row1['r_destination_location'].', ' .$row1['r_destination_area_code'].'</div>
                        <div class="date">'.$raDate.'</div>
                    </div>
                            
                    <div class="flight-details">
                        <div class="detail">
                            <span class="label">Seats Left:</span>
                            <span class="value">'.$row1['t_seats'].'</span>
                        </div>
                        <div class="detail">
                            <span class="label">Flight:</span>
                            <span class="value">'.$row1['rf_no'].'</span>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- <button type="submit" id="buy-btn">Buy Now</button> -->
        </div>
    </div>';
    }
}
?>
    </div>
</body>

</html>