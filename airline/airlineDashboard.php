
    <?php

    include('../partials/_db_connect.php');
    session_start();

    if(!isset($_SESSION['user-type']) || ($_SESSION['user-type'])!="Airline"){
        header('Location: ../auth/login.php');
        exit();
    }

    $companyName = $_SESSION['c_name'];
    $initialName = $_SESSION['nameInitial'];
    $c_id = $_SESSION['c_id'];

    ?>

    <div class="dashboard">
        <!-- Left Sidebar -->
        <aside class="sidebar">
            <div class="profile">
                <div class="avatar">
                    <a href="#" class="user-profile-initials">
                        <?php
                            echo $initialName;
                        ?>
                    </a>
                </div>
                <div class="profile-info">
                    <div>
                        <a href="#" class="user-profile-initials">
                            <?php
                                echo $companyName;
                            ?>
                        </a>
                    </div>
                    <!-- <div class="company-name">SkyLine Airlines</div> -->
                </div>
            </div>

            <nav class="nav-menu">
                <a href="dashboard-overview.php" class="nav-item active" data-section="dashboard-overview">
                    <i class="material-icons-round">dashboard</i>
                    Overview
                </a>
                <a href="#" class="nav-item" data-section="flight-management">
                    <i class="material-icons">flight</i>
                    Flights
                </a>
                <a href="#" class="nav-item" data-section="booking-management">
                    <i class="material-icons">book_online</i>
                    Bookings
                </a>
                <a href="#" class="nav-item" data-section="price-management">
                    <i class="material-icons">attach_money</i>
                    Pricing
                </a>
                <!-- <a href="#" class="nav-item" data-section="schedule-management">
                    <i class="material-icons">schedule</i>
                    Flight Schedule Management
                </a> -->
                <!-- <a href="#" class="nav-item" data-section="cancellation-management">
                    <i class="material-icons">cancel</i>
                    Manage Flight Cancellations
                </a> -->
            </nav>

            <div class="sidebar-footer">
                <a href="../auth/logout.php" class="logout-btn">
                    <i class="material-icons">exit_to_app</i> Logout
                </a>
                <div class="brand">
                    SkyLine Airlines
                </div>
            </div>
        </aside>
