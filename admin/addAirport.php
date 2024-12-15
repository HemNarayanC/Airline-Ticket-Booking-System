
    <div id="airportManagement" class="airport-management">
        <h2>Airport Management</h2>
        <form action = "addAirport.php" method = "POST" id="addAirportForm">
            <input type="text" id="airportName" name="airportName" placeholder="Airport Name" required>
            <input type="text" id="location" name="location" placeholder="Location" required>
            <input type="text" id="areaCode" name="areaCode" placeholder="Area Code" required>
            <button type="submit">Add Airport</button>
        </form>
        <div class="airport-btn-container">
            <button id="showAirportsBtn">Show Airports</button>
            <button id="hideAirportsBtn">Hide</button>
        </div>
    </div>

    <!-- Inserting the airport details into the database -->
    <?php
        include('../partials/_db_connect.php');
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $airport_name = $_POST['airportName'];
            $airport_location = $_POST['location'];
            $area_code = $_POST['areaCode'];

            $insertAirport = "INSERT INTO `airport`(`airport_name`, `location`, `area_code`)VALUES
                                ('$airport_name', '$airport_location', '$area_code')";
            $resultAddAirport = mysqli_query($conn, $insertAirport);

            if($resultAddAirport){
                echo "Airport Added Successfully";
                header('Location: adminDashboard.php');
                exit();
            }

            else{
                echo "Unable to add Airport";
            }
        }

    ?>