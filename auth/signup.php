<?php
    require('../partials/navbar/_navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Modals</title>
    <link rel="stylesheet" href="styles101.css">
    <link rel="stylesheet" href="../assets/css/nav.css">
</head>
<body>
    

    <button id="openPassengerModal">Passenger Signup</button>
    <button id="openAirlineModal">Airline Company Signup</button>

    <!-- Passenger Signup Modal -->
    <div id="passengerModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Passenger Signup</h2>
            <form id="passengerForm">
                <input type="text" id="user_id" name="user_id" placeholder="User ID" required>
                <input type="text" id="fname" name="fname" placeholder="First Name" required>
                <input type="text" id="mid_name" name="mid_name" placeholder="Middle Name">
                <input type="text" id="lname" name="lname" placeholder="Last Name" required>
                <input type="email" id="passenger_email" name="email" placeholder="Email" required>
                <input type="password" id="passenger_password" name="password" placeholder="Password" required>
                <button type="submit">Sign Up</button>
            </form>
        </div>
    </div>

    <!-- Airline Company Signup Modal -->
    <div id="airlineModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Airline Company Signup</h2>
            <form id="airlineForm">
                <input type="text" id="admin_id" name="admin_id" placeholder="Admin ID" required>
                <input type="text" id="c_name" name="c_name" placeholder="Company Name" required>
                <input type="email" id="airline_email" name="email" placeholder="Email" required>
                <input type="password" id="airline_password" name="password" placeholder="Password" required>
                <textarea id="address" name="address" placeholder="Address" required></textarea>
                <button type="submit">Sign Up</button>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="../assets/js/navbar.js"></script>
</body>
</html>