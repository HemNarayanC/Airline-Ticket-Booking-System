
<?php

    include('../partials/_db_connect.php');
    session_start();

    if(!isset($_SESSION['user-type']) || ($_SESSION['user-type'])!="airline"){
        header('Location: ../auth/login.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="adminDashboard.css">
    <link rel="stylesheet" href="airlineReviewTable.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
</head>
<body>
    
    <div class="dashboard">
        <!-- Left Sidebar -->
        <aside class="sidebar">
            <div class="profile">
                <div class="avatar">
                    H
                </div>
                <div class="profile-info">
                    <div>Hem Narayan</div>
                    <div class="company-name">SkyBooker</div>
                </div>
            </div>

            <nav class="nav-menu">
                <a href="../pages/flightSearch.php" class="nav-item" active>
                    <i class="material-icons">home</i>
                    Flight Search
                </a>

                <a href="" class="nav-item">
                    <i class="material-icons">
                    connecting_airports
                    </i>
                    Manage Airports
                </a>
                <div href="#" class="nav-item">
                    <i class="material-icons">
                        airlines
                    </i>
                    <!-- Manage Airlines -->
                    <div class="dropdown m-airline">
                        <label for="manageAirline">Manage Airlines</label>
                        <select name="manageAirline" id="manageAirline">
                            <option value="" disabled selected>Select an action</option>
                            <option value="review-registration">Review Registration</option>
                            <option value="update-airline-details">Update Details</option>
                            <option value="manage-flights">Manage Flights</option>
                        </select>
                    </div>
                </div>

                <a href="" class="nav-item">
                    <i class="material-icons">
                    manage_accounts
                    </i>
                    Manage Users
                </a>
                <a href="" class="nav-item">
                    <i class="material-icons">
                    attach_money
                    </i>
                    Manage Payment
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="brand">
                    SkyBooker
                </div>
            </div>
        </aside>


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
    </div>

</body>
</html>