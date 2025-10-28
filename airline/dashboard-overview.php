<?php
// session_start();
$user_name = $_SESSION['user_name'] ?? 'User';
$company_name = $_SESSION['company_name'] ?? 'Skybooker Airlines';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?php echo htmlspecialchars($company_name); ?></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="airlineDashboard.css">
    <link rel="stylesheet" href="dashboard-overview.css">
</head>
<body>
    <?php
        include('airlineDashboard.php');

        $company_id = $_SESSION['c_id'];

        //For displaying dashboard stats

        $onwardFlightsQuery = "
            SELECT COUNT(f.flight_id) AS total_onward_flights
            FROM onward_flights f
            WHERE f.c_id = '$company_id'
        ";
        $onwardFlightsResult = mysqli_query($conn, $onwardFlightsQuery);
        $onwardFlightsData = mysqli_fetch_assoc($onwardFlightsResult);
        $totalOnwardFlights = $onwardFlightsData['total_onward_flights'] ?? 0;

        // Query to get the total return flights for the company
        $returnFlightsQuery = "
            SELECT COUNT(r.return_flight_id) AS total_return_flights
            FROM return_flights r
            INNER JOIN onward_flights f ON r.onward_flight_id = f.flight_id
            WHERE f.c_id = '$company_id'
        ";
        $returnFlightsResult = mysqli_query($conn, $returnFlightsQuery);
        $returnFlightsData = mysqli_fetch_assoc($returnFlightsResult);
        $totalReturnFlights = $returnFlightsData['total_return_flights'] ?? 0;

        // Total flights (onward + return)
        $totalFlights = $totalOnwardFlights + $totalReturnFlights;
    
        // Fetch total passengers for the company
        $passengersQuery = "
            SELECT COUNT(DISTINCT b.user_id) AS total_passengers 
            FROM bookings b
            JOIN onward_flights f ON b.flight_id = f.flight_id
            WHERE f.c_id = '$company_id'
        ";
        $passengersResult = mysqli_query($conn, $passengersQuery);
        $passengersData = mysqli_fetch_assoc($passengersResult);
        $totalPassengers = $passengersData['total_passengers'] ?? 0;
    
        // Fetch total revenue for the company (sum of total_fare)
        $revenueQuery = "
            SELECT SUM(b.total_fare) AS total_revenue 
            FROM bookings b
            JOIN onward_flights f ON b.flight_id = f.flight_id
            WHERE f.c_id = '$company_id'
        ";
        $revenueResult = mysqli_query($conn, $revenueQuery);
        $revenueData = mysqli_fetch_assoc($revenueResult);
        $totalRevenue = 0.95*$revenueData['total_revenue'] ?? 0;

        //Query for displaying recent bookings
        $recentBookingsQuery = "
            SELECT b.booking_id, b.booking_date, b.user_id, b.flight_id, f.flight_number, f.flight_name
            FROM bookings b
            INNER JOIN onward_flights f ON b.flight_id = f.flight_id
            WHERE f.c_id = '$company_id'
            ORDER BY b.booking_date DESC
            LIMIT 5
        ";
        $recentBookingsResult = mysqli_query($conn, $recentBookingsQuery);
    ?>

    <!-- Main Content Area -->
    <main class="main-content">
        <h2 class="page-title">Dashboard Overview</h2>

        <div class="dashboard-content">

            <div class="stats-grid">
                <div class="stat-card" id="totalFlights">
                    <div class="stat-icon">
                        <i class="material-icons-round">flight</i>
                    </div>
                    <div class="stat-content">
                        <h3>Total Flights</h3>
                        <p class="stat-value"><?php echo $totalFlights; ?></p>
                    </div>
                </div>
                <div class="stat-card" id="totalPassengers">
                    <div class="stat-icon">
                        <i class="material-icons-round">groups</i>
                    </div>
                    <div class="stat-content">
                        <h3>Total Passengers</h3>
                        <p class="stat-value"><?php echo $totalPassengers; ?></p>
                    </div>
                </div>
                <div class="stat-card" id="totalRevenue">
                    <div class="stat-icon">
                        <i class="material-icons-round">payments</i>
                    </div>
                    <div class="stat-content">
                        <h3>Total Revenue</h3>
                        <p class="stat-value"><?php echo $totalRevenue; ?></p>
                    </div>
                </div>
            </div>

            <div class="dashboard-grid">
                <section class="dashboard-section recent-bookings">
                    <h3>Recent Bookings</h3>
                    <table id="recentBookingsTable" style="width: 100%; text-align: center; border-collapse: collapse; font-size: 13px;">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Flight</th>
                                <th>User ID</th>
                                <th>Booking Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if (mysqli_num_rows($recentBookingsResult) > 0){
                                    while ($booking = mysqli_fetch_assoc($recentBookingsResult)){
                                        echo '<tr>
                                            <td>' . htmlspecialchars($booking['booking_id']) . '</td>
                                            <td>' . htmlspecialchars($booking['flight_name']) . ' (' . htmlspecialchars($booking['flight_number']) . ')</td>
                                            <td>' . htmlspecialchars($booking['user_id']) . '</td>
                                            <td>' . htmlspecialchars($booking['booking_date']) . '</td>
                                        </tr>';
                                    }
                                }
                                    else{
                                        echo'
                                        <tr>
                                            <td colspan="4" style="text-align: center;">No recent bookings found.</td>
                                        </tr>';
                                    }
                            ?>
                        </tbody>
                    </table>
                </section>
                <section class="dashboard-section popular-routes">
                    <h3>Popular Routes</h3>
                    <ul id="popularRoutesList"></ul>
                </section>
            </div>
        </div>
    </main>
    <script src="flightManagement.js"></script>
    <script src="toggleAirport.js"></script>
</body>

</html>