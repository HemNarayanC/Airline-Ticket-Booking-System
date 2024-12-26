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
</head>
<body>

    <?php
        include('airlineDashboard.php');
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
            <form id="flightForm" class="flight-form" action="insertFlights.php" method="POST">
                <!-- Trip Type Selection -->
                 <div class="form-group trip-type">
                    <label for="" id="trip-type-label">Trip Type</label>
                    <div>
                        <label for="oneWay">
                            <input type="radio" name="tripType" value="oneWay" checked>
                            One Way
                        </label>
                        <label for="roundTrip">
                            <input type="radio" name="tripType" value="roundTrip">
                            Round Trip
                        </label>
                    </div>
                </div>

                    <!-- Onward Flight Section -->
                     <div class="flight-section onward-flight">
                        <h3>Onward Flight Details</h3>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="flightNumber">Flight Numeber</label>
                                <input type="text" name="flightNumber" id="flightNumber" required>
                            </div>

                            <div class="form-group">
                                <label for="flightName">Flight Name</label>
                                <input type="text" id="flightName" name="flightName" required>
                            </div>

                            <div class="form-group">
                                <label for="aircraftModel">Aircraft Model</label>
                                <input type="text" id="aircraftModel" name="aircraftModel" required>
                            </div>

                            <div class="form-group">
                                <label for="departure">Source (Departure Airport/City)</label>
                                <select id="departure" name="departureAirport" required>
                                    <option value="" selected disabled>Select Departure Airport</option>
                                    <?php
                                        while ($row = mysqli_fetch_assoc($resultCheckAirport)) {
                                            echo "<option value=\"{$row['airport_id']}\">{$row['airport_name']}, {$row['area_code']}</option>";
                                        }
                                    ?>
                                </select>
                                <!-- <input type="text" id="departure" name="departureAirport" required> -->
                            </div>

                            <div class="form-group">
                                <label for="destination">Destination (Arrival Airport/City)</label>
                                <select id="destination" name="destinationAirport" required>
                                    <option value="" selected disabled>Select Destination Airport</option>
                                    <?php
                                        $resultCheckAirport = mysqli_query($conn, "SELECT * FROM airport");
                                        while ($row = mysqli_fetch_assoc($resultCheckAirport)) {
                                            echo "<option value=\"{$row['airport_id']}\">{$row['airport_name']}, {$row['area_code']}</option>";
                                        }
                                    ?>
                                </select>
                                <!-- <input type="text" id="destination" name="destinationAirport" required> -->
                            </div>

                            <div class="form-group">
                                <label for="departureTime">Departure Date & Time</label>
                                <input type="datetime-local" id="departureTime" name="departureTime" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="arrivalTime">Arrival Date & Time</label>
                                <input type="datetime-local" id="arrivalTime" name="arrivalTime" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="totalSeats">Total Seats</label>
                                <input type="number" id="totalSeats" name="totalSeats" min=30 required>
                            </div>
                            
                            <div class="form-group">
                                <label for="flightStatus">Flight Status</label>
                                <select name="flightStatus" id="flightStatus" required>
                                    <option value="scheduled">Scheduled</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                    <option value="delayed">Delayed</option>
                                    <option value="canceled">Canceled</option>
                                </select>
                            </div>
                            
                            <div class="form-group seat-fares">
                                <label for="">Seat Class Fares</label>
                                <div class="seat-fare-label">
                                    <label>
                                        Economy:
                                        <input type="number" name="economyFare" placeholder="Enter fare for Economy Class" min=0 required>
                                    </label>
                                </div>
                                <div  class="seat-fare-label">
                                    <label>
                                        Business:
                                        <input type="number" name="businessFare" placeholder="Enter fare for Business Class" min=0 required>
                                    </label>
                                </div>
                                <div class="seat-fare-label">
                                    <label>
                                        First Class:
                                        <input type="number" name="firstClassFare" placeholder="Enter fare for First Class" min=0 required>
                                    </label>
                                </div>
                            </div>

                        </div>
                     </div>

                     <!-- Return Flight Section -->
                      <div id="returnFlightSection" class="flight-section return-flight hidden">
                        <h3>Return Flight Details</h3>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="returnFlightNumber">Return Flight Number</label>
                                <input type="text" name="returnFlightNumber" id="returnFlightNumber">
                            </div>

                            <div class="form-group">
                                <label for="returnFlightName">Return Flight Name</label>
                                <input type="text" id="returnFlightName" name="returnFlightName">
                            </div>

                            <div class="form-group">
                                <label for="returnSource">Return Source</label>
                                <input type="text" id="returnSource" name="returnSource">
                            </div>

                            <div class="form-group">
                                <label for="returnDestination">Return Destination</label>
                                <input type="text" id="returnDestination" name="returnDestination">
                            </div>

                            <div class="form-group">
                                <label for="returnDepartureTime">Return Departure Date & Time</label>
                                <input type="datetime-local" id="returnDepartureTime" name="returnDepartureTime">
                            </div>

                            <div class="form-group">
                                <label for="returnArrivalTime">Return Arrival Date & Time</label>
                                <input type="datetime-local" id="returnArrivalTime" name="returnArrivalTime">
                            </div>
                        </div>
                      </div>

                      <!-- submit button -->
                       <div class="button-container">
                            <button type="submit" class="submit-btn">Save Flight</button>
                       </div>
            </form>
                
        </div>
    </main>
    <script src="flightManagement.js"></script>
    <script src="toggleAirport.js"></script>
    <script src="sidebarState.js"></script>
</body>
</html>
