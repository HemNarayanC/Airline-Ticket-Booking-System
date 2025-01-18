<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Flight</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="airlineDashboard.css">
    <link rel="stylesheet" href="editFlight.css">
</head>
<body>
    <?php
        include('airlineDashboard.php');

        // Fetch the flight ID and flight type from the URL
        $flightId = $_GET['air_id'];
        $flightType = $_GET['flight_type'];
        
        // Query to fetch the onward flight details
        $onwardFlightQuery = "SELECT * FROM `onward_flights` WHERE `flight_id` = '$flightId'";
        $onwardFlightResult = mysqli_query($conn, $onwardFlightQuery);
        
        // Query to fetch the return flight details
        $returnFlightQuery = "SELECT * FROM `return_flights` WHERE `return_flight_id` = '$flightId'";
        $returnFlightResult = mysqli_query($conn, $returnFlightQuery);
        
        if (mysqli_num_rows($onwardFlightResult) > 0) {
            $onwardFlight = mysqli_fetch_assoc($onwardFlightResult);
        }
        elseif (mysqli_num_rows($returnFlightResult) > 0){
            $returnFlight = mysqli_fetch_assoc($returnFlightResult);
        }
        else {
            echo "Onward flight not found!";
            exit();
        }
    ?>

    <!-- Main Content Area -->
    <main class="main-content">
        <header class="header">
            <div class="header-content">
                <div class="section-title">Edit Flight</div>
            </div>
        </header>

        <div class="content-area">
            <div class="container">
                <h1>Edit <?php echo $flightType; ?> flight</h1>
                <form action="edit_flight.php" method="POST">
                    <div class="form-grid">
                    <input type="hidden" name="id" value="<?php echo $onwardFlight['flight_id']; ?>">
                    
                    <!-- Onward Flight Details -->
                    <?php 
                    if ($flightType == 'onward'){
                        echo '
                        <div class="form-group">
                            <label for="onward_flight_number">Flight Number:</label>
                            <input type="text" id="onward_flight_number" name="onward_flight_number" value="' . $onwardFlight['flight_number'] . '" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="onward_flight_name">Flight Name:</label>
                            <input type="text" id="onward_flight_name" name="onward_flight_name" value="' . $onwardFlight['flight_name'] . '" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="onward_departure_airport">Departure Airport:</label>
                            <input type="text" id="onward_departure_airport" name="onward_departure_airport" value="' . $onwardFlight['departure_airport_id'] . '" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="onward_arrival_airport">Arrival Airport:</label>
                            <input type="text" id="onward_arrival_airport" name="onward_arrival_airport" value="' . $onwardFlight['destination_airport_id'] . '" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="onward_departure_time">Departure Time:</label>
                            <input type="datetime-local" id="onward_departure_time" name="onward_departure_time" value="' . date('Y-m-d\TH:i', strtotime($onwardFlight['departure_time'])) . '" required>
                        </div>
                        <div class="form-group">
                            <label for="onward_arrival_time">Arrival Time:</label>
                            <input type="datetime-local" id="onward_arrival_time" name="onward_arrival_time" value="' . date('Y-m-d\TH:i', strtotime($onwardFlight['arrival_time'])) . '" required>
                        </div>
                        <div class="form-group">
                            <label for="onward_flight_status">Flight Status:</label>
                            <select id="onward_flight_status" name="onward_flight_status" required>
                                <option value="scheduled" ' . ($onwardFlight['flight_status'] == 'scheduled' ? 'selected' : '') . '>Scheduled</option>
                                <option value="in_progress" ' . ($onwardFlight['flight_status'] == 'in_progress' ? 'selected' : '') . '>In Progress</option>
                                <option value="completed" ' . ($onwardFlight['flight_status'] == 'completed' ? 'selected' : '') . '>Completed</option>
                                <option value="delayed" ' . ($onwardFlight['flight_status'] == 'delayed' ? 'selected' : '') . '>Delayed</option>
                                <option value="canceled" ' . ($onwardFlight['flight_status'] == 'canceled' ? 'selected' : '') . '>Canceled</option>
                            </select>
                        </div>';
                    }
                    ?>

                    <!-- Return Flight Details -->
                    <?php 
                    if ($flightType == 'return'){
                        // Check if $returnFlight is set and not null
                        if (isset($returnFlight) && $returnFlight) {
                            echo '
                            <div class="form-group">
                                <label for="return_flight_number">Return Flight Number:</label>
                                <input type="text" id="return_flight_number" name="return_flight_number" value="' . $returnFlight['return_flight_number'] . '" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="return_flight_name">Return Flight Name:</label>
                                <input type="text" id="return_flight_name" name="return_flight_name" value="' . $returnFlight['return_flight_name'] . '" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="return_departure_airport">Return Departure Airport:</label>
                                <input type="text" id="return_departure_airport" name="return_departure_airport" value="' . $returnFlight['return_source_id'] . '" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="return_arrival_airport">Return Arrival Airport:</label>
                                <input type="text" id="return_arrival_airport" name="return_arrival_airport" value="' . $returnFlight['return_destination_id'] . '" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="return_departure_time">Return Departure Time:</label>
                                <input type="datetime-local" id="return_departure_time" name="return_departure_time" value="' . date('Y-m-d\TH:i', strtotime($returnFlight['return_departure_time'])) . '" required>
                            </div>
                            <div class="form-group">
                                <label for="return_arrival_time">Return Arrival Time:</label>
                                <input type="datetime-local" id="return_arrival_time" name="return_arrival_time" value="' . date('Y-m-d\TH:i', strtotime($returnFlight['return_arrival_time'])) . '" required>
                            </div>
                            <div class="form-group">
                                <label for="return_flight_status">Return Flight Status:</label>
                                <select id="return_flight_status" name="return_flight_status" required>
                                    <option value="scheduled" ' . ($returnFlight['flight_status'] == 'scheduled' ? 'selected' : '') . '>Scheduled</option>
                                    <option value="in_progress" ' . ($returnFlight['flight_status'] == 'in_progress' ? 'selected' : '') . '>In Progress</option>
                                    <option value="completed" ' . ($returnFlight['flight_status'] == 'completed' ? 'selected' : '') . '>Completed</option>
                                    <option value="delayed" ' . ($returnFlight['flight_status'] == 'delayed' ? 'selected' : '') . '>Delayed</option>
                                    <option value="canceled" ' . ($returnFlight['flight_status'] == 'canceled' ? 'selected' : '') . '>Canceled</option>
                                </select>
                            </div>';
                        } else {
                            echo '<p>No return flight details found.</p>';
                        }
                    }    
                    ?>

                    </div>
                    <button type="submit" class="btn btn-primary">Update Flights</button>
                </form>
            </div>
        </div>
    </main>

    <script src="sidebarState.js"></script>
</body>
</html>
