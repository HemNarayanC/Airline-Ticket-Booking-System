
<?php

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
                <a href="../pages/home.php" class="nav-item" active>
                    <i class="material-icons">home</i>
                    Dashboard
                </a>

                <a href="" class="nav-item">
                    <i class="material-icons">
                    connecting_airports
                    </i>
                    Manage Airports
                </a>
                <a href="" class="nav-item">
                    <i class="material-icons">
                        airlines
                    </i>
                    Manage Airlines
                </a>
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
         </main>

         <div class="managing-container">

         </div>

    </div>

</body>
</html>