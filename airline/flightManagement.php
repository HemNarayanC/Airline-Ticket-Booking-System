<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Flight</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="airlineDashboard.css">
</head>
<body>

    <?php
        include('airlineDashboard.php');
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
            <form id="flightForm" class="flight-form" action="insertFlight.php" method="POST">
                <!-- Trip Type Selection -->
                 <div class="form-group trip-type">
                    <label for="">Trip Type</label>
                    <div>
                        <label for="tripType">
                            <input type="radio" name="tripType" value="oneWay" checked>
                            One Way
                        </label>
                        <label for="tripType">
                            <input type="radio" name="tripType" value="roundTrip">
                            Round Trip
                        </label>
                    </div>
                 </div>
            </form>
                
        </div>
    </main>
</body>
</html>
