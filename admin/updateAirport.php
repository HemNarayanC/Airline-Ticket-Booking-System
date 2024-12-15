

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="adminDashboard.css">
    <link rel="stylesheet" href="addAirport.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    
        <?php
            include('adminDashboard.php');
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $airport_id = $_POST['airport_id'];
                $airport_name = $_POST['updatedAirportName'];
                $airport_location = $_POST['updatedLocation'];
                $area_code = $_POST['updatedAreaCode'];
        
                $updateAirport = "UPDATE `airport` SET `airport_name` = '$airport_name', `location` = '$airport_location', `area_code` = '$area_code' WHERE `airport_id` = '$airport_id'";
                $resulUpdateAirport = mysqli_query($conn, $updateAirport);
        
                if($resulUpdateAirport){
                    header('Location: manageAirport.php');
                    exit();
                }
        
                else{
                    echo "Unable to add Airport";
                }
            }

            if (isset($_GET['air_id'])) {
                $airport_id = $_GET['air_id'];
                $sql = "SELECT * FROM `airport` WHERE `airport_id` = $airport_id";
                $result = mysqli_query($conn, $sql);

                // Check if the query was successful
                if (!$result) {
                    echo "Error executing query: " . mysqli_error($conn);
                } else {
                    // Check if the query returned any data
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                    } else {
                        echo "No record found with ID: $id";
                    }
                }
            }
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
                <div id="airportManagement" class="update-container">
                    <h2>Update Airport</h2>
                    <form action = "update02.php" method = "POST" id="addAirportForm">
                        <input type="hidden" name="airport_id" value="<?php echo isset($row['airport_id']) ? htmlspecialchars($row['airport_id']) : ''; ?>" />
                        <input type="text" id="airportName" name="updatedAirportName" placeholder="Airport Name" value="<?php echo isset($row['airport_name']) ? htmlspecialchars($row['airport_name']) : ''; ?>" required>
                        <input type="text" id="location" name="updatedLocation" placeholder="Location" value="<?php echo isset($row['location']) ? htmlspecialchars($row['location']) : ''; ?>" required>
                        <input type="text" id="areaCode" name="updatedAreaCode" placeholder="Area Code" value="<?php echo isset($row['area_code']) ? htmlspecialchars($row['area_code']) : ''; ?>" required>
                        <button type="submit">Update Airport</button>
                    </form>
                </div>
            </div>
         </main>
    </div>
</body>
</html>