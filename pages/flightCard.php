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
                                o.destination_airport_id as dest_id,
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
                                r.return_arrival_time as ra_time
                                FROM
                                    onward_flights o
                                INNER JOIN 
                                    seat_classes sc ON o.flight_id = sc.flight_id
                                INNER JOIN
                                    airline c ON o.c_id = c.c_id
                                LEFT JOIN
                                    return_flights r ON o.flight_id = r.onward_flight_id
                                ";
        $resultFlightDetails01 = mysqli_query($conn, $sqlFlightDetails01);
        $noOfRows01 = mysqli_num_rows($resultFlightDetails01);
        echo $noOfRows01;
        echo "<br>";

        if($resultFlightDetails01 && ($noOfRows01 > 0)){
            while($row1 = mysqli_fetch_assoc($resultFlightDetails01)){
                    
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
                <div class="time">9:45 am</div>
                <div class="city">Kathmandu, KTM</div>
                <div class="date">12 Oct 2024, Mon</div>
                </div>
                
                <div class="flight-duration">
                <div class="duration-line">
                <span class="dot"></span>
                <span class="line"></span>
                <span class="dot"></span>
                </div>
                </div>
                
                <div class="arrival">
                <div class="time">11:06 am</div>
                <div class="city">Pokhara, PKR</div>
                <div class="date">12 Oct, 2024, Mon</div>
                </div>
                
                <div class="flight-details">
                <div class="detail">
                            <span class="label">Seats Left:</span>
                            <span class="value">10+</span>
                            </div>
                            <div class="detail">
                            <span class="label">Flight:</span>
                            <span class="value">U6-5084</span>
                            </div>
                            </div>
                            </div>
                            </div>
                            <!-- Return Flight -->
                            <div class="flight-route return flights">
                            <div class="route-info">
                            <div class="departure">
                            <div class="time">11:06 am</div>
                            <div class="city">Pokhara, PKR</div>
                            <div class="date">12 Oct, 2024, Mon</div>
                            </div>
                            
                            <div class="flight-duration">
                            <div class="duration-line">
                            <span class="dot"></span>
                            <span class="line"></span>
                            <span class="dot"></span>
                            </div>
                            </div>
                            
                            <div class="arrival">
                            <div class="time">9:45 am</div>
                            <div class="city">Kathmandu, KTM</div>
                            <div class="date">12 Oct 2024, Mon</div>
                            </div>
                            
                            <div class="flight-details">
                            <div class="detail">
                            <span class="label">Seats Left:</span>
                            <span class="value">10+</span>
                            </div>
                            <div class="detail">
                            <span class="label">Flight:</span>
                            <span class="value">U6-5084</span>
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