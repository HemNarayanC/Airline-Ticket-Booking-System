


<?php
    session_start();
    $tripType = $_SESSION['tripType'];

    $_SESSION['booking_id'] = 'SY-B' . strtoupper(dechex(rand(100, 999))) . time();

    function generateTicketNumber() {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomLetters = substr(str_shuffle($letters), 0, 2);
        $randomNumbers = rand(1000, 9999);
        return 'SKY-B-' . $randomLetters . $randomNumbers;
    }

    if(isset($_SESSION['booking_details']) && !empty($_SESSION['booking_details'])) {
        $booking = $_SESSION['booking_details'];

        // function to generate ticket
        function generateTicket($passengers, $flight, $bookingId){
            $ticketNumber = generateTicketNumber();
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

                                    foreach ($passengers as $passenger) {
                                        echo '<span class="seat">' . (isset($passenger['seat']) ? $passenger['seat'] : 'N/A') . '</span> ';
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
            generateTicket($booking['passenger_details'], $flight, $_SESSION['booking_id']);
        }

        elseif($tripType == 'roundTrip' && isset($booking['flights'][0]) && isset($booking['flights'][1])) {
            $onwardFlight = $booking['flights'][0];
            $returnFlight = $booking['flights'][1];

            generateTicket($booking['passenger_details'], $onwardFlight, $_SESSION['booking_id']);
            generateTicket($booking['passenger_details'], $returnFlight, $_SESSION['booking_id']);

        }

        else{
            echo "Invalid flight data for this trip";
        }
    }

    else{
        echo "Booking details not found.";
    }

?>