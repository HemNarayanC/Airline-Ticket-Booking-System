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
                        <label for="oneWay">
                            <input type="radio" name="tripType" value="oneWay" checked>
                            One Way
                        </label>
                        <label for="roundTrip">
                            <input type="radio" name="tripType" value="roundTrip">
                            Round Trip
                        </label>
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
                                <input type="text" id="departure" name="departureAirport" required>
                            </div>

                            <div class="form-group">
                                <label for="destination">Destination (Arrival Airport/City)</label>
                                <input type="text" id="destination" name="destinationAirport" required>
                            </div>

                            <div class="form-group">
                                <label for="departureTime">Departure Date & Time</label>
                                <input type="datetime-local" id="departureTime" name="departureTime" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="arrivalTime">Arrival Date & Time</label>
                                <input type="datetime-local" id="arrivalTime" name="arrivalTime" required>
                            </div>

                            <div class="form-group seat-fares">
                                <label for="">Seat Class Fares</label>
                                <div>
                                    <label>
                                        Economy:
                                        <input type="number" name="economyFare" placeholder="Enter fare for Economy Class" required>
                                    </label>
                                </div>
                                <div>
                                    <label>
                                        Business:
                                        <input type="number" name="businessFare" placeholder="Enter fare for Business Class" required>
                                    </label>
                                </div>
                                <div>
                                    <label>
                                        First Class:
                                        <input type="number" name="firstClassFare" placeholder="Enter fare for First Class" required>
                                    </label>
                                </div>
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

                        </div>
                     </div>

 
                 </div>
            </form>
                
        </div>
    </main>
</body>
</html>
