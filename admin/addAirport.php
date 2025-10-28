
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Airline</title>
    <link rel="stylesheet" href="adminDashboard.css">
    <link rel="stylesheet" href="addAirport.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <?php
        include('adminDashboard.php');
    ?>
    <!-- Main Content -->
    <main class="main-content">
            <!-- Header -->
             <header class="header">
                <div class="header-content">
                    <div class="section-title">
                        DASHBOARD
                    </div>
                    <div class="search-bar">
                        <i class="material-icons">search</i>
                        <input type="text" name="search" id="searchBar" placeholder="Search">
                    </div>
                </div>
             </header>
         
            <div class="managing-container">
                <div id="airportManagement" class="airport-management">
                    <h2>Airport Management</h2>
                    <form action = "addAirport.php" method = "POST" id="addAirportForm">
                        <input type="text" id="airportName" name="airportName" placeholder="Airport Name" required>
                        <input type="text" id="location" name="location" placeholder="Location" required>
                        <input type="text" id="areaCode" name="areaCode" placeholder="Area Code" required>
                        <button type="submit">Add Airport</button>
                    </form>
                    <div class="airport-btn-container">
                        <button id="showAirportsBtn"><a href="manageAirport.php">Show Airports</a></button>
                    </div>
                </div>

                <!-- Inserting the airport details into the database -->
                <?php
                    // include('../partials/_db_connect.php');
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $airport_name = $_POST['airportName'];
                        $airport_location = $_POST['location'];
                        $area_code = $_POST['areaCode'];

                        $insertAirport = "INSERT INTO `airport`(`airport_name`, `location`, `area_code`)VALUES
                                            ('$airport_name', '$airport_location', '$area_code')";
                        $resultAddAirport = mysqli_query($conn, $insertAirport);

                        if($resultAddAirport){
                            echo "Airport Added Successfully";
                        }

                        else{
                            echo "Unable to add Airport";
                        }
                    }

                ?>
         </main>
        <script src="airlineReviewTable.js"></script>
</body>
</html>