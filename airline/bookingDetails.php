<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="airlineDashboard.css">
    <link rel="stylesheet" href="viewFlight.css">
</head>
<body>
    <?php include('airlineDashboard.php'); ?>

    <main class="main-content">
        <header class="header">
            <div class="header-content">
                <div class="section-title">View Bookings</div>
                <div class="search-bar">
                    <i class="material-icons">search</i>
                    <input type="text" id="bookingSearch" placeholder="Search bookings by Passenger Name...">
                </div>
            </div>
        </header>

        <div class="content-area">
            <?php
            $flight_id = isset($_GET['air_id']) ? $_GET['air_id'] : '';
            
            // Updated SQL query to fetch booking details based on the flight_id and booking_id
            $bookingQuery = "
            SELECT 
                b.booking_id, 
                CONCAT(u.fname, ' ', u.lname) AS passenger_name, 
                b.seat_no, 
                b.return_seat_no,
                b.total_fare,
                b.booking_date,
                b.flight_type,
                of.flight_number AS onward_flight_number, 
                of.flight_name AS onward_flight_name, 
                of.departure_time AS onward_departure_time, 
                of.arrival_time AS onward_arrival_time, 
                of.flight_status AS onward_flight_status,
                rf.return_flight_number, 
                rf.return_flight_name,
                rf.return_departure_time,
                rf.return_arrival_time,
                rf.flight_status AS return_flight_status,
                GROUP_CONCAT(p.first_name, ' ', p.surname ORDER BY p.passenger_id SEPARATOR ', ') AS passengers, 
                GROUP_CONCAT(p.gender ORDER BY p.passenger_id SEPARATOR ', ') AS genders,
                GROUP_CONCAT(p.nationality ORDER BY p.passenger_id SEPARATOR ', ') AS nationalities,
                GROUP_CONCAT(p.age ORDER BY p.passenger_id SEPARATOR ', ') AS ages
            FROM bookings b
            JOIN users u ON b.user_id = u.user_id
            JOIN onward_flights of ON b.flight_id = of.flight_id
            LEFT JOIN return_flights rf ON of.flight_id = rf.onward_flight_id
            LEFT JOIN passenger_details p ON b.booking_id = p.booking_id
            WHERE of.flight_id = '$flight_id'
            GROUP BY b.booking_id, u.fname, u.lname, b.seat_no, b.return_seat_no, 
                    b.total_fare, b.booking_date, b.flight_type, 
                    of.flight_number, of.flight_name, 
                    of.departure_time, of.arrival_time, of.flight_status, 
                    rf.return_flight_number, rf.return_flight_name, 
                    rf.return_departure_time, rf.return_arrival_time, rf.flight_status";

            
            // Execute the query (assuming $connection is your MySQL connection)
            $bookingResult = mysqli_query($conn, $bookingQuery);            
            ?>

            <div class="container">
                <h1>View Bookings</h1>
                <table id="flightTable" class="flight-table">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Passenger Name</th>
                            <th>Flight Number</th>
                            <th>Flight Name</th>
                            <th>Seat(s)</th>
                            <th>Booking Date</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($bookingResult) > 0) {
                            while ($row = mysqli_fetch_assoc($bookingResult)) {
                                // Logic to show seat numbers for round-trip or one-way bookings
                                $seatNumbers = ($row['flight_type'] == 'Round Trip') ? 
                                    "{$row['seat_no']} / {$row['return_seat_no']}" : $row['seat_no'];
                                
                                // Display booking details
                                echo "<tr>
                                    <td>{$row['booking_id']}</td>
                                    <td>{$row['passenger_name']}</td>
                                    <td>{$row['onward_flight_number']}</td>
                                    <td>{$row['onward_flight_name']}</td>
                                    <td>{$seatNumbers}</td>
                                    <td>{$row['booking_date']}</td>
                                    <td>{$row['flight_type']}</td>
                                    <td>{$row['onward_flight_status']}</td>
                                    <td class='booking-action-btn'>
                                        <button class='booking-view-btn'>
                                            <a href='bookingView.php?booking_id={$row['booking_id']}'> View </a>
                                        </button>
                                        <button class='booking-cancel-btn'>
                                            <a href='cancelBooking.php?booking_id={$row['booking_id']}'> Cancel </a>
                                        </button>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='12'>No bookings found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </main>
    <script src="sidebarState.js"></script>
</body>
</html>
