


<?php
    include '../partials/_db_connect.php';

    // Check if the booking is already processed
    if (isset($_SESSION['booking_processed']) && $_SESSION['booking_processed'] === true) {
    // If processed, skip further processing or redirect
    echo "Booking already completed. Please check your booking details.";
    exit();
}

    $tripType = $_SESSION['tripType'];

    function generateBookingNumber(){
        $_SESSION['booking_no'] = 'SY-B' . strtoupper(dechex(rand(100, 999))) . time();
        $booking_no = $_SESSION['booking_no'];
        return $booking_no;
    }

    $userId = $_SESSION['user-id'];
    $totalFare = $_SESSION['totalPrice'];

    function generateTicketNumber() {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomLetters = substr(str_shuffle($letters), 0, 2);
        $randomNumbers = rand(1000, 9999);
        return 'SKY-B-' . $randomLetters . $randomNumbers;
    }

    if(isset($_SESSION['booking_details']) && !empty($_SESSION['booking_details'])) {

        $booking = $_SESSION['booking_details'];
        $flightsOn = $booking['flights'][0];
        $flightId = $flightsOn['flight_id'];

        $flightsRn = $booking['flights'][1];
        $flightIdRn = $flightsRn['flight_id'];
        $tripType = $_SESSION['tripType'];

        $bnOnward = generateBookingNumber();
        $bnReturn = $tripType === 'roundTrip' ? generateBookingNumber() : null;
        $tnOnward = generateTicketNumber();
        $tnReturn = $tripType === 'roundTrip' ? generateTicketNumber() : null;

            if (mysqli_query($conn, $insertBookingQuery)) {
            $bookingId = mysqli_insert_id($conn);

            // Insert passenger details
            $passengers = $booking['passenger_details'];

            foreach ($passengers as $passenger) {
                $firstName = $passenger['first_name'];
                $surname = $passenger['surname'];
                $gender = $passenger['gender'];
                $nationality = $passenger['nationality'];
                $age = $passenger['age'];

                $insertPassengerQuery = "INSERT INTO passenger_details (`booking_id`, `first_name`, `surname`, `gender`, `nationality`, `age`)VALUES
                ('$bookingId', '$firstName', '$surname', '$gender', '$nationality', '$age')";
                $resultInsertPassenger = mysqli_query($conn, $insertPassengerQuery);

                    if (!$resultInsertPassenger) {
                        echo "Error inserting passenger details: " . mysqli_error($conn);
                        exit();
                    }
            }
            $_SESSION['booking_processed'] = true;
        }

        // function to generate ticket
        function generateTicket($passengers, $flight, $bookingId, $ticketNumber){
            echo'
                <div class = "ticket">
                    <div class = "ticket-header">
                        <h2>Boarding Pass</h2>
                        <span class = "ticket-number">' . $ticketNumber . '</span>
                        <span class = "ticket-type">' . $flight['type'] . '</span>
                    </div>  

                    <div class = "ticket-body">
                        <div class = "flight-info">
                            <div class = "flight-route">
                                <div class="airport">
                                    <div class="airport-code">' . $flight['departure']['code'] . '</div>
                                    <div class="airport-name">' . $flight['departure']['location'] . '</div>
                                </div>
                                <div class="flight-icon">✈</div>
                                <div class="airport">
                                    <div class="airport-code">' . $flight['arrival']['code'] . '</div>
                                    <div class="airport-name">' . $flight['arrival']['location'] . '</div>
                                </div>
                            </div>

                            <div class="flight-details">
                                <div class="detail">
                                    <span class="label">Flight</span>
                                    <span class="value">' . $flight['flight_number'] . '</span>
                                </div>
                                <div class="detail">
                                    <span class="label">Date</span>
                                    <span class="value">' . $flight['departure']['date'] . '</span>
                                </div>
                                <div class="detail">
                                    <span class="label">Departure</span>
                                    <span class="value">' . $flight['departure']['time'] . '</span>
                                </div>
                                <div class="detail">
                                    <span class="label">Arrival</span>
                                    <span class="value">' . $flight['arrival']['time'] . '</span>          
                                </div>
                                <div class="detail">
                                    <span class="label">Boarding</span>
                                    <span class="value">' . (isset($flight['boarding_time']) ? $flight['boarding_time'] : 'N/A' ) . '</span>
                                </div>
                            </div>
                        </div>

                        <div class="passengers-info">
                            <h3>Passenger Information</h3>
                            <div class="passenger-list">';

                            // Displaying passenger names
                            foreach($passengers as $passenger){
                                echo '
                                    <div class = "passenger-item">
                                        <div class="detail">
                                            <span class="label">Passenger</span>
                                            <span class="value">' . $passenger['first_name'] . ' ' . $passenger['surname'] . '</span>
                                        </div>
                                    </div>';
                            }
                        echo '    
                            </div>
                        </div>';

                        // Display seat numbers
                        echo '
                                <div class="seats-info">
                                    <h3>Allocated Seats</h3>
                                    <div class="seats-list">';
                                    if($flight['type'] == "onward"){
                                        foreach ($_SESSION['reservedSeats'] as $seat) {
                                            echo '<span class="seat">' . ($seat ? $seat : 'N/A') . '</span> ';
                                        }
                                    }

                                    elseif ($flight['type'] == "return") {
                                        foreach ($_SESSION['reservedReturnSeats'] as $seat) {
                                            echo '<span class="seat">' . ($seat ? $seat : 'N/A') . '</span> ';
                                        }
                                    }
                                echo '    
                                    </div>  
                                </div>';

                echo '
                    </div>
                    <div class="ticket-footer">
                        <p>Booking ID: ' . $bookingId . '</p>
                    </div>
            </div>';
        }

        if($tripType == 'oneWay' && isset($booking['flights'][0])) {
            $flight = $booking['flights'][0];
            generateTicket($booking['passenger_details'], $flight, $bnOnward, $tnOnward);
        }

        elseif($tripType == 'roundTrip' && isset($booking['flights'][0]) && isset($booking['flights'][1])) {
            $onwardFlight = $booking['flights'][0];
            $returnFlight = $booking['flights'][1];

            generateTicket($booking['passenger_details'], $onwardFlight, $bnOnward, $tnOnward);
            generateTicket($booking['passenger_details'], $returnFlight, $bnReturn, $tnReturn);

        }

        else{
            echo "Invalid flight data for this trip";
        }
    }

    else{
        echo "Booking details not found.";
    }

?>