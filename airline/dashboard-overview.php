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
    ?>

    <!-- Main Content Area -->
    <main class="main-content">
        <header class="top-bar">
            <div class="search-bar">
                <i class="material-icons-round">search</i>
                <input type="text" placeholder="Search...">
            </div>
            <div class="user-menu">
                <span class="user-name">Hell</span>
                <div class="user-avatar">
                    <i class="material-icons-round">person</i>
                </div>
            </div>
        </header>

        <div class="dashboard-content">
            <h2 class="page-title">Dashboard Overview</h2>

            <div class="stats-grid">
                <div class="stat-card" id="totalFlights">
                    <div class="stat-icon">
                        <i class="material-icons-round">flight</i>
                    </div>
                    <div class="stat-content">
                        <h3>Total Flights</h3>
                        <p class="stat-value">Loading...</p>
                    </div>
                </div>
                <div class="stat-card" id="totalPassengers">
                    <div class="stat-icon">
                        <i class="material-icons-round">groups</i>
                    </div>
                    <div class="stat-content">
                        <h3>Total Passengers</h3>
                        <p class="stat-value">Loading...</p>
                    </div>
                </div>
                <div class="stat-card" id="totalRevenue">
                    <div class="stat-icon">
                        <i class="material-icons-round">payments</i>
                    </div>
                    <div class="stat-content">
                        <h3>Total Revenue</h3>
                        <p class="stat-value">Loading...</p>
                    </div>
                </div>
            </div>

            <div class="dashboard-grid">
                <section class="dashboard-section recent-bookings">
                    <h3>Recent Bookings</h3>
                    <ul id="recentBookingsList"></ul>
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