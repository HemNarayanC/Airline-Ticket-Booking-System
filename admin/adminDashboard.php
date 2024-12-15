
<?php

    include('../partials/_db_connect.php');
    session_start();

    if(!isset($_SESSION['user-type']) || ($_SESSION['user-type'])!="admin"){
        header('Location: ../auth/login.php');
        exit();
    }

    $adminName = $_SESSION['a_name'];
    $initialName = $_SESSION['nameInitial'];

?>
 
    <div class="dashboard">
        <!-- Left Sidebar -->
        <aside class="sidebar">
            <div class="profile">
                <div class="avatar">
                    <?php
                        echo $initialName;
                    ?>
                </div>
                <div class="profile-info">
                    <div>
                        <?php 
                            echo $adminName;
                        ?>
                    </div>
                    <div class="company-name">SkyBooker</div>
                </div>
            </div>

            <nav class="nav-menu">
                <a href="../pages/flightSearch.php" class="nav-item" active>
                    <i class="material-icons">home</i>
                    Flight Search
                </a>

                <a href="manageAirport.php" class="nav-item" id="add-airport-btn">
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
                            <option value="review-registration">Registration Requests</option>
                            <option value="update-airline-details">Update Details</option>
                            <option value="manage-flights">Manage Flights</option>
                        </select>
                    </div>
                </div>

                <a href="#" class="nav-item">
                    <i class="material-icons">
                    manage_accounts
                    </i>
                    Manage Users
                </a>
                <a href="#" class="nav-item">
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