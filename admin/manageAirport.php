
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Airline</title>
    <link rel="stylesheet" href="airlineReviewTable.css">
    <link rel="stylesheet" href="adminDashboard.css">
    <link rel="stylesheet" href="manageAirport.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <?php
        include('adminDashboard.php');
        // include('../partials/_db_connect.php');
        if (isset($_GET['air_id']) && isset($_GET['action']) && $_GET['action'] === 'delete') {
            $airport_id = $_GET['air_id'];
            $delete_sql = "DELETE FROM `airport` WHERE `airport_id` = $airport_id";
            $delete_result = mysqli_query($conn, $delete_sql);
            if ($delete_result) {
                echo "<p>Record deleted successfully!</p>";
                header("Location: manageAirport.php");
                exit();
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
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
                <div class = "airport-list-container">
                    <h2>Airport List</h2>
                    <table class="airport-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Airport Name</th>
                                <th>Location</th>
                                <th>Area Code</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include('../partials/_db_connect.php');
                                $sqlAirportCheck = "SELECT * FROM `airport`";
                                $resultAirport = mysqli_query($conn, $sqlAirportCheck);
                                if($resultAirport && mysqli_num_rows($resultAirport)){
                                    while($row = mysqli_fetch_assoc($resultAirport)) {
                                        echo "<tr>";
                                        echo "<td>{$row['airport_id']}</td>";
                                        echo "<td>{$row['airport_name']}</td>";
                                        echo "<td>{$row['location']}</td>";
                                        echo "<td>{$row['area_code']}</td>";
                                        echo "<td class = 'airport-action-btn'>";
                                            echo "<button class='airport-edit-btn'><a href='updateAirport.php?air_id={$row["airport_id"]}&action=edit'> Edit </a></button>";
                                            echo "<button class = 'airport-delete-btn'><a href='manageAirport.php?air_id={$row['airport_id']}&action=delete'> Delete </a></button>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }

                                else{
                                    echo "<tr><td colspan = '4'>No airports found</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                    <a href="addAirport.php" class="airport-add-btn">Add Airport</a>
                </div>
         </main>
        <script src="airlineReviewTable.js"></script>
</body>
</html>