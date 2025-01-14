
<?php
    session_start();

    $departureDate = $_SESSION['departureDate'];
    $returnDate = $_SESSION['returnDate'];
    $tripType = $_SESSION['tripType'];
    $ticketPrice = $_SESSION['ticket-price'];

    // Flight details
    $onwardFlightNo = $_SESSION['o_flight_no'];
    $returnFlightNo = $_SESSION['r_flight_no'];

    $deptAirport = $_SESSION['deptAirportLocation'];
    $deptAreaCode = $_SESSION['dept_area_code'];
    $destAirport = $_SESSION['destAirportLocation'];
    $destAreaCode = $_SESSION['dest_area_code'];
    $departureDateOnly = $_SESSION['depart_date'];
    $departureTime = $_SESSION['depart_time'];
    $arrivalTime = $_SESSION['arrival_time'];

    $returnDateOnly = $_SESSION['return_date'];
    $returnTime = $_SESSION['rd_time'];
    $returnArrivalTime = $_SESSION['ra_time'];

    $noOfAdult = $_SESSION['noOfAdult'];
    $noOfChildren = $_SESSION['noOfChildren'];
    $noOfInfants = $_SESSION['noOfInfants'];
    $s_total_passengers = $noOfAdult + $noOfChildren;
    $total_passengers = $noOfAdult + $noOfChildren + $noOfInfants;
    $_SESSION['totalPrice'] = ($noOfAdult * $_SESSION['ticket-price']) + ($noOfChildren * $_SESSION['ticket-price'])
                                 + ($noOfInfants * $_SESSION['ticket-price']);

    $available_seats = $_SESSION['a_seats'];
    if ($available_seats < $s_total_passengers) {
        die("Not enough seats available for the requested number of passengers. Please try again.");
    }

    function generatePassengerSection($type, $number, $passenger_count){
        $age_field = '';

        if($type === 'CHILD'){
            $age_field = '<div class="input-group">
                            <input type = "number" id="age-'.$passenger_count.'" name="age-'.$passenger_count.' " min="2" max="11" placeholder = "Age (2-11 years)">
                        </div>';
        }

        elseif ($type === 'INFANT') {
        $age_field = '<div class="input-group">
                        <input type="number" id="age-'.$passenger_count.'" name="age-'.$passenger_count.'" min="0" max="24" required placeholder="Age (in months)">
                    </div>';
        }

        return '
            <div class = "passenger-section">
                <div class = "section-header">'. strtoupper($type).''.$number.'</div>
                    <div class = "input-row">
                        <div class = "input-group">
                            <input type = "text" id = "given-names-'.$passenger_count.'" name = "given-names-'.$passenger_count.'" placeholder = "First Name" required>
                        </div>
                        <div class="input-group">
                            <input type="text" id="surname-'.$passenger_count.'" name="surname-'.$passenger_count.'" required placeholder="Surname">
                        </div>
                    </div>
                    <div class = "input-group">
                        <input type = "text" id = "nationality='.$passenger_count.'" name = "nationality-'.$passenger_count.'" placeholder = "Nationality" placeholder = "Nationality" required">
                    </div>

                    <div class = "gender-group">
                        <label class = "gender-label">Gender</label>
                        <div class = "radio-options">
                            <label class="radio-label">
                                <input type = "radio" name = "gender-'.$passenger_count.'" value = "male" required>
                                Male
                            </label>
                            <label class="radio-label">
                                <input type = "radio" name = "gender-'.$passenger_count.'" value= "female">
                                Female
                            </label>
                        </div>
                    </div>
                    '.$age_field.'
            </div>
                ';
}

?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $flights = [];
    $passenger_details = [];
    
    for ($i = 1; $i <= $total_passengers; $i++) {
        $passenger = [
            'first_name' => $_GET['given-names-'.$i],
            'surname' => $_GET['surname-'.$i],
            'gender' => $_GET['gender-'.$i],
            'nationality' => $_GET['nationality-'.$i],
            'age' => isset($_GET['age-'.$i]) ? $_GET['age-'.$i] : null,
        ];
        $passenger_details[] = $passenger;
    }

    function getBoardingTime($departureTime) {
        $departureTimestamp = strtotime($departureTime);
        $boardingTimestamp = $departureTimestamp - 30 * 60;
        return date('g:i A', $boardingTimestamp);
    }
    
    $flights = [
            [
                'type' => 'onward',
                'flight_number' => $onwardFlightNo,
                'departure' => ['code' => $deptAreaCode, 'location' => $deptAirport, 'time' => $departureTime, 'date' => $departureDateOnly],
                'arrival' => ['code' => $destAreaCode, 'location' => $destAirport, 'time' => $arrivalTime, 'date' => ''],
                // 'gate' => 'B22',
                'boarding_time' => getBoardingTime($departureTime)
            ],
            [
                'type' => 'return',
                'flight_number' => $returnFlightNo,
                'departure' => ['code' => $destAreaCode, 'location' => $destAirport, 'time' => $returnTime, 'date' => $returnDateOnly],
                'arrival' => ['code' => $deptAreaCode, 'location' => $deptAirport, 'time' => $returnArrivalTime, 'date' => ''],
                // 'gate' => 'C15',
                'boarding_time' => getBoardingTime($returnTime)
            ]
        ];

        $_SESSION['booking_details'] = [
            'flights' => $flights,
            'passenger_details' => $passenger_details
        ];
// echo '<pre>';
// print_r($_SESSION['booking_details']);
// echo '</pre>';

header('Location: ../payment/pay.php');
exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Details Form</title>
    <link rel="stylesheet" href="passengerContactForm.css">
    <link rel="stylesheet" href="../assets/navbar.css">
</head>
<body>
    <?php
        include('../partials/_navbar.php');
    ?>
    <form action="" id="passengerForm" method="GET">
        <div class = "main-container">
            <div class="container">
                    <div class="form-header">
                        <h2>Passenger Contact Details</h2>
                        <span class="mandatory-notice">All fields are mandatory*</span>
                    </div>

                    <div class="contact-details">
                        <div class="input-group">
                            <input type="email" name="email" id="email" value="<?php echo $_SESSION['user-type-email']; ?>" placeholder="Email Address" required>
                        </div>
                        <div class="input-group">
                            <input type="tel" id="phone" name="phone" value="<?php echo $_SESSION['phone']; ?>" placeholder="Phone Number" required>
                        </div>
                    </div>

                    <h2>Traveller Details</h2>

                    <?php
                        $passenger_count = 1;

                        for($i = 1; $i <= $noOfAdult; $i++){
                            echo generatePassengerSection('ADULT', $i, $passenger_count);
                            $passenger_count++;
                        }

                        for($i = 1; $i <= $noOfChildren; $i++){
                            echo generatePassengerSection('CHILD', $i, $passenger_count);
                            $passenger_count++;
                        }

                        for($i = 1; $i <= $noOfInfants; $i++){
                            echo generatePassengerSection('INFANT', $i, $passenger_count);
                            $passenger_count++;
                        }
                    ?>
                    <button type="submit" class="submit-btn">Continue Booking</button>
            </div>

            <!-- Fare Section -->
                <div class="fare-container">
                    <div class="fare-section">
                        <h3>Fare Summary</h3>
                        <p><strong>Adults: </strong><?php echo $noOfAdult ." * ". $_SESSION['ticket-price'] ?></p>
                        <p><strong>Children: </strong><?php echo $noOfChildren ." * ". $_SESSION['ticket-price'] ?></p>
                        <p><strong>Infants: </strong><?php echo $noOfInfants ." * ". $_SESSION['ticket-price'] ?></p>
                        <hr>
                        <p><strong>Total Fare:</strong> NPR <?php echo ( $noOfAdult * $_SESSION['ticket-price']) + ($noOfChildren * $_SESSION['ticket-price']) + ($noOfInfants * $_SESSION['ticket-price']); ?></p>
                    </div>
                </div>
            </div>

        </div>
    </form>
</body>
</html>