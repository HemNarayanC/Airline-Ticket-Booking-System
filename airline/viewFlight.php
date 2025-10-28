<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Flights</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="airlineDashboard.css">
    <link rel="stylesheet" href="viewFlight.css">
</head>
<body>
    <?php
        include('airlineDashboard.php');
    ?>

    <!-- Main Content Area -->
    <main class="main-content">
        <header class="header">
            <div class="header-content">
                <div class="section-title">View Flights</div>
                <div class="search-bar">
                    <i class="material-icons">search</i>
                    <input type="text" id="flightNumberSearch" placeholder="Search flights By Flight No...">
                </div>
            </div>
        </header>

        <div class="content-area">
            <?php

            // Fetch all flights
            $airlineCompanyId = $_SESSION['c_id']; // Or fetch it from another source if necessary

            // Query to get onward flight details
            $onwardFlightsQuery = "
                SELECT `flight_id`, `c_id`, `flight_number`, `flight_name`, `aircraft_model`, 
                    `departure_airport_id`, `destination_airport_id`, `departure_time`, 
                    `arrival_time`, `flight_status`, `trip_type`, `total_seats`, `available_seats`
                FROM `onward_flights`
                WHERE `c_id` = '$airlineCompanyId'
            ";

            // Query to get return flight details
            $returnFlightsQuery = "
                SELECT `return_flight_id`, `onward_flight_id`, `return_flight_number`, 
                    `return_flight_name`, `return_source_id`, `return_destination_id`, 
                    `return_departure_time`, `return_arrival_time`, `total_seats`, 
                    `available_seats`, `flight_status`
                FROM `return_flights`
                WHERE `onward_flight_id` IN (SELECT `flight_id` FROM `onward_flights` WHERE `c_id` = '$airlineCompanyId')
            ";

            // Execute the onward flights query
            $onwardFlightsResult = mysqli_query($conn, $onwardFlightsQuery);

            // Execute the return flights query
            $returnFlightsResult = mysqli_query($conn, $returnFlightsQuery);
            ?>

            <div class="container">
                <h1>View Flights</h1>
                <table id="flightTable" class="flight-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Flight Number</th>
                            <th>Departure</th>
                            <th>Arrival</th>
                            <th>Status</th>
                            <th>Total Seats</th>
                            <th>Available Seats</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    if (mysqli_num_rows($onwardFlightsResult) > 0) {
                        while ($row = mysqli_fetch_assoc($onwardFlightsResult)) {
                            // Fetch onward flight details
                            $flightId = $row['flight_id'];
                            $flightNumber = $row['flight_number'];
                            $flightName = $row['flight_name'];
                            $departureTime = $row['departure_time'];
                            $arrivalTime = $row['arrival_time'];
                            $status = $row['flight_status'];
                            $total_seats = $row['total_seats'];
                            $available_seats = $row['available_seats'];
                            // Output onward flight details in the table
                            echo "<tr>
                                    <td>$flightId</td>
                                    <td class = 'flightNumber'>$flightNumber</td>
                                    <td>$departureTime</td>
                                    <td>$arrivalTime</td>
                                    <td>$status</td>
                                    <td>$total_seats</td>
                                    <td>$available_seats</td>
                                    <td class= 'flight-action-btn'>";
                                        // <!-- Add actions like Edit, View, Delete -->
                                        echo "<button class='flight-edit-btn'><a href='editFlight.php?air_id={$flightId}&flight_type=onward&action=edit'> Edit </a></button>";
                                        echo "<button class = 'flight-delete-btn'><a href='viewFlight.php?air_id={$flightId}&action=delete'> Delete </a></button>";
                                   echo" </td>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No onward flights found for this airline.</td></tr>";
                    }
                    
                    if (mysqli_num_rows($returnFlightsResult) > 0) {
                        while ($row = mysqli_fetch_assoc($returnFlightsResult)) {
                            // Fetch return flight details
                            $returnFlightId = $row['return_flight_id'];
                            $returnFlightNumber = $row['return_flight_number'];
                            $returnFlightName = $row['return_flight_name'];
                            $returnDepartureTime = $row['return_departure_time'];
                            $returnArrivalTime = $row['return_arrival_time'];
                            $status = $row['flight_status'];
                            $total_seats = $row['total_seats'];
                            $available_seats = $row['available_seats'];
                    
                            // Output return flight details in the table
                            echo "<tr>
                                    <td>$returnFlightId</td>
                                    <td class = 'flightNumber'>$returnFlightNumber</td>
                                    <td>$returnDepartureTime</td>
                                    <td>$returnArrivalTime</td>
                                    <td>$status</td>
                                    <td>$total_seats</td>
                                    <td>$available_seats</td>
                                    <td class= 'flight-action-btn'>";
                                        // <!-- Add actions like Edit, View, Delete -->
                                        echo "<button class='flight-edit-btn'><a href='editFlight.php?air_id={$returnFlightId}&flight_type=return&action=edit'> Edit </a></button>";
                                        echo "<button class = 'flight-delete-btn'><a href='viewFlight.php?air_id={$returnFlightId}&action=delete'> Delete </a></button>";
                                   echo" </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No return flights found for this airline.</td></tr>";
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