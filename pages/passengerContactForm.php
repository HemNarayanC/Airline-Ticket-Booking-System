
<?php
    session_start();
    $noOfAdult = $_SESSION['noOfAdult'];
    $noOfChildren = $_SESSION['noOfChildren'];
    $noOfInfants = $_SESSION['noOfInfants'];
    $total_passengers = $noOfAdult + $noOfChildren + $noOfInfants;

    if($total_passengers < 1 || $total_passengers > 9){
        die("Invalid number of passengers. Please go back and try again");
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
                        <input type="number" id="age-' . $passenger_count . '" name="age-' . $passenger_count . '" min="0" max="24" required placeholder="Age (in months)">
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
                            <input type="text" id="surname-' . $passenger_count . '" name="surname-' . $passenger_count . '" required placeholder="Surname">
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
                                <input type = "radio" name = "gender-' . $passenger_count . '" value= "female">
                                Female
                            </label>
                        </div>
                    </div>
                    '.$age_field.'
            </div>
                ';
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
        <div class = "main-container">
            <div class="container">
                <form action="" id="passengerForm" method="POST">
                    <div class="form-header">
                        <h2>Passenger Contact Details</h2>
                        <span class="mandatory-notice">All fields are mandatory*</span>
                    </div>

                    <div class="contact-details">
                        <div class="input-group">
                            <input type="email" name="email" id="email" placeholder="Email Address" required>
                        </div>
                        <div class="input-group">
                            <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>
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
                </form>
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
</body>
</html>