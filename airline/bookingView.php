<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Flight</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="airlineDashboard.css">
    <link rel="stylesheet" href="flightManagement.css">
    <link rel="stylesheet" href="bookingView.css">
</head>
<body>

    <?php
        include('airlineDashboard.php');

                
        if (isset($_GET['booking_id'])) {
            $booking_id = $_GET['booking_id'];

            $query = "
            SELECT 
                b.booking_id, 
                b.bn_onward, b.bn_return, b.tn_onward, b.tn_return, 
                b.flight_type, b.user_id, b.flight_id, b.total_fare, 
                b.booking_date, b.seat_no, b.return_seat_no, 
                of.flight_number AS onward_flight_number, 
                of.flight_name AS onward_flight_name, 
                of.aircraft_model AS onward_aircraft_model, 
                of.departure_time AS onward_departure_time, 
                of.arrival_time AS onward_arrival_time, 
                of.flight_status AS onward_flight_status,
                rf.return_flight_number, rf.return_flight_name, 
                rf.return_departure_time, rf.return_arrival_time, 
                rf.flight_status AS return_flight_status,
                u.fname, u.mid_name, u.lname, u.phone, u.email, 
                GROUP_CONCAT(p.first_name, ' ', p.surname ORDER BY p.passenger_id SEPARATOR ', ') AS passenger_names,
                GROUP_CONCAT(p.gender ORDER BY p.passenger_id SEPARATOR ', ') AS genders,
                GROUP_CONCAT(p.nationality ORDER BY p.passenger_id SEPARATOR ', ') AS nationalities,
                GROUP_CONCAT(p.age ORDER BY p.passenger_id SEPARATOR ', ') AS ages,
                GROUP_CONCAT(p.passenger_id ORDER BY p.passenger_id SEPARATOR ', ') AS passenger_ids
            FROM bookings b
            JOIN onward_flights of ON b.flight_id = of.flight_id
            LEFT JOIN return_flights rf ON b.flight_id = rf.onward_flight_id
            JOIN users u ON b.user_id = u.user_id
            LEFT JOIN passenger_details p ON b.booking_id = p.booking_id
            WHERE b.booking_id = '$booking_id'
            GROUP BY b.booking_id, of.flight_number, rf.return_flight_number, u.fname, u.mid_name, u.lname, u.phone, u.email
            ";

            $result = mysqli_query($conn, $query);
            $bookingDetails = mysqli_fetch_assoc($result);
        }
    ?>

    <?php
        $sqlCheckAirport = "SELECT * FROM `airport`";
        $resultCheckAirport = mysqli_query($conn, $sqlCheckAirport);
    ?>

 <!-- Main Content Area -->
    <main class="main-content">
        <header class="header">
            <div class="header-content">
                <div class="section-title">Flight Management</div>
                <div class="search-bar">
                    <i class="material-icons">search</i>
                    <input type="text" placeholder="Search...">
                </div>
            </div>
        </header>

        <div class="content-area">
            <!-- Content for each section will be dynamically loaded here -->
            <div class="container">
                <header>
                    <h1>Booking Details</h1>
                    <h2>For <?php echo $bookingDetails['fname'] . ' ' . $bookingDetails['lname']; ?></h2>
                </header>

                <section class="booking-info">
                    <h3>Booking Information</h3>
                    <div class="grid">
                        <div class="grid-item">
                            <span class="label">Booking ID:</span>
                            <span class="value"><?php echo $bookingDetails['booking_id']; ?></span>
                        </div>
                        <div class="grid-item">
                            <span class="label">Onward Booking Number:</span>
                            <span class="value"><?php echo $bookingDetails['bn_onward']; ?></span>
                        </div>
                        <div class="grid-item">
                            <span class="label">Return Booking Number:</span>
                            <span class="value"><?php echo $bookingDetails['bn_return']; ?></span>
                        </div>
                        <div class="grid-item">
                            <span class="label">Onward Flight Number:</span>
                            <span class="value"><?php echo $bookingDetails['onward_flight_number']; ?></span>
                        </div>
                        <div class="grid-item">
                            <span class="label">Onward Flight Name:</span>
                            <span class="value"><?php echo $bookingDetails['onward_flight_name']; ?></span>
                        </div>
                        <div class="grid-item">
                            <span class="label">Onward Aircraft Model:</span>
                            <span class="value"><?php echo $bookingDetails['onward_aircraft_model']; ?></span>
                        </div>
                        <div class="grid-item">
                            <span class="label">Onward Departure Time:</span>
                            <span class="value"><?php echo $bookingDetails['onward_departure_time']; ?></span>
                        </div>
                        <div class="grid-item">
                            <span class="label">Onward Arrival Time:</span>
                            <span class="value"><?php echo $bookingDetails['onward_arrival_time']; ?></span>
                        </div>
                        <div class="grid-item">
                            <span class="label">Total Fare:</span>
                            <span class="value"><?php echo $bookingDetails['total_fare']; ?></span>
                        </div>
                        <div class="grid-item">
                            <span class="label">Booking Date:</span>
                            <span class="value"><?php echo $bookingDetails['booking_date']; ?></span>
                        </div>
                        <div class="grid-item">
                            <span class="label">Seat Numbers:</span>
                            <span class="value"><?php echo $bookingDetails['seat_no']; ?> / <?php echo $bookingDetails['return_seat_no']; ?></span>
                        </div>
                        <div class="grid-item">
                            <span class="label">Flight Type:</span>
                            <span class="value"><?php echo $bookingDetails['flight_type']; ?></span>
                        </div>
                        <div class="grid-item">
                            <span class="label">Onward Flight Status:</span>
                            <span class="value"><?php echo $bookingDetails['onward_flight_status']; ?></span>
                        </div>

                        <!-- Check if it's a Round Trip and Display Return Flight Details -->
                        <?php if ($bookingDetails['flight_type'] == 'roundTrip'): ?>
                            <div class="grid-item">
                                <span class="label">Return Flight Number:</span>
                                <span class="value"><?php echo $bookingDetails['return_flight_number']; ?></span>
                            </div>
                            <div class="grid-item">
                                <span class="label">Return Flight Name:</span>
                                <span class="value"><?php echo $bookingDetails['return_flight_name']; ?></span>
                            </div>
                            <div class="grid-item">
                                <span class="label">Return Departure Time:</span>
                                <span class="value"><?php echo $bookingDetails['return_departure_time']; ?></span>
                            </div>
                            <div class="grid-item">
                                <span class="label">Return Arrival Time:</span>
                                <span class="value"><?php echo $bookingDetails['return_arrival_time']; ?></span>
                            </div>
                            <div class="grid-item">
                                <span class="label">Return Flight Status:</span>
                                <span class="value"><?php echo $bookingDetails['return_flight_status']; ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>

                <section class="passenger-info">
                    <h3>Passenger Information</h3>
                    <div class="passenger-grid">
                        <?php 
                        $passenger_names = explode(',', $bookingDetails['passenger_names']);
                        $genders = explode(',', $bookingDetails['genders']);
                        $nationalities = explode(',', $bookingDetails['nationalities']);
                        $ages = explode(',', $bookingDetails['ages']);
                        foreach ($passenger_names as $index => $name) {
                            ?>
                            <div class="passenger-item">
                                <h4><?php echo $name; ?></h4>
                                <p><strong>Gender:</strong> <?php echo $genders[$index]; ?></p>
                                <p><strong>Nationality:</strong> <?php echo $nationalities[$index]; ?></p>
                                <p><strong>Age:</strong> <?php echo $ages[$index]; ?></p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </section>
            </div>
                
        </div>
    </main>
    <script src="flightManagement.js"></script>
    <script src="toggleAirport.js"></script>
    <script src="sidebarState.js"></script>
</body>
</html>
