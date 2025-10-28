
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airline Review Table</title>
    <link rel="stylesheet" href="airlineReviewTable.css">
    <link rel="stylesheet" href="adminDashboard.css">
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
                <div class="airline-review-table">
                    <h1>Airline Registration Requests</h1>
                    <table class="airline-table">
                        <!-- table heading of airline table -->
                        <thead>
                            <tr>
                                <th>Pending ID</th>
                                <th>Registration No</th>
                                <th>Company Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Submitted At</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <!-- body of airline review table -->
                        <tbody>
                            <?php
                                $sqlAirlineCheck = "SELECT * FROM `pending_airline` WHERE `status` = 'pending'";
                                $resultAirline = mysqli_query($conn, $sqlAirlineCheck);
                                $numOfRows = mysqli_num_rows($resultAirline);

                                if($numOfRows > 0) {
                                    while($row = mysqli_fetch_assoc($resultAirline)){
                                        echo "<tr>";
                                            echo "<td>{$row['pending_id']}</td>";
                                            echo "<td>{$row['registration_no']}</td>";
                                            echo "<td>{$row['c_name']}</td>";
                                            echo "<td>{$row['email']}</td>";
                                            echo "<td>{$row['phone']}</td>";


                                            $status = $row['status'];

                                            if($status == 'pending'){
                                                echo "<td><span class = 'status-pending'>Pending</span></td>";
                                            }

                                            elseif($status == 'approved'){
                                                echo "<td><span class = 'status-approved'>approved</span></td>";
                                            }

                                            elseif($status == 'rejected'){
                                                echo "<td><span class = 'status-rejected'>rejected</span></td>";
                                            }

                                            echo "<td>{$row['submitted_at']}</td>";
                                            echo "<td>{$row['address']}</td>";
                                            echo "<td>
                                                    <form method = 'POST' action = 'airlineReviewTableDB.php' style = 'display: inline-block;'>
                                                        <input type = 'hidden' name = 'approve_id' value = '{$row['pending_id']}'>
                                                        <button type = 'submit' class = 'approve-btn'> Approve </button>
                                                    </form>

                                                    <form method = 'POST' action = 'airlineReviewTableDB.php' style = 'display: inline-block;'>
                                                        <input type = 'hidden' name = 'reject_id' value = '{$row['pending_id']}'>
                                                        <button type = 'submit' class = 'reject-btn'> Reject </button>
                                                    </form>
                                                </td>";

                                        echo "</td>";
                                    }
                                }

                                else{
                                    echo "<tr><td colspan = '9'>No records found.</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
         </main>
        <script src="airlineReviewTable.js"></script>
</body>
</html>