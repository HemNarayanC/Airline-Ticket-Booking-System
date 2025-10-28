<?php
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $_SESSION['departureDate'] = $_POST['departureDate'];
        $_SESSION['returnDate'] = $_POST['returnDate'];
        $_SESSION['tripType'] = $_POST['tripType'];
        $_SESSION['ticketPrice'] = $_POST['price'];

        // Flight details
        $_SESSION['onwardFlightId'] = $_POST['flight_id'];
        $_SESSION['onwardFlightNo'] = $_POST['flight_no'];
        $_SESSION['returnFlightId'] = $_POST['return_flight_id'] ?? null;
        $_SESSION['returnFlightNo'] = $_POST['return_flight_no'] ?? null;
        
        $_SESSION['deptAirport'] = $_POST['departure_location'];
        $_SESSION['deptAreaCode'] = $_POST['departure_area_code'];
        $_SESSION['destAirport'] = $_POST['destination_location'];
        $_SESSION['destAreaCode'] = $_POST['destination_area_code'];
        $_SESSION['departureDateOnly'] = $_POST['depart_date'];
        $_SESSION['departureTime'] = $_POST['depart_time'];
        $_SESSION['arrivalTime'] = $_POST['arrival_time'];
        
        $_SESSION['returnDateOnly'] = $_POST['return_date'] ?? null;
        $_SESSION['returnTime'] = $_POST['return_depart_time'] ?? null;
        $_SESSION['returnArrivalTime'] = $_POST['return_arrival_time'] ?? null;

        $noOfAdult = $_SESSION['noOfAdult'];
        $noOfChildren = $_SESSION['noOfChildren'];
        $noOfInfants = $_SESSION['noOfInfants'];
        $s_total_passengers = $noOfAdult + $noOfChildren;
        $_SESSION['total_passengers'] = $noOfAdult + $noOfChildren + $noOfInfants;
        $_SESSION['totalPrice'] = ($noOfAdult * $_SESSION['ticketPrice']) + ($noOfChildren * $_SESSION['ticketPrice'])
        + ($noOfInfants * $_SESSION['ticketPrice']);
        
        $_SESSION['oa_seats'] = $_POST['available_seats'];
        $_SESSION['ot_seats'] = $_POST['total_seats'];
        if($_SESSION['tripType'] == "roundTrip"){
            $_SESSION['ra_seats'] = $_POST['r_available_seats'];
            $_SESSION['rt_seats'] = $_POST['r_total_seats'];
        }
        // if ($available_seats < $s_total_passengers) {
        //     die("Not enough seats available for the requested number of passengers. Please try again.");
        // }
}
    
    function generatePassengerSection($type, $number, $passenger_count){
        $age_field = '';
        
        if($type === 'CHILD'){
            $age_field = '<div class="input-group">
                            <input type = "number" id="age-'.$passenger_count.'" name="age-'.$passenger_count.'" min="2" max="11" placeholder = "Age (2-11 years)">
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
                            <input type = "text" id = "given-names-'.$passenger_count.'" name="given-names-'.$passenger_count.'" placeholder = "First Name" required>
                        </div>
                        <div class="input-group">
                            <input type="text" id="surname-'.$passenger_count.'" name="surname-'.$passenger_count.'" required placeholder="Surname">
                        </div>
                    </div>
                    <div class = "input-group">
                        <input type = "text" id = "nationality='.$passenger_count.'" name="nationality-'.$passenger_count.'" placeholder = "Nationality" placeholder = "Nationality" required">
                    </div>

                    <div class = "gender-group">
                        <label class = "gender-label">Gender</label>
                        <div class = "radio-options">
                            <label class="radio-label">
                                <input type = "radio" name ="gender-'.$passenger_count.'" value = "male" required>
                                Male
                            </label>
                            <label class="radio-label">
                                <input type = "radio" name ="gender-'.$passenger_count.'" value= "female">
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
    $total_passengers = $_SESSION['total_passengers'];
    
    for ($i = 1; $i <= $total_passengers; $i++) {
        $passenger = [
            'first_name' => $_GET['given-names-'.$i],
            'surname' => $_GET['surname-'.$i],
            'gender' => $_GET['gender-'.$i],
            'nationality' => $_GET['nationality-'.$i],
            'age' => isset($_GET['age-'.$i]) ? $_GET['age-'.$i] : null,
        ];
        $passenger_details[] = $passenger;
        // print_r($passenger_details);
    }

    function getBoardingTime($departureTime) {
        $departureTimestamp = strtotime($departureTime);
        $boardingTimestamp = $departureTimestamp - 30 * 60;
        return date('g:i A', $boardingTimestamp);
    }
    
    $flights = [
            [
                'type' => 'onward',
                'flight_id' => $_SESSION['onwardFlightId'],
                'flight_number' => $_SESSION['onwardFlightNo'],
                'departure' => ['code' => $_SESSION['deptAreaCode'], 'location' => $_SESSION['deptAirport'], 'time' => $_SESSION['departureTime'], 'date' => $_SESSION['departureDateOnly']],
                'arrival' => ['code' => $_SESSION['destAreaCode'], 'location' => $_SESSION['destAirport'], 'time' => $_SESSION['arrivalTime'], 'date' => ''],
                // 'gate' => 'B22',
                'boarding_time' => getBoardingTime($_SESSION['departureTime'])
            ],
            [
                'type' => 'return',
                'flight_id' =>  $_SESSION['returnFlightId'],
                'flight_number' => $_SESSION['returnFlightNo'],
                'departure' => ['code' => $_SESSION['destAreaCode'], 'location' => $_SESSION['destAirport'], 'time' => $_SESSION['returnTime'], 'date' => $_SESSION['returnDateOnly']],
                'arrival' => ['code' => $_SESSION['deptAreaCode'], 'location' => $_SESSION['deptAirport'], 'time' => $_SESSION['returnArrivalTime'], 'date' => ''],
                // 'gate' => 'C15',
                'boarding_time' => getBoardingTime($_SESSION['returnTime'])
            ]
        ];

        $_SESSION['booking_details'] = [
            'flights' => $flights,
            'passenger_details' => $passenger_details
        ];
// echo '<pre>';
// print_r($_SESSION['booking_details']);
// print_r($total_passengers);
// echo '</pre>';

    // echo '<pre>';
    //     print_r($_GET);
    // echo '</pre>';
        include('../test02/newSeats.php');
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
                        <p><strong>Adults: </strong><?php echo $noOfAdult ." * ". $_SESSION['ticketPrice'] ?></p>
                        <p><strong>Children: </strong><?php echo $noOfChildren ." * ". $_SESSION['ticketPrice'] ?></p>
                        <p><strong>Infants: </strong><?php echo $noOfInfants ." * ". $_SESSION['ticketPrice'] ?></p>
                        <hr>
                        <p><strong>Total Fare:</strong> NPR <?php echo $_SESSION['totalPrice']; ?></p>
                    </div>
                </div>
            </div>

        </div>
    </form>
</body>
</html>

