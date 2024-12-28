
<?php
    session_start();
    $noOfAdult = $_SESSION['noOfAdult'];
    $noOfChildren = $_SESSION['noOfChildren'];
    $noOfInfants = $_SESSION['noOfInfants'];
    $total_passengers = $noOfAdult + $noOfChildren + $noOfInfants;
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Details Form</title>
</head>
<body>
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
        </form>
    </div>
</body>
</html>